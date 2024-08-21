<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'size', 'description'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class, 'term_has_images', 'image_id', 'term_id');
    }
}
