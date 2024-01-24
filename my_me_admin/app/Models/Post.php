<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'title',
        'author',
        'image',
         'description',
        'category_id',

    ];
    use HasFactory;
}
