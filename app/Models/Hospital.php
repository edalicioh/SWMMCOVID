<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'hospital_name' ,'icu_beds','hospital_location' , 'infirmary_beds', 'address_id'
    ];

    public function persons()
    {
        return $this->hasMany('App\Models\Person');
    }
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
}
