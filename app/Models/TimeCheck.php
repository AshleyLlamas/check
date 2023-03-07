<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TimeCheck extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $dates = ['hora'];

    protected $fillable = [
        'hora',
        'estatus',
        'observación'
    ];

    //Uno a Uno
    public function check(){
        return $this->hasOne('App\Models\Check');
    }
}
