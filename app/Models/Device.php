<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Device extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'descripción'
    ];

    //Muchos a Muchos
    public function inUsers(){
        return $this->belongsToMany('App\Models\User');
    }

    //Uno a Muchos Inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
