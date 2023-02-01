<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmonitionType extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'tipo'
    ];

    //Uno a Muchos
    public function administrativeRecords(){
        return $this->hasMany('App\Models\AdministrativeRecord');
    }

    //Uno a Muchos
    public function admonitions(){
        return $this->hasMany('App\Models\Admonition');
    }
}
