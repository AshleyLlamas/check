<?php

namespace App\Models;

use App\Notifications\MyResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $dates = ['fecha_de_nacimiento', 'fecha_de_ingreso'];

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
        'salario_legal',
        'salario_complemento',
        'número_de_inscripción_al_imss',
        'rfc',
        'número_del_infonavit',
        'company_id',
        'cost_center_id',
        'address',
        'document_id',
        'setting_id',
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

    //Uno a Uno
    public function userSetting(){
        return $this->hasOne('App\Models\UserSetting');
    }

    //Uno a uno polimorfica
    public function inventory(){
        return $this->morphOne('App\Models\Inventory', 'propietariable');
    }

     //Uno a Uno Inversa
     public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    //Uno a Muchos
    public function inventories(){
        return $this->hasMany('App\Models\Inventory');
    }

    //Uno a Muchos
    public function devices(){
        return $this->hasMany('App\Models\Device');
    }

    //Uno a Muchos
    public function safeties(){
        return $this->hasMany('App\Models\Safety');
    }

    //Uno a Muchos
    // public function schedules(){
    //     return $this->hasMany('App\Models\Schedule');
    // }

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

    //Uno a Muchos
    public function admonitions(){  //Todas las amonestaciones que tiene un usuario
        return $this->hasMany('App\Models\Admonition');
    }

    //Uno a Muchos
    public function admonitionsRequested(){ //Todas las solicitudes de amonestación que dió un usuario
        return $this->hasMany('App\Models\Admonition');
    }

    //Uno a Muchos
    public function admonitionsDischarged(){ //Todas las amonestaciones que dió dealta un usuario
        return $this->hasMany('App\Models\Admonition');
    }

    //Uno a Muchos
    public function administrativeRecordsDischarged(){ //Todas las actas administrativas que subio un usuario
        return $this->hasMany('App\Models\AdministrativeRecord');
    }

    //Uno a Muchos
    public function collaborationsInAdministrativeRecords(){ //Todas las actas administrativas que tiene un usuario
        return $this->hasMany('App\Models\AdministrativeRecord');
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

    //Muchos a Muchos
    public function inDevices(){
        return $this->belongsToMany('App\Models\Device');
    }

    //Uno a Muchos
    public function extraHours(){
        return $this->hasMany('App\Models\ExtraHour');
    }

    //Uno a Muchos inversa
    public function cost_center(){
        return $this->belongsTo('App\Models\CostCenter');
    }

    //Uno a muchos polimorfico
    public function schedules(){
        return $this->morphMany('App\Models\Schedule', 'scheduleble');
    }

    public function encargado($encargado){
        return User::where('id', $encargado)->first();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }
}
