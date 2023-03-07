<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Accesory extends Model
{
    use HasFactory, softDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'tipo',
        'computer_id'
    ];
}
