<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'check_id',
        'user_id',
        'asistencia',
        'observación'
    ];

    //Uno a Muchos Inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Uno Inversa
    public function check(){
        return $this->belongsTo('App\Models\Check');
    }
}
