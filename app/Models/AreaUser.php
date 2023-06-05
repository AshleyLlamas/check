<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AreaUser extends Pivot
{
    use HasFactory;

    public function encargado(){
        return $this->belongsTo('App\Models\User');
    }
}
