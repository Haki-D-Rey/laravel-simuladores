<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActasResource\Pages;
use App\Filament\Resources\ActasResource\RelationManagers;
use App\Models\Actas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActasResource extends Resource
{
    protected static ?string $model = Actas::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Actas de Certificado';

    protected static ?string $navigationGroup = 'Negocio';

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Modulo Actas de Certificado';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListActas::route('/'),
            'create' => Pages\CreateActas::route('/create'),
            'view' => Pages\ViewActas::route('/{record}'),
            'edit' => Pages\EditActas::route('/{record}/edit'),
        ];
    }
}
