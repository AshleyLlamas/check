<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'obra',
        'company_id',
        'responsable_del_proyecto_id',
        'responsable_de_recursos_humanos_id'
    ];
}
