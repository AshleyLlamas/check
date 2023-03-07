<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'calle',
        'número_exterior',
        'número_interior',
        'colonia',
        'código_postal',
        'municipality_id'
    ];

    //Uno a Uno Inversa
    public function municipality(){
        return $this->belongsTo('App\Models\Municipality');
    }

    //Uno a Uno
    public function user(){
        return $this->hasOne('App\Models\User');
    }
}
