<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'url',
        'imageable_id',
        'imageable_type'
    ];

    public function imageable(){
        return $this->MorphTo();
    }
}
