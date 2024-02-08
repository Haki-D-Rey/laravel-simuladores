<?php

namespace App\Filament\Exports;

use App\Models\Categoria;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class CategoriaExporter extends Exporter
{
    protected static ?string $model = Categoria::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('nombre'),
            ExportColumn::make('codigointerno'),
            ExportColumn::make('estado'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('id_usuariocreacion'),
            ExportColumn::make('id_usuariomodificacion'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your categoria export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }


}
