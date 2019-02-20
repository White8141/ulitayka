<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $fillable = [
        'check_cost', 'check_key', 'check_status'
    ];

    public function policy () {
        return $this->belongsTo(Policy::class);
    }
}
