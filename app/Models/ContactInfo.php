<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'contact_infos';

    protected $fillable = [
        'address_image',
        'address',
        'phone_image',
        'phone',
        'email_image',
        'email',
    ];

    protected $casts = [
        'phone' => 'array',
        'email' => 'array',
    ];
}
