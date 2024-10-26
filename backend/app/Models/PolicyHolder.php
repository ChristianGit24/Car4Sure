<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyHolder extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'city'
    ];

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }
}
