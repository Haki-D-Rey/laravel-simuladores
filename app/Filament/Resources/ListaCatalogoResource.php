<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListaCatalogoResource\Pages;
use App\Filament\Resources\ListaCatalogoResource\RelationManagers;
use App\Models\ListaCatalogo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ListaCatalogoResource extends Resource
{
    protected static ?string $model = ListaCatalogo::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Lista Catalogos';

    protected static ?string $navigationGroup = 'Catalogos';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Modulo Lista Catalogos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('descripcion')
                    ->required()
                    ->unique(ListaCatalogo::class, 'descripcion', ignoreRecord: true)
                    ->maxLength(128)
                    ->label('Descripcion')
                    ->validationMessages([
                        'unique' => 'El Valor del campo descripcion ya existe.',
                    ]),
                TextInput::make('codigointerno')
                    ->required()
                    ->unique(ListaCatalogo::class, 'codigointerno', ignoreRecord: true)
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
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('descripcion')
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
                Tables\Columns\TextColumn::make('users.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Usuario Modificacion'),
            ])
            ->filters([
                SelectFilter::make('id')
                    ->options(ListaCatalogo::pluck('descripcion', 'id'))
                    ->label('Por Catalogo')
                    ->searchable()
                    ->multiple(),

                SelectFilter::make('estado')
                    ->options([
                        '1' => 'Estado Activo',
                        '0' => 'Estado Inactivo',
                    ])
                    ->attribute('estado')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
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
            'index' => Pages\ListListaCatalogos::route('/'),
            'create' => Pages\CreateListaCatalogo::route('/create'),
            'view' => Pages\ViewListaCatalogo::route('/{record}'),
            'edit' => Pages\EditListaCatalogo::route('/{record}/edit'),
            'catalago' => Pages\CrearCatalogos::route('/{record}/create-catalogo'),

        ];
    }
}
