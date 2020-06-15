<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicadors extends Model
{
    protected $fillable = [
        'name'
    ];

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

}
