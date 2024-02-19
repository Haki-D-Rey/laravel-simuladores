<?php

namespace App\Filament\Resources\ListaCatalogoResource\Pages;

use App\Filament\Resources\ListaCatalogoResource;
use App\Models\ListaCatalogo;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class CrearCatalogos extends Page
{
    protected static string $resource = ListaCatalogoResource::class;

    protected static ?string $model = ListaCatalogo::class;

    protected static string $view = 'filament.resources.lista-catalogo-resource.pages.crear-catalogos';

    public $data;

    public $record;

    public function getModelFindId($id): ListaCatalogo {
        $modelClass = static::$model;
        $model = $modelClass::find($id);
        return $model;
    }

    public function getTitle(): string | Htmlable
    {
        $descripcion = $this -> getModelFindId($this -> record) -> descripcion;
        return $descripcion;
    }

    protected function getViewData(): array
    {
        $model = $this -> getModelFindId($this -> record)->codigointerno;
        return [
            'codigoInterno' => $model
        ];
    }

}
