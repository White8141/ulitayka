<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traveler extends Model
{
    //
    protected $fillable = [
        'first_name', 'last_name', 'birth_date', 'pass_data'
    ];

    public function policies () {
        return $this->belongsTo(Policy::class);
    }
}
