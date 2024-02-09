<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListaCatalogo extends Model
{
    use HasFactory;

    protected $table = 'catalogo.ListaCatalogo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'descripcion',
        'codigointerno',
        'estado',
        'created_at',
        'updated_at',
        'id_usuariocreacion',
        'users_id'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
