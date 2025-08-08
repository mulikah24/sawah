<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{

    use HasRoles;
    use HasFactory, Notifiable; 
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
    
    
    public function requests()
    {
        return $this->hasMany(\App\Models\UserRequest::class);
    }

    
    public function suggestions()
{
    return $this->hasMany(Suggestion::class);
}
}

