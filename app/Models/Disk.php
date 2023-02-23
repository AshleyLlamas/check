<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disk extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'tipo',
        'capacidad',
        'computer_id'
    ];

    //Uno a uno polimorfica
    public function electronic(){
        return $this->morphOne('App\Models\Electronic', 'electronicable');
    }
}
