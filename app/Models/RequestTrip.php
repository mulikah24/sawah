<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'user_id',
        'name',
        'email',
        'phone',
        'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}