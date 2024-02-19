<x-filament-panels::page>
    @if ($codigoInterno === 'LC-TP-001')
        <livewire:ListaTipoUsuarios />
    @elseif ($codigoInterno === 'LC-EP-001')
        <livewire:ListaEstadoProducto />
    @elseif ($codigoInterno === 'LC-RI-001')
        <livewire:ListaEstadoProducto />
    @elseif ($codigoInterno === 'LC-TI-001')
        <livewire:ListaEstadoProducto />
    @elseif ($codigoInterno === 'LC-TPR-001')
        <livewire:ListaEstadoProducto />
    @elseif ($codigoInterno === 'LC-TG-001')
        <livewire:ListaEstadoProducto />
    @else
        <div>
            not found 404
        </div>
    @endif
</x-filament-panels::page>
