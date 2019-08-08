<?php

namespace ChessT;

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
        'address',
        'longitude',
        'latitude',
        'website',
        'user_id',
    ];
}
