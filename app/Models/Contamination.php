<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contamination extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'contamination_description','possible_location'
    ];

    public function persons()
    {
        return $this->hasMany('App\Models\Person');
    }

}
