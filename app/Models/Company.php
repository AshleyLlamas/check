<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];
    
    protected $fillable = [
        'nombre_de_la_compañia'
    ];

    //Uno a Uno
    public function user(){
        return $this->hasOne('App\Models\User');
    }

    //Uno a Muchos
    public function checks(){
        return $this->hasMany('App\Models\Check');
    }
}
