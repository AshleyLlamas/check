<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $dates = ['fecha_inicial', 'fecha_final'];
    
    protected $fillable = [
        'motivo',
        'fecha_inicial',
        'fecha_final',
        'user_id',
        'approval_jefe_id',
        'approval_rh_id',
        'estatus'
    ];

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
