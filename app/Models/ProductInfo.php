<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
   protected $table = 'product_infos'; 
    protected $fillable = [
        'category_id',
        'image',
        'title',
        'description',
        'document',
    ];

    protected $casts = [
        'image' => 'array', 
    ];

    
    public function category()
    {
        return $this->belongsTo(CategoryInfo::class, 'category_id');
    }
}
