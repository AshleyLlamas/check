<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];
    
    protected $fillable = [
        'nombre_del_municipio',
        'state_id',
    ];
}
