<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AchievementInfo extends Model
{
    protected $table = 'achievement_infos';

    protected $fillable = [
        'title',
        'image',
        'count',
    ];

    protected $casts = [
        'count' => 'integer',
    ];
}
