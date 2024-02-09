<?php

namespace App\Filament\Imports;

use App\Models\ListaCatalogo;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Auth;

class ListaCatalogoImporter extends Importer
{
    protected static ?string $model = ListaCatalogo::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('descripcion')
                ->label('Nombre')
                ->rules(['required', 'max:256']),
            ImportColumn::make('codigointerno')
                ->label('Codigo Interno')
                ->rules(['required', 'max:64']),
            ImportColumn::make('estado')
                ->label('Estado'),
            ImportColumn::make('id_usuariocreacion')
                ->label('Usuario Creacion'),
            ImportColumn::make('users_id')
                ->label('Usuario Modificacion'),
        ];
    }

    public function resolveRecord(): ?ListaCatalogo
    {
        $value = ListaCatalogo::where('codigointerno', $this->data['codigointerno'])->first();

        if ($value) {
            $id = $value->id;
            $created_at = $value->created_at;
            $value->delete();

            // Create a new record
            return ListaCatalogo::updateOrCreate(
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
        return new ListaCatalogo();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Tu Lista de Catalogos se ha impoortado completa y' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' importadas.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
