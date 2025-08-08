<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = ['name', 'location', 'price', 'date'];
    public function requests()
    {
        return $this->hasMany(\App\Models\RequestTrip::class, 'trip_id');
    }
}
