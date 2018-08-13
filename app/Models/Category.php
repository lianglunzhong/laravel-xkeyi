<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'name', 'descripion', 'visiable',
    ];

    protected $casts = [
    	'visiable' => 'boolean',
    ];
}
