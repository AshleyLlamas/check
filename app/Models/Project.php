<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'obra',
        'company_id',
        'responsable_del_proyecto_id',
        'responsable_de_recursos_humanos_id'
    ];
}
