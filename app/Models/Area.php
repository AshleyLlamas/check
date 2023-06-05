<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Area extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'área',
        'user_id',
        'ubicación',
        'cost_center_id',
        'company_id'
    ];

    //Uno a uno polimorfica
    public function inventory(){
        return $this->morphOne('App\Models\Inventory', 'propietariable');
    }

    //Uno a Muchos
    public function safeties(){
        return $this->hasMany('App\Models\Safety');
    }

    //Uno a Uno Inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //Muchos a Muchos
    public function users(){
        return $this->belongsToMany('App\Models\Users')->withPivot('encargado_id')->using('App\Models\AreaUser');
    }

    //Uno a Muchos inversa
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    //Uno a Muchos inversa
    public function cost_center(){
        return $this->belongsTo('App\Models\CostCenter');
    }

    public function encargado($encargado){
        return User::where('id', $encargado)->first();
    }
}
