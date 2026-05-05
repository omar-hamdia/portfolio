<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'title_en', 'description', 'description_en', 'link', 'image', 'images', 'slug', 'github', 'video', 'views_count'];

    protected $casts = [
        'images' => 'array',
    ];

    public function ratings()
    {
        return $this->hasMany(ProjectRating::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?: 0;
    }

    public function getRatingsCountAttribute()
    {
        return $this->ratings()->count();
    }
}
