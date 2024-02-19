<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Imports\CategoriaImporter;
use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ImportAction;

use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListCategorias extends ListRecords
{
    protected static string $resource = CategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Crear')
            ->icon('heroicon-m-plus'),
            ImportAction::make()
                ->importer(CategoriaImporter::class)
                ->icon('heroicon-m-arrow-up-tray')
                ->label('Importar')
                ->color('info')
                ->hidden( !auth()->user()->hasRole('User') || !auth()->user()->hasPermissionTo('import categoria')),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('nombre')->heading('Nombre de la Categoría'),
                        Column::make('codigointerno')->heading('Código'),
                        Column::make('estado')->heading('Estado Categoría')
                            ->formatStateUsing(fn ($state) => $state == 1 ? 'Estado Activo' : 'Estado Inactivo'),
                        Column::make('created_at')->heading('Fecha de Creación'),
                        Column::make('updated_at')->heading('Fecha de Modificación'),
                        Column::make('users.name')->heading('Usuario Modificacion'),
                    ])
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                        ->withFilename(date('Y-m-d') . '-Categoria-export'),
                ])
                ->hidden( !auth()->user()->hasRole('User') || !auth()->user()->hasPermissionTo('export categoria')),
        ];
    }
}
