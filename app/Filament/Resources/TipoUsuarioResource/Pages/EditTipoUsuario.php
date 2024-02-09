<?php

namespace App\Filament\Resources\TipoUsuarioResource\Pages;

use App\Filament\Resources\TipoUsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoUsuario extends EditRecord
{
    protected static string $resource = TipoUsuarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
