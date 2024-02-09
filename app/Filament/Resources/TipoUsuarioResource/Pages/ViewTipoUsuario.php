<?php

namespace App\Filament\Resources\TipoUsuarioResource\Pages;

use App\Filament\Resources\TipoUsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTipoUsuario extends ViewRecord
{
    protected static string $resource = TipoUsuarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
