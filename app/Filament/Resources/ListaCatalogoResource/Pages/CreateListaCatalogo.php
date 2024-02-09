<?php

namespace App\Filament\Resources\ListaCatalogoResource\Pages;

use App\Filament\Resources\ListaCatalogoResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateListaCatalogo extends CreateRecord
{
    protected static string $resource = ListaCatalogoResource::class;
    protected static ?string $title  = 'Creando Lista Catalogos';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_usuariocreacion'] = auth()->id();
        $data['estado'] = 1;
        return $data;
    }
    protected function getCreatedNotification(): ?Notification
    {
        $content = "EL Catalogo fue creada exitosamente";
        return Notification::make()
            ->success()
            ->title('Lista Catalogo Registrada')
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
