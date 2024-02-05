<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateCategoria extends CreateRecord
{
    protected static string $resource = CategoriaResource::class;
    protected static ?string $title  = 'Creando Categoria';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_usuariocreacion'] = auth()->id();
        $data['estado'] = 1;
        return $data;
    }
    protected function getCreatedNotification(): ?Notification
    {
        $valor = $this->getRecord();

        $content = "La Categoria fue creada exitosamente, pero " . ($valor->estado == 1 ? __('ya puedes usarla en productos') : __('no puedes usarla en productos'));
        return Notification::make()
            ->success()
            ->title('Categoria Registrada')
            ->body("{$content}");
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->getRecord()]);
    }

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }
}
