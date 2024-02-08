<?php

namespace App\Filament\Imports;

use App\Models\Categoria;
use App\Models\User;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Auth;

class CategoriaImporter extends Importer
{
    protected static ?string $model = Categoria::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nombre')
                // ->required()
                ->label('Nombre')
                ->rules(['required', 'max:256']),
            ImportColumn::make('codigointerno')
                // ->required()
                ->label('Codigo Interno')
                ->rules(['required', 'max:64']),
            ImportColumn::make('estado')
                // ->required()
                ->label('Estado'),
            ImportColumn::make('users_id')
                // ->required()
                ->label('Usuario Modificacion'),
        ];
    }

    public function resolveRecord(): ?Categoria
    {
        $value = Categoria::where('codigointerno', $this->data['codigointerno'])->first();

        if ($value) {
            $id = $value ->id;
            $created_at = $value ->created_at;
            $value->delete();

            // Create a new record
            return Categoria::updateOrCreate(
                [
                    'id' => $id // Assuming 'id' is the primary key
                ],
                [
                    'nombre' => $this->data['nombre'],
                    'codigointerno' => $this->data['codigointerno'],
                    'estado' => $this->data['estado'],
                    'created_at' => $created_at,
                    'id_usuariocreacion' => Auth::id(),
                    'users_id' => !$this->data['users_id'] ? Auth::id() : !$this->data['users_id'],
                ]
            );
        }
        return new Categoria();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your categoria import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
