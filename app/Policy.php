<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $table = 'policies';

    protected $fillable = [
        'policy_name', 'company_id', 'status', 'link', 'comments', 'policy_number', 'insurance_programm_uid',
        'policy_currency', 'additional_condition_0', 'additional_condition_1', 'additional_condition_2', 'policy_period_from', 'policy_period_till', 'policy_cost',
        'client_first_name', 'client_last_name', 'client_adress', 'client_tel', 'client_birthdate', 'client_email'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function travelers () {
        return $this->hasMany(Traveler::class);
    }

    public function risks () {
        return $this->hasMany(Risk::class);
    }

    public function countries () {
        return $this->hasMany(Country::class);
    }
    
    public function checks () {
        return $this->hasMany(Check::class);
    }
}
