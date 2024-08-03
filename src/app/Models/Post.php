<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorite_users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
