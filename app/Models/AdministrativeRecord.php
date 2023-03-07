<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AdministrativeRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $dates = ['fecha_del_permiso'];

    protected $fillable = [
        'colaborador_id',
        'admonition_type_id',
        'comentarios_del_colaborador',
        'observaciones',
        'fecha_del_permiso',
        'categoria_del_permiso',
        'alta_id'
    ];

    //Uno a Muchos inversa
    public function colaborador(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Muchos inversa
    public function alta(){
        return $this->belongsTo('App\Models\User');
    }

    //Uno a Muchos inversa
    public function admonitionType(){
        return $this->belongsTo('App\Models\AdmonitionType');
    }
}
