<?php

namespace App\Filament\Resources\ListaCatalogoResource\Pages;

use App\Filament\Imports\ListaCatalogoImporter;
use App\Filament\Resources\ListaCatalogoResource;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListListaCatalogos extends ListRecords
{
    protected static string $resource = ListaCatalogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Crear')
            ->icon('heroicon-m-plus'),
            ImportAction::make()
                ->importer(ListaCatalogoImporter::class)
                ->icon('heroicon-m-arrow-up-tray')
                ->label('Importar')
                ->color('info'),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('descripcion')->heading('Nombre de la Categoría'),
                        Column::make('codigointerno')->heading('Código'),
                        Column::make('estado')->heading('Estado Categoría')
                            ->formatStateUsing(fn ($state) => $state == 1 ? 'Estado Activo' : 'Estado Inactivo'),
                        Column::make('created_at')->heading('Fecha de Creación'),
                        Column::make('updated_at')->heading('Fecha de Modificación'),
                        Column::make('users.name')->heading('Usuario Modificacion'),
                    ])
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                        ->withFilename(date('Y-m-d') . '-Lista Catalogo-export'),
                ])
        ];
    }
}
