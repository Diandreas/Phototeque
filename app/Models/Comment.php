<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'image_id'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_comments', 'comment_id', 'user_id');
    }
}
