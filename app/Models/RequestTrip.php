<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestTrip extends Model
{
    protected $fillable = ['user_id', 'trip_id', 'details', 'status'];
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
