<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderInfo extends Model
{
    protected $table = 'slider_infos';

    protected $fillable = [
        'title',
        'slider_image',
    ];
}
