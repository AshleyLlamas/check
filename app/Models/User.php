<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = ['id', 'created_at', 'updated'];
    
    protected $fillable = [
        'qr',
        'name',
        'email',
        'curp',
        'password',
        'número_de_empleado',
        'company_id',
        'puesto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     //Uno a Uno Inversa
     public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    //Uno a Muchos
    public function schedules(){
        return $this->hasMany('App\Models\Schedule');
    }

    //Uno a Muchos
    public function assistances(){
        return $this->hasMany('App\Models\Assistance');
    }

    //Uno a uno polimorficab
    public function image(){
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    //Uno a Muchos
    public function checks(){
        return $this->hasMany('App\Models\Check');
    }
}
