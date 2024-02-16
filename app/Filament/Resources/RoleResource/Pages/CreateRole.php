<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function getSavedNotification(): ?Notification
    {
        $valor = $this->getRecord();

        $content = "Se Creo Correctamente";
        return Notification::make()
            ->success()
            ->title('Role')
            ->body("{$content}");
    }
}
