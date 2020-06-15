<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionLocation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name_location' , 'type_location' , 'address_id'
    ];

}
