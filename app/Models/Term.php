<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'term_has_images', 'term_id', 'image_id');
    }
}
