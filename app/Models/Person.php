<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'person_name',
        'gender',
        'cpf',
        'sus_id',
        'birth_date',
        'age',
        'phone',
        'work_status',
        'patient',
        'person_status',
        'first_medical_care',
        'address_id',
        'user_id',
        'company_id',
        'contaminations_id',
        'hospital_id',
        'excluded'
    ];

    public function contamination()
    {
        return $this->belongsTo('App\Model\Contamination');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    public function exams()
    {
        return $this->belongsToMany('App\Models\Person', 'person_has_exame', 'person_id', 'exam_id');
    }
}
