<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
    	'title', 'body', 'image', 'user_id', 'category_id', 'view_count', 'reply_count', 'visible', 'excerpt', 'slug',
    ];

    protected $casts = [
    	'visible' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function availReplies()
    {
        return $this->replies()
                    ->where('is_deleted', false)
                    ->where('visible', true)
                    ->orderBy('id', 'desc')
                    ->get();
    }

    public function getImageUrlAttribute()
    {
    	if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
    		return $this->attributes['image'];
    	}

    	return \Storage::disk('public')->url($this->attributes['image']);
    }
}
