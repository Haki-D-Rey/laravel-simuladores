<?php

namespace App\Livewire;

use App\Models\TipoUsuario;
use Filament\Forms\Components\Grid;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Filament\Tables\Actions\CreateAction;

use Filament\Forms\Components\TextInput;

class ListaTipoUsuarios extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    protected static ?string $title = 'Editar Lista Catalogos';

    public function render()
    {
        return view('livewire.lista-tipo-usuarios');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(TipoUsuario::query())
            ->columns([])
            ->headerActions([
                CreateAction::make()
                    ->model(TipoUsuario::class)
                    ->form([
                        Grid::make([
                            'default' => 1,
                            'sm' => 2,
                            'md' => 3,
                        ])
                            ->schema([
                                TextInput::make('descripcion')
                                    ->required(),
                                TextInput::make('codigointerno')
                                    ->required(),
                            ])

                    ])

            ]);
    }
}
