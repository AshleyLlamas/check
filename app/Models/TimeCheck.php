<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeCheck extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $dates = ['hora'];

    protected $fillable = [
        'hora',
        'estatus',
    ];

    //Uno a Uno
    public function check(){
        return $this->hasOne('App\Models\Check');
    }
}
