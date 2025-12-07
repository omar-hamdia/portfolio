<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $casts = [
        'social_links' => 'array',
        'dark_mode' => 'boolean',
    ];
    
    protected $fillable = [
        'site_name',
        'email',
        'phone',
        'social_links',
        'dark_mode',
    ];
}