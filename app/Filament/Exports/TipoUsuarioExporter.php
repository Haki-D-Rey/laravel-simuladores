<?php

namespace App\Filament\Exports;

use App\Models\TipoUsuario;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Notifications\Notification;

class TipoUsuarioExporter extends Exporter
{
    protected static ?string $model = TipoUsuario::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('descripcion'),
            ExportColumn::make('codigointerno'),
            ExportColumn::make('estado'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('id_usuariocreacion'),
            ExportColumn::make('users.name'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your tipo usuario export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        Notification::make()
        ->title('Saved successfully')
        ->success()
        ->send();

        return $body;
    }
}
