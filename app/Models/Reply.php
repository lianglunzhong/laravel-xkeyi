<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
    	'content', 'reply_content', 'form_id', 'is_deleted'
    ];

    protected $casts = [
    	'visible' => 'boolean',
    	'is_deleted' => 'boolean',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function article()
    {
    	return $this->belongsTo(Article::class);
    }
}
