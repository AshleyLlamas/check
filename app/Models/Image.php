<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'url',
        'imageable_id',
        'imageable_type'
    ];

    public function imageable(){
        return $this->MorphTo();
    }

    public function imageables(){
        return $this->MorphTo();
    }
}
