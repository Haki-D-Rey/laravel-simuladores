<?php

namespace App\Filament\Resources\ActasResource\Pages;

use App\Filament\Resources\ActasResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewActas extends ViewRecord
{
    protected static string $resource = ActasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
