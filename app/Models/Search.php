<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;

    protected $table = 'searches';

    protected $fillable = [
        'user_id',
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

    // 🔗 Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
