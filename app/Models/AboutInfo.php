<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutInfo extends Model
{
    protected $table = 'about_infos';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
