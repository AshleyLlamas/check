<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];
    
    protected $fillable = [
        'área',
        'user_id'
    ];

    //Uno a Uno Inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //Muchos a Muchos
    public function users(){
        return $this->belongsToMany('App\Models\Users')->withPivot('encargado_id');
    }
}
