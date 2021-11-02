<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    // show the fields that are fillable so as to protect them from unwanted entries for CREATE BLOG POST
    protected $fillable = ['title', 'body', 'user_id'];

}
