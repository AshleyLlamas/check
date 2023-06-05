<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Attendance extends Model
{
    use HasFactory;

    protected $primaryKey = 'uid';

    protected $user_id = 'id';

    protected $guarded = ['uid', 'created_at', 'updated'];

    protected $dates = ['timestamp'];

    protected $fillable = [
        'uid',
        'id',
        'state',
        'timestamp'
    ];

    public function getKeyName(){
        return "uid";
    }

    //Uno a Muchos inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // public function scopeUser($query, $número_de_empleado){
    //     return $query->where('id', '=', $número_de_empleado);
    // }

    public function scopeDays($query, $day){
        return $query->whereDate('timestamp', $day);
    }
}
