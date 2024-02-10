<?php

namespace App\Services;

use App\Models\TipoUsuario;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Facades\Auth;

final class TipoUsuarioForm
{
    public static function schema(): array
    {

        return  [
            Grid::make([
                'default' => 1,
                'sm' => 2,
                'md' => 2,
            ])
                ->schema([
                    TextInput::make('descripcion')
                    ->required()
                    ->unique(TipoUsuario::class, 'descripcion', ignoreRecord: true)
                    ->maxLength(128)
                    ->label('Descripcion')
                    ->validationMessages([
                        'unique' => 'El Valor del campo descripcion ya existe.',
                    ]),
                TextInput::make('codigointerno')
                    ->required()
                    ->unique(TipoUsuario::class, 'codigointerno', ignoreRecord: true)
                    ->maxLength(64)
                    ->label('Codigo')
                    ->validationMessages([
                        'unique' => 'El Valor del campo codigo ya existe.',
                    ]),
                Toggle::make('estado')
                    ->onIcon('heroicon-m-user')
                    ->offIcon('heroicon-m-no-symbol')
                    ->default(true)
                    ->inline(false)
                    ->hiddenOn('create')
                    ->visibleOn('edit'),
                Hidden::make('id_usuariocreacion')
                    ->default(Auth::id()) // Establece el valor por defecto con el ID del usuario autenticado
                    ->required(),
                Select::make('users_id')
                    ->relationship(name: 'users', titleAttribute: 'name')
                    ->visibleOn('edit')
                    ->label('Usuario Modificacion'),
                ])
        ];
    }
}
