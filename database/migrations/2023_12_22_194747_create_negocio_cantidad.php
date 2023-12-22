<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('negocio.Cantidad', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('IdProducto',false,true);
            $table->integer('CantidadDisponible')->nullable(false);
            $table->integer('CantidadVendida')->nullable(false);
            $table->boolean('Estado')->nullable(false);

            $table->timestamps();
            $table->renameColumn('created_at', 'fecha_creacion');
            $table->renameColumn('updated_at', 'fecha_actualizacion');

            //Foreign key
            $table->foreign('IdProducto', 'fk_producto_cantidad')->references('id')->on('negocio.Producto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocio.Cantidad');
    }
};
