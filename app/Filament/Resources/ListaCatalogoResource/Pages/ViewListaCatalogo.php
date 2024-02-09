<?php

namespace App\Filament\Resources\ListaCatalogoResource\Pages;

use App\Filament\Resources\ListaCatalogoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewListaCatalogo extends ViewRecord
{
    protected static string $resource = ListaCatalogoResource::class;
    protected static ?string $title  = 'Ver Lista Catalogo';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
            ->label('Editar'),
            Actions\Action::make('ver Catalogo')
            ->icon('heroicon-m-pencil-square')
            ->button()
            ->labeledFrom('md')
            ->url(fn ($record): string => __(ListaCatalogoResource::getUrl()) .'/'. $record->id . '/create-catalogo'),
        ];
    }
}
