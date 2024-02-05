<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'negocio.Producto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'uuid',
        'IdCategoria',
        'NombreProducto',
        'Descripcion',
        'Precio',
        'EstadoProducto',
        'Estado',
        'created_at',
        'updated_at',
        'IdUsuarioCreacion',
        'IdUsuarioModificacion'
    ];
}
