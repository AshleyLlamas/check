<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];
    
    protected $fillable = [
        'aprobación',
        'user_id',
        'observaciones',
    ];

    //Uno a Uno
    public function vacation_jefe(){
        return $this->hasOne('App\Models\Vacation');
    }

    //Uno a Uno
    public function vacation_rh(){
        return $this->hasOne('App\Models\Vacation');
    }

    //Uno a Uno
    public function vacation_dg(){
        return $this->hasOne('App\Models\Vacation');
    }

    //Uno a Uno
    public function justify_attendance_jefe(){
        return $this->hasOne('App\Models\Vacation');
    }

    //Uno a Uno
    public function justify_attendance_rh(){
        return $this->hasOne('App\Models\Vacation');
    }

    //Uno a Muchos inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
