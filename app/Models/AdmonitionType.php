<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AdmonitionType extends Model
{
    use HasFactory, SoftDeletes;

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
