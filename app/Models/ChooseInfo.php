<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChooseInfo extends Model
{
    protected $table = 'choose_infos';

    protected $fillable = [
        'title',
        'description',
        'points_title',
        'points_image',
    ];

    protected $casts = [
        'points_title' => 'array',
        'points_image' => 'array',
    ];
}
