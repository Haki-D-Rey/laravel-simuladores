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
        Schema::create('negocio.Persona', function (Blueprint $table) {
            $table->id();
            $table->string('PrimerNombre', 1028)->nullable(false);
            $table->string('SegundoNombre', 1028)->nullable(false);
            $table->string('PrimerApellido', 1028)->nullable(false);
            $table->string('SegundoApellido', 1028)->nullable(false);
            $table->string('NombreCompleto', 1028)->nullable(false);
            $table->string('Telefono', 64)->nullable(false);
            $table->string('Correo', 64)->nullable(false)->unique();
            $table->string('Identificacion', 256)->nullable(true);
            $table->integer('IdGrado')->nullable(true)->unsigned();
            $table->integer('IdProfesion')->nullable(true)->unsigned();
            $table->integer('IdTipoIdentificacion')->nullable(true)->unsigned();
            $table->integer('IdRepresentanteInstitucional')->nullable(true)->unsigned();

            $table->timestamps();
            $table->renameColumn('created_at', 'fecha_creacion');
            $table->renameColumn('updated_at', 'fecha_actualizacion');

            // Indexes and fulltext search
            $table->index(['Identificacion', 'NombreCompleto', 'Correo']);
            $table->fulltext(['Identificacion', 'NombreCompleto', 'Correo']);

            $table->foreign('IdGrado')->references('id')->on('catalogo.ListaDetalleCatalogo');
            $table->foreign('IdProfesion')->references('id')->on('catalogo.ListaDetalleCatalogo');
            $table->foreign('IdTipoIdentificacion')->references('id')->on('catalogo.ListaDetalleCatalogo');
            $table->foreign('IdRepresentanteInstitucional')->references('id')->on('catalogo.ListaDetalleCatalogo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocio.Persona');
    }
};
