<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'derecho_a_hora_extra'
    ];

    //Uno a Uno Inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
