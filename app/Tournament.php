<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'id',
        'name',
        'category',
        'begin',
        'end',
        'country',
        'city',
        'website'
    ];
}
