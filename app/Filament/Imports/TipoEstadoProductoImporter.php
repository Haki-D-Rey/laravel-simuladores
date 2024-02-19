<?php

namespace App\Filament\Imports;

use App\Models\TipoEstadoProducto;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Auth;

class TipoEstadoProductoImporter extends Importer
{
    protected static ?string $model = TipoEstadoProducto::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('descripcion')
                ->requiredMapping()
                ->rules(['required', 'max:1028']),
            ImportColumn::make('codigointerno')
                ->requiredMapping()
                ->rules(['required', 'max:64']),
            ImportColumn::make('estado')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('id_usuariocreacion')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('users')
                ->relationship(),
        ];
    }

    public function resolveRecord(): ?TipoEstadoProducto
    {
        $value = TipoEstadoProducto::where('codigointerno', $this->data['codigointerno'])->first();

        if ($value) {
            $id = $value->id;
            $created_at = $value->created_at;
            $value->delete();

            // Create a new record
            return TipoEstadoProducto::updateOrCreate(
                [
                    'id' => $id // Assuming 'id' is the primary key
                ],
                [
                    'descripcion' => $this->data['descripcion'],
                    'codigointerno' => $this->data['codigointerno'],
                    'estado' => $this->data['estado'],
                    'created_at' => $created_at,
                    'id_usuariocreacion' => Auth::id(),
                    'users_id' => !$this->data['users_id'] ? Auth::id() : !$this->data['users_id'],
                ]
            );
        }
        return new TipoEstadoProducto();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your tipo usuario import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
