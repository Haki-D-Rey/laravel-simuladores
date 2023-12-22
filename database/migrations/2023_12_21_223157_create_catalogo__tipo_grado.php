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


        Schema::create('catalogo.TipoGrado', function (Blueprint $table) {

            $table->id();
            $table->string('Descripcion',1028)->nullable(false);
            $table->string('CodigoInterno',64)->nullable(false)->unique();
            $table->boolean('Estado')->nullable(false);
            $table->string('Abreviacion', 256)->nullable(false);
            $table->timestamps();
            $table->renameColumn('created_at', 'fecha_creacion');
            $table->renameColumn('updated_at', 'fecha_actualizacion');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo.TipoGrado');
    }
};
