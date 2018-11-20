<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    //
    protected $fillable = [
        'risk_name', 'risk_amount'
    ];

    public function policies () {
        return $this->belongsTo(Policy::class);
    }
}
