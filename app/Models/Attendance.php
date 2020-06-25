<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'exam_result',
        'annotations',
        'status_attendance',
        'person_id',
        'hospital_id',
        'discharge_date'
    ];

    public function person()
    {
        return $this->belongsTo('App\Model\Person');
    }

    public function indicadors()
    {
        return $this->belongsToMany('App\Models\Indicadors');
    }

    public function symptoms()
    {
        return $this->belongsToMany('App\Models\Symptom', 'attendance_symptom', 'attendance_id', 'symptom_id');
    }

    public function diseases()
    {
        return $this->belongsToMany('App\Models\Disease', 'attendance_disease', 'attendance_id', 'disease_id');
    }
}
