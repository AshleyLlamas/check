<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Electronic extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'marca',
        'modelo',
        'serie',
        'electronicable_id',
        'electronicable_type'
    ];

    public function electronicable(){
        return $this->MorphTo();
    }

    //Uno a uno polimorfica
    public function inventory(){
        return $this->morphOne('App\Models\Inventory', 'inventariable');
    }
}
