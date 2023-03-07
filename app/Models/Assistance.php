<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assistance extends Model
{
    use HasFactory, SoftDeletes;

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

    //Uno a Uno
    public function justify_attendance(){
        return $this->hasOne('App\Models\JustifyAttendance');
    }

    //Uno a Uno
    public function extra_hour(){
        return $this->hasOne('App\Models\ExtraHour');
    }
}
