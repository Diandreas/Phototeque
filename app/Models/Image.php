<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'identification_number',
        'creation_date',
        'author',
        'source',
        'support',
        'dimensions',
        'color',
        'technique',
        'description',
        'main_subject',
        'represented_elements',
        'actions_represented',
        'context',
        'keywords',
        'path',
        'size',
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class, 'term_has_images', 'image_id', 'term_id');
    }
}
