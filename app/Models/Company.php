<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'nombre_de_la_compañia'
    ];

    //Uno a Muchos
    public function users(){
        return $this->hasMany('App\Models\User');
    }

    //Uno a Muchos
    public function checks(){
        return $this->hasMany('App\Models\Check');
    }

    //Uno a Muchos
    public function inventories(){
        return $this->hasMany('App\Models\Inventory');
    }
}
