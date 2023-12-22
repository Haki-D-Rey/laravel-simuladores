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
        Schema::create('catalogo.ListaDetalleCatalogo', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('IdCatalogo');
            $table->bigInteger('IdTipoCatalogo');
            $table->string('ValorCatalogo', 1028)->nullable(false);
            $table->string('CodigoInterno', 64)->nullable(false);
            $table->string('Abreviacion', 64)->nullable(false);
            $table->boolean('Estado')->nullable(false);
            $table->timestamps();
            $table->renameColumn('created_at', 'fecha_creacion');
            $table->renameColumn('updated_at', 'fecha_actualizacion');

            // Foreign keys
            $table->foreign('IdCatalogo')->references('id')->on('catalogo.ListaCatalogo');

            $table->foreign('IdTipoCatalogo','fk_tipogrado')->references('id')->on('catalogo.TipoGrado');
            $table->foreign('IdTipoCatalogo', 'fk_tipoprofesion')->references('id')->on('catalogo.TipoProfesion');
            $table->foreign('IdTipoCatalogo', 'fk_tipoidentificacion')->references('id')->on('catalogo.TipoIdentificacion');
            $table->foreign('IdTipoCatalogo', 'fk_representante')->references('id')->on('catalogo.RepresentanteInstitucional');
            $table->foreign('IdTipoCatalogo', 'fk_estadocurso')->references('id')->on('catalogo.EstadoCurso');

            $table->foreign('CodigoInterno', 'fk_codigointerno_tipogrado')->references('CodigoInterno')->on('catalogo.TipoGrado');
            $table->foreign('CodigoInterno', 'fk_codigointerno_tipoprofesion')->references('CodigoInterno')->on('catalogo.TipoProfesion');
            $table->foreign('CodigoInterno', 'fk_codigointerno_tipoidentificacion')->references('CodigoInterno')->on('catalogo.TipoIdentificacion');
            $table->foreign('CodigoInterno', 'fk_codigointerno_representante')->references('CodigoInterno')->on('catalogo.RepresentanteInstitucional');
            $table->foreign('CodigoInterno', 'fk_codigointerno_estadocurso')->references('CodigoInterno')->on('catalogo.EstadoCurso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo.ListaDetalleCatalogo');
    }
};
