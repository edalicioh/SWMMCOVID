<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{

    public $timestamps = false;
    
    protected $fillable = [
        'disease_description'
    ];

    public function attendances()
    {
        return $this->belongsToMany('App\Models\Attendance', 'attendences_has_diseases', 'attendence_id', 'disease_id');
    }
}
