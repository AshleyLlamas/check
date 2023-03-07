<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'derecho_a_hora_extra',
        'recontratable',
        'user_id'
    ];

    //Uno a Uno Inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
