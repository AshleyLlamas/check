<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_del_horario'
    ];

    //Uno a muchos polimorfico
    public function schedules(){
        return $this->morphMany('App\Models\Schedule', 'scheduleble');
    }
}
