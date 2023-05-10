<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Safety extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $dates = ['fecha'];

    protected $fillable = [
        'area_id',
        'user_id',
        'tipo',
        'fecha'
    ];

    public function images(){
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    //Uno a Muchos Inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Muchos Inversa
    public function area(){
        return $this->belongsTo('App\Models\Area');
    }
}
