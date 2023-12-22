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
        Schema::create('negocio.Producto', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->bigInteger('IdCategoria',false,true);
            $table->string('NombreProducto', 1028)->nullable(false);
            $table->double('Precio', 8, 2);
            $table->boolean('Estado')->nullable(false);
            $table->bigInteger('EstadoProducto')->nullable(false);

            $table->timestamps();
            $table->renameColumn('created_at', 'fecha_creacion');
            $table->renameColumn('updated_at', 'fecha_actualizacion');

            //Foreign key
            $table->foreign('IdCategoria')->references('id')->on('negocio.Categoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocio.Producto');
    }
};
