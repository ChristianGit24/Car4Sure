<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $fillable = [
        'policy_no',
        'status',
        'type',
        'effective_date',
        'expiration_date',
        'policy_holder_id'
    ];

    public function policyHolder()
    {
        return $this->belongsTo(PolicyHolder::class);
    }
}
