<?php

namespace App\Filament\Resources\ListaCatalogoResource\Pages;

use App\Filament\Resources\ListaCatalogoResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;

class CrearCatalogos extends Page
{
    protected static string $resource = ListaCatalogoResource::class;

    protected static string $view = 'filament.resources.lista-catalogo-resource.pages.crear-catalogos';

    protected static ?string $title = 'Modulo Catalogo Tipo Usuarios';
}
