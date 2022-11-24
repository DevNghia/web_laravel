<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'blog_title', 'blog_image', 'blog_content'
    ];
    protected $primaryKey = "blog_id";
    protected $table = 'tbl_blog';
}
