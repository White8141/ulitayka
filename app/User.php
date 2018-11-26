<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'user_first_name_ru', 'user_last_name_ru', 'user_first_name_en', 'user_last_name_en', 'user_adress', 'user_tel', 'user_birthdate','user_profile_filled',  'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function policies() {
        return $this->hasMany(Policy::class);
    }
}
