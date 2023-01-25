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
        'número_de_empleado',
        'name',
        'email',
        'curp',
        'fecha_de_nacimiento',
        'fecha_de_ingreso',
        'whatsapp',
        'password',
        'estatus',
        'puesto',
        'tipo_de_puesto',
        'tipo',
        'número_de_inscripción_al_imss',
        'rfc',
        'número_del_infonavit',
        'company_id',
        'cost_center_id',
        'address',
        'document_id',
        'slug'
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

    public function getRouteKeyName(){
        return 'slug';
    }

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

    //Uno a Muchos
    public function approvals(){
        return $this->hasMany('App\Models\Approval');
    }

    //Uno a Muchos
    public function vacations(){
        return $this->hasMany('App\Models\Vacation');
    }

    //Uno a Muchos
    public function justify_attendances(){
        return $this->hasMany('App\Models\JustifyAttendance');
    }

    //Uno a Uno Inversa
    public function document(){
        return $this->belongsTo('App\Models\UserDocuments');
    }

    //Uno a Uno Inversa
    public function address(){
        return $this->belongsTo('App\Models\Address');
    }

    //Uno a Uno
    public function area(){
        return $this->hasOne('App\Models\Area');
    }


    //Muchos a Muchos
    public function areas(){
        return $this->belongsToMany('App\Models\Area')->withPivot('encargado_id');
    }

    //Uno a Muchos inversa
    public function cost_center(){
        return $this->belongsTo('App\Models\CostCenter');
    }
}
