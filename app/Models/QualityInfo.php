<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualityInfo extends Model
{
    protected $table = 'quality_infos';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    protected $casts = [
        'image' => 'array',
    ];
}
