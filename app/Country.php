<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'country_name'
    ];

    public function policies () {
        return $this->belongsTo(Policy::class);
    }
}
