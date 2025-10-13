<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryInfo extends Model
{
    protected $table = 'category_infos';

    protected $fillable = [
        'name',
        'image',
    ];

    public function products()
    {
        return $this->hasMany(ProductInfo::class, 'category_id');
    }
}
