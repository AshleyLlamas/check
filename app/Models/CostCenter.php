<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CostCenter extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $fillable = [
        'folio',
        'company_id'
    ];

    //Uno a Muchos
    public function users(){
        return $this->hasMany('App\Models\User');
    }

    //Uno a Muchos
    public function cost_centers(){
        return $this->hasMany('App\Models\CostCenter');
    }

    //Uno a Muchos
    public function companys(){
        return $this->hasMany('App\Models\Company');
    }
}
