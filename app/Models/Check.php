<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Check extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $dates = ['fecha'];

    protected $fillable = [
        'fecha',
        'in_id',
        'out_id',
        'user_id',
        'company_id',
        'schedule_id'
    ];

    //Uno a Muchos Inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Muchos Inversa
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    //Uno a Uno Inversa
    public function schedule(){
        return $this->belongsTo('App\Models\Schedule');
    }

    //Uno a Uno Inversa
    public function in(){
        return $this->belongsTo('App\Models\TimeCheck');
    }

    //Uno a Uno Inversa
    public function out(){
        return $this->belongsTo('App\Models\TimeCheck');
    }

    //Uno a Uno
    public function assistance(){
        return $this->hasOne('App\Models\Assistance');
    }
}
