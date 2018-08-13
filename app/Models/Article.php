<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
    	'title', 'body', 'user_id', 'category_id', 'view_count', 'reply_count', 'visible', 'excerpt', 'slug',
    ];

    protected $casts = [
    	'visible' => 'boolean',
    ];
}
