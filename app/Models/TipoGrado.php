<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoGrado extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalogo.TipoGrado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Descripcion',
        'CodigoInterno',
        'Estado',
        'Abreviacion',
        'fecha_creacion',
        'fecha_actualizacion',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'Estado' => 'boolean',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The names of the "created at" and "updated at" columns.
     *
     * @var array
     */
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

     /**
     * Get the validation rules that apply to the model.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'CodigoInterno' => [
                'required',
                'unique:catalogo.TipoGrado',
                'regex:/^[A-Za-z0-9]+$/',
                // Agrega otras reglas de validación según tus necesidades
            ],
            // Agrega más reglas según tus necesidades
        ];
    }
}
