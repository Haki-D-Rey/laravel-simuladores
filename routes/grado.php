<?php

use App\Http\Controllers\API\Catalogo\TipoGradoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['valid.session'])->group(function () {
    Route::prefix('grado')->group(function () {

        Route::get('/', [TipoGradoController::class, 'index'])->name('tipo-grado.index');
        Route::get('/{id}', [TipoGradoController::class, 'show'])->name('tipo-grado.show');
    });
});
?>
