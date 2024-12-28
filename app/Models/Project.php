<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image_path'];

    // Append custom attribute to JSON response
    protected $appends = ['full_image_url'];

    // Accessor to generate the full URL
    public function getFullImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}
