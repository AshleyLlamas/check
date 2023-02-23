<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'plan',
        'sistema_operativo',
        'número_celular_o_extención',
        'tipo'
    ];

    //Uno a uno polimorfica
    public function electronic(){
        return $this->morphOne('App\Models\Electronic', 'electronicable');
    }
}
