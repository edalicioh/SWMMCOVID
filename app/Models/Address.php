<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street',
        'number',
        'observation',
        'post_code',
        'district_id' ,
        'city_id',
        'state_id',
    ];

    public function person()
    {
        return $this->hasOne('App\Models\Person');
    }
    public function hospital()
    {
        return $this->hasOne('App\Models\Hospital');
    }
}
