<?php

namespace App\Livewire;

use App\Filament\Imports\TipoEstadoProductoImporter;
use App\Models\TipoEstadoProducto;
use App\Services\TipoEstadoProductoForm;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\Component;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListaEstadoProducto extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    public function render()
    {
        return view('livewire.lista-estado-producto');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(TipoEstadoProducto::query())
            ->columns([
                TextColumn::make('descripcion')
                    ->searchable()
                    ->label('Descripcion'),
                TextColumn::make('codigointerno')
                    ->searchable()
                    ->label('Codigo Interno'),
                TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state == 1 ? __("Estado Activo") : __("Estado Inactivo"))
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'success',
                        '' => 'danger',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('Fecha Ingreso'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('Fecha Modificacion'),
                TextColumn::make('users.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Usuario Modificacion'),
            ])
            ->filters([
                SelectFilter::make('id')
                    ->options(TipoEstadoProducto::pluck('descripcion', 'id'))
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
                ViewAction::make()
                    ->form(TipoEstadoProductoForm::schema()),
                EditAction::make()
                    ->form(TipoEstadoProductoForm::schema()),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                ]),
            ])
            ->headerActions([
                CreateAction::make()
                    ->createAnother(false)
                    ->model(TipoEstadoProducto::class)
                    ->form(TipoEstadoProductoForm::schema())
                    ->label('Crear')
                    ->icon('heroicon-m-plus'),
                ImportAction::make()
                    ->importer(TipoEstadoProductoImporter::class)
                    ->icon('heroicon-m-arrow-up-tray')
                    ->label('Importar')
                    ->color('info'),
                ExportAction::make()
                    ->exports([
                        ExcelExport::make()->withColumns([
                            Column::make('descripcion')->heading('Nombre Tipo Usuario'),
                            Column::make('codigointerno')->heading('Código'),
                            Column::make('estado')->heading('Estado Tipo Usuario')
                                ->formatStateUsing(fn ($state) => $state == 1 ? 'Estado Activo' : 'Estado Inactivo'),
                            Column::make('created_at')->heading('Fecha de Creación'),
                            Column::make('updated_at')->heading('Fecha de Modificación'),
                            Column::make('users.name')->heading('Usuario Modificacion'),
                        ])
                            ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                            ->withFilename(date('Y-m-d') . '-Lista Catalogo-export'),
                    ])
            ]);
    }
}
