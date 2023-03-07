<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Admonition extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $dates = ['fecha_de_la_incidencia'];

    protected $fillable = [
        'amonestado_id',
        'solicitante_id',
        'alta_id',
        'fecha_de_la_incidencia',
        'gravedad',
        'observaciones',
        'admonition_type_id'
    ];

    //Uno a Muchos inversa
    public function amonestado(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Muchos inversa
    public function solicitante(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Muchos inversa
    public function alta(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Muchos inversa
    public function admonitionType(){
        return $this->belongsTo('App\Models\AdmonitionType');
    }
}
