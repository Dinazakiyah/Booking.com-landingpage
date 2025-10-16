<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $fillable = [
        'destination',
        'check_in',
        'check_out',
        'adults',
        'children',
        'rooms',
        'ip_address',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];
}
