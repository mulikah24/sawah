<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
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

    // إضافة دالة للتحقق من الدور
    public function hasRole($role)
    {
        return $this->role === $role;
    }
    public function suggestions()
{
    return $this->hasMany(Suggestion::class);
}
}

