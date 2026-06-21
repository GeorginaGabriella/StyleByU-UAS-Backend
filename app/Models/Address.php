<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'recipient_name',
        'phone',
        'full_address',
        'city',
        'postal_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}