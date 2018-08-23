<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'name', 'descripion', 'visible',
    ];

    protected $casts = [
    	'visiable' => 'boolean',
    ];

    public function articles()
    {
    	return $this->hasMany(Article::class);
    }
}
