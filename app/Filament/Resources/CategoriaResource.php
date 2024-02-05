<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Models\Categoria;
use Filament\Forms\Form;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Closure;
use Filament\Forms\Get;

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Categorias';

    protected static ?string $navigationGroup = 'Negocio';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Modulo Categorias';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('nombre')
                    ->required()
                    ->unique(Categoria::class, 'nombre', ignoreRecord: true)
                    ->maxLength(128)
                    ->label('Descripcion')
                    ->validationMessages([
                        'unique' => 'El Valor del campo descripcion ya existe.',
                    ]),
                TextInput::make('codigointerno')
                    ->required()
                    ->unique(Categoria::class, 'nombre', ignoreRecord: true)
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
                Hidden::make('id_usuariomodificacion'),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('N°')
                    ->rowIndex(isFromZero: false),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable()
                    ->label('Descripcion'),
                Tables\Columns\TextColumn::make('codigointerno')
                    ->searchable()
                    ->label('Codigo Interno'),
                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state == 1 ? __("Estado Activo") : __("Estado Inactivo"))
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'success',
                        '' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('Fecha Ingreso'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('Fecha Modificacion'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'view' => Pages\ViewCategoria::route('/{record}'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }
}
