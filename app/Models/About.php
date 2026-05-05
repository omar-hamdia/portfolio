<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';

    protected $fillable = [
        'title',
        'title_en',
        'content',
        'content_en',
        'image',
        'image_en',
        'cv',
    ];
}
