<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $dates = ['hora_de_entrada', 'hora_de_salida'];

    protected $fillable = [
        'posición',
        'día',
        'hora_de_entrada',
        'hora_de_salida',
        'turno',
        'user_id',
        'actual'
    ];

    //Uno a Muchos inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Uno
    public function check(){
        return $this->hasOne('App\Models\Check');
    }
}
