<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExtraHour extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $dates = ['fecha'];

    protected $fillable = [
        'fecha',
        'horas',
        'observación',
        'creador_id',
        'user_id',
        'estatus',
        'assistance_id',
        'approval_jefe_id',
        'approval_rh_id',
        'approval_dg_id'
    ];

    //Uno a Muchos inversa
    public function creador(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Muchos inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Uno Inversa
    public function assistance(){
        return $this->belongsTo('App\Models\Assistance');
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
