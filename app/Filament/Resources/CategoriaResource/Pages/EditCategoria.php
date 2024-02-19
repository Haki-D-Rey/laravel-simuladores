<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;

    protected static ?string $title = 'Editar Categoria';

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['users_id'] = $data['users_id']  ?  $data['users_id'] : auth()->id();
        return $data;
    }

    protected function getSavedNotification(): ?Notification
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

    protected function beforeCreate(): void
    {
        if (!$this->getRecord()->team->subscribed()) {
            Notification::make()
                ->warning()
                ->title('You don\'t have an active subscription!')
                ->body('Choose a plan to continue.')
                ->persistent()
                ->actions([
                    Action::make('subscribe')
                        ->button()
                        ->url(route('subscribe'), shouldOpenInNewTab: true),
                ])
                ->send();

            $this->halt();
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
