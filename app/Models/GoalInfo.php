<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoalInfo extends Model
{
   protected $table = 'goal_infos';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
