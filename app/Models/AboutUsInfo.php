<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsInfo extends Model
{
     protected $table = 'about_us_infos';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    protected $casts = [
        'image' => 'array',
    ];
}
