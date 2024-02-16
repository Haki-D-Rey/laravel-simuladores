<x-filament-panels::page>
    @if ($records == 7)
        {{ gettype($records) }}
        <livewire:ListaTipoUsuarios />
    @elseif ($records == 8)
        <div>
            lista catalogo tipo estado
        </div>
    @else
        <div>
            not found 404
        </div>
    @endif
</x-filament-panels::page>
