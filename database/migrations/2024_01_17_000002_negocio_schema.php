<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        //Esquema negocio tabla Persona
        Schema::create('negocio.Persona', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('primer_nombre', 1028)->nullable(false);
            $table->string('segundo_nombre', 1028)->nullable(false);
            $table->string('primer_apellido', 1028)->nullable(false);
            $table->string('segundo_apellido', 1028)->nullable(false);
            $table->string('nombre_completo', 1028)->nullable(false);
            $table->string('telefono', 64)->nullable(false);
            $table->string('correo', 64)->nullable(false)->unique();
            $table->string('identificacion', 256)->nullable(true);
            $table->string('tipo_usuario', 64)->nullable(false);
            $table->unsignedInteger('id_tipoidentificacion')->nullable(true);
            $table->unsignedInteger('id_tipousuario')->nullable(true);

            $table->timestamps();
            // $table->renameColumn('created_at', 'FechaCreacion');
            // $table->renameColumn('updated_at', 'FechaModificacion');

            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);

            $table->index(['identificacion', 'nombre_completo', 'correo']);
            $table->fulltext(['identificacion', 'nombre_completo', 'correo']);

            //Add Contrainst Foranea key.
            $table->foreign('id_tipoidentificacion', 'fk_persona_Idtipoidentificacion')->references('id')->on('catalogo.ListaDetalleCatalogo')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_tipousuario', 'fk_persona_Idtipousuario')->references('id')->on('catalogo.ListaDetalleCatalogo')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        //Esquema negocio tabla Categoria
        Schema::create('negocio.Categoria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 1028)->nullable(false)->unique();;
            $table->string('codigointerno', 64)->nullable(false)->unique();;
            $table->boolean('estado')->nullable(false);

            $table->timestamps();
            // $table->renameColumn('created_at', 'FechaCreacion');
            // $table->renameColumn('updated_at', 'FechaModificacion');

            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);
        });

        //Esquema negocio tabla Producto
        Schema::create('negocio.Producto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('id_categoria', false, true);
            $table->string('nombre_producto', 1028)->nullable(false);
            $table->string('descripcion', 1028)->nullable(false);
            $table->double('precio', 8, 2);
            $table->boolean('estado')->nullable(false);
            $table->unsignedInteger('estado_producto')->nullable(false);

            $table->timestamps();
            // $table->renameColumn('created_at', 'FechaCreacion');
            // $table->renameColumn('updated_at', 'FechaModificacion');

            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);

            //Foreign key
            $table->foreign('id_categoria')->references('id')->on('negocio.Categoria')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        //Esquema negocio tabla Cantidad
        Schema::create('negocio.Cantidad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedInteger('cantidad_disponible')->nullable(false);
            $table->unsignedInteger('cantidad_vendida')->nullable(false);
            $table->boolean('estado')->nullable(false);

            $table->timestamps();
            // $table->renameColumn('created_at', 'FechaCreacion');
            // $table->renameColumn('updated_at', 'FechaModificacion');

            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);

            //Foreign key
            $table->foreign('id_producto', 'fk_producto_cantidad')->references('id')->on('negocio.Producto')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('negocio.DetalleProducto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('id_producto');
            $table->boolean('estado')->nullable(false);

            $table->timestamps();
            // $table->renameColumn('created_at', 'fecha_creacion');
            // $table->renameColumn('updated_at', 'fecha_actualizacion');

            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);

            //Foreign key
            $table->foreign('id_producto', 'fk_producto_detalle')->references('id')->on('negocio.DetalleProducto')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('negocio.DetalleProductoPersona', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('id_producto')->nullable(false);

            $table->unsignedBigInteger('id_persona')->nullable(false);
            $table->boolean('estado')->nullable(false);

            $table->timestamps();
            // $table->renameColumn('created_at', 'fecha_creacion');
            // $table->renameColumn('updated_at', 'fecha_actualizacion');

            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);

            //Foreign key
            $table->foreign('id_producto', 'fk_producto_detalle_persona')->references('id')->on('negocio.DetalleProducto')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_persona')->references('id')->on('negocio.Persona')
                ->onUpdate('cascade')->onDelete('cascade');
        });


        Schema::create('negocio.DetalleUsuarioPersona', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuario')->nullable(false);
            $table->unsignedBigInteger('id_persona')->nullable(false);
            $table->boolean('estado')->nullable(false);

            $table->timestamps();
            // $table->renameColumn('created_at', 'fecha_creacion');
            // $table->renameColumn('updated_at', 'fecha_actualizacion');

            $table->unsignedInteger('id_usuariocreacion')->nullable(true);
            $table->unsignedInteger('id_usuariomodificacion')->nullable(true);

            //Foreign key
            $table->foreign('id_usuario', 'fk_detalleUP_IdUsuario')->references('id')->on('public.users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_persona','fk_detalleUP_IdPersona')->references('id')->on('negocio.Persona')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocio.DetalleUsuarioPersona');
        Schema::dropIfExists('negocio.DetalleProductoPersona');
        Schema::dropIfExists('negocio.DetalleProducto');
        Schema::dropIfExists('negocio.Cantidad');
        Schema::dropIfExists('negocio.Producto');
        Schema::dropIfExists('negocio.Persona');
        Schema::dropIfExists('negocio.Categoria');
    }
};
