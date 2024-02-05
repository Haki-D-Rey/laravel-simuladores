<?php

namespace App\Filament\Resources\ActasResource\Pages;

use App\Filament\Resources\ActasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActas extends EditRecord
{
    protected static string $resource = ActasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
