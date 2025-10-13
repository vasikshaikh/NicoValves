<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnquiryInfo extends Model
{
    protected $table = 'enquiry_infos';

    protected $fillable = [
       'name',
        'email',
        'address',
        'company',
        'message',
    ];
}
