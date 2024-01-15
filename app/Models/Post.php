<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'tags',
        'user_id',
    ];

    function images() {
        return $this->hasMany(Post_image::class, "post_id");
    }

    function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    function comments() {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
