<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'symptom_description'
    ];

    public function attendances()
    {
        return $this->belongsToMany('App\Models\Attendence' , 'attendence_symptom' , 'attendence_id' , 'symptom_id');
    }

}
