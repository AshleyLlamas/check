<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated'];

    protected $dates = ['fecha_de_adquisición'];

    protected $fillable = [
        'propietariable_id',
        'propietariable_type',
        'descripción',
        'fecha_de_adquisición',
        'qr',
        'inventariable_id',
        'inventariable_type',
        'garantia',
        'factura',
        'company_id'
    ];

    public function inventariable(){
        return $this->MorphTo();
    }

    public function propietariable(){
        return $this->MorphTo();
    }

    //Uno a Muchos inversa
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
}
