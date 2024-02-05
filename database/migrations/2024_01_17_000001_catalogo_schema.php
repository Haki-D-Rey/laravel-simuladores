<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run The Migrations.
     */

    public function up(): void
    {

        //Esquema Tipo Grado
        Schema::create('catalogo.TipoGrado', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('descripcion', 1028)->nullable(false);
            $table->string('codigo_interno', 64)->nullable(false)->unique();
            $table->boolean('estado')->nullable(false);
            $table->string('abreviacion', 256)->nullable(false);
            $table->timestamps();
            // $table->renameColumn('created_at', 'FechaCreacion');
            // $table->renameColumn('updated_at', 'FechaModificacion');
            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);
        });

        //Esquema Tipo Profesion
        Schema::create('catalogo.TipoProfesion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion', 1028)->nullable(false);
            $table->string('codigo_interno', 64)->nullable(false)->unique();
            $table->boolean('estado')->nullable(false);
            $table->string('abreviacion', 256)->nullable(false);
            $table->timestamps();
            // $table->renameColumn('created_at', 'FechaCreacion');
            // $table->renameColumn('updated_at', 'FechaModificacion');
            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);
        });

        //Esquema de Tipo Identificacion
        Schema::create('catalogo.TipoIdentificacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion', 1028)->nullable(false);
            $table->string('codigo_interno', 64)->nullable(false)->unique();
            $table->boolean('estado')->nullable(false);
            $table->string('abreviacion', 256)->nullable(false);
            $table->timestamps();
            // $table->renameColumn('created_at', 'FechaCreacion');
            // $table->renameColumn('updated_at', 'FechaModificacion');

            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);
        });

        //Esquema de Representante Institucional
        Schema::create('catalogo.RepresentanteInstitucional', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion', 1028)->nullable(false);
            $table->string('codigo_interno', 64)->nullable(false)->unique();
            $table->boolean('estado')->nullable(false);
            $table->string('abreviacion', 256)->nullable(false);
            $table->timestamps();
            // $table->renameColumn('created_at', 'FechaCreacion');
            // $table->renameColumn('updated_at', 'FechaModificacion');
            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);
        });

        //Esquema de estado del Producto
        Schema::create('catalogo.EstadoProducto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion', 1028)->nullable(false);
            $table->string('codigo_interno', 64)->nullable(false)->unique();
            $table->boolean('estado')->nullable(false);
            $table->timestamps();
            // $table->renameColumn('created_at', 'FechaCreacion');
            // $table->renameColumn('updated_at', 'FechaModificacion');
            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);
        });

        //Esquema de Tipo de Usuario
        Schema::create('catalogo.TipoUsuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion', 1028)->nullable(false);
            $table->string('codigo_interno', 64)->nullable(false)->unique();
            $table->boolean('estado')->nullable(false);
            $table->timestamps();
            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);
        });

        Schema::create('catalogo.ListaCatalogo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion', 1028)->nullable(false);
            $table->string('codigo_interno', 64)->nullable(false);
            $table->boolean('estado')->nullable(false);
            $table->timestamps();
            // $table->renameColumn('created_at', 'FechaCreacion');
            // $table->renameColumn('updated_at', 'FechaModificacion');
            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);
        });

        Schema::create('catalogo.ListaDetalleCatalogo', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_catalogo');
            $table->unsignedBigInteger('id_tipocatalogo');
            $table->string('valor_catalogo', 1028)->nullable(false);
            $table->string('codigo_interno', 64)->nullable(false);
            $table->string('abreviacion', 64)->nullable(false);
            $table->boolean('estado')->nullable(false);
            $table->timestamps();
            // $table->renameColumn('created_at', 'FechaCreacion');
            // $table->renameColumn('updated_at', 'FechaModificacion');

            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);

            // Foreign keys
            $table->foreign('id_catalogo')->references('id')->on('catalogo.ListaCatalogo')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('id_tipocatalogo', 'fk_tipogrado')->references('id')->on('catalogo.TipoGrado')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_tipocatalogo', 'fk_tipoprofesion')->references('id')->on('catalogo.TipoProfesion')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_tipocatalogo', 'fk_tipoidentificacion')->references('id')->on('catalogo.TipoIdentificacion')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_tipocatalogo', 'fk_tipousuario')->references('id')->on('catalogo.TipoUsuario')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_tipocatalogo', 'fk_representante')->references('id')->on('catalogo.RepresentanteInstitucional')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_tipocatalogo', 'fk_estadoproducto')->references('id')->on('catalogo.EstadoProducto')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('codigo_interno', 'fk_codigointerno_tipogrado')->references('codigo_interno')->on('catalogo.TipoGrado')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('codigo_interno', 'fk_codigointerno_tipoprofesion')->references('codigo_interno')->on('catalogo.TipoProfesion')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('codigo_interno', 'fk_codigointerno_tipoidentificacion')->references('codigo_interno')->on('catalogo.TipoIdentificacion')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('codigo_interno', 'fk_codigointerno_tipousuario')->references('codigo_interno')->on('catalogo.TipoUsuario')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('codigo_interno', 'fk_codigointerno_representante')->references('codigo_interno')->on('catalogo.RepresentanteInstitucional')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('codigo_interno', 'fk_codigointerno_estadoproducto')->references('codigo_interno')->on('catalogo.EstadoProducto')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalogo.ListaDetalleCatalogo');
        Schema::dropIfExists('catalogo.TipoGrado');
        Schema::dropIfExists('catalogo.TipoProfesion');
        Schema::dropIfExists('catalogo.TipoIdentificacion');
        Schema::dropIfExists('catalogo.RepresentanteInstitucional');
        Schema::dropIfExists('catalogo.EstadoProducto');
        Schema::dropIfExists('catalogo.TipoUsuario');
        Schema::dropIfExists('catalogo.ListaCatalogo');
    }
};
