<?php

namespace App\Filament\Resources\ListaCatalogoResource\Pages;

use App\Filament\Resources\ListaCatalogoResource;
use App\Helpers\Config;
use App\Models\ListaCatalogo;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewListaCatalogo extends ViewRecord
{
    protected static string $resource = ListaCatalogoResource::class;
    protected static ?string $title = 'Ver Lista Catalogo';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Editar'),

            Actions\Action::make('ver Catalogo')
                ->icon('heroicon-m-pencil-square')
                ->button()
                ->labeledFrom('md')
                ->url(function ($record): string {
                    $listaCatalogo = ListaCatalogo::find($record->id);

                    if ($listaCatalogo) {
                        return url(
                            __(ListaCatalogoResource::getUrl()) . '/' . $listaCatalogo->id . '/' . $this->formarNuevaCadenaUrl($listaCatalogo->descripcion)
                        );
                    }

                    return null;
                }),
        ];
    }


    public function formarNuevaCadenaUrl($cadena): string
    {
        $cadena = str_replace(' ', '-', $cadena);
        $palabras = explode('-', $cadena);

        $indiceCatalogo = array_search('Lista', $palabras);
        if ($indiceCatalogo !== false && isset($palabras[$indiceCatalogo + 1])) {
            $nuevasPalabras = array_slice($palabras, $indiceCatalogo + 1);
            $nuevaCadena = strtolower(implode('-', $nuevasPalabras));

            return $nuevaCadena;
        }
        return '';
    }
}
