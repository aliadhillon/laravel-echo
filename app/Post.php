<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'published'
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = $value ? true : false;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
