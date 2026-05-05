<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRating extends Model
{
    protected $fillable = ['project_id', 'rating', 'ip_address'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
