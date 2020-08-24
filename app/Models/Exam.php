<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $timestamps = false;
    protected $fillable = [
         'collection_date', 'result_date',  'exam_status', 'person_id' , 'collection_id'
    ];

    public function collectionLocation()
    {
        return $this->belongsTo('App\Models\CollectionLocation');
    }
    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }
}
