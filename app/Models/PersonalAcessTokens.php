<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAcessTokens extends Model
{
    use HasFactory;

    protected $table = 'public.personal_access_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tokenable_id',
        'name',
        'token',
        'expires_at',
        'created_at',
        'updated_at',
    ];

}
