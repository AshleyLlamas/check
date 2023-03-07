<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class JustifyAttendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'assistance_id',
        'tipo',
        'user_id',
        'approval_jefe',
        'approval_rh',
        'estatus'
    ];

    //Uno a Uno Inversa
    public function assistance(){
        return $this->belongsTo('App\Models\Assistance');
    }

    //Uno a Muchos inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Uno Inversa
    public function approval_jefe(){
        return $this->belongsTo('App\Models\Approval');
    }

    //Uno a Uno Inversa
    public function approval_rh(){
        return $this->belongsTo('App\Models\Approval');
    }

    //Uno a Uno Inversa
    public function approval_dg(){
        return $this->belongsTo('App\Models\Approval');
    }
}
