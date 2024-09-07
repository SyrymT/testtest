<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedArticle extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'doi', 'published_at'];
}