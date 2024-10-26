<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'year',
        'make',
        'model',
        'vin',
        'usage',
        'primary_use',
        'annual_mileage',
        'ownership',
        'garaging_street',
        'garaging_city',
        'garaging_state',
        'garaging_zip',
    ];

    public function policy()
    {
        return $this->belongsTo(Policy::class); // Vehicle belongs to a policy
    }

    public function coverages()
    {
        return $this->hasMany(Coverage::class); // A vehicle has many coverages
    }
}
