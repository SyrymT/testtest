<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'abstract', 'keywords', 'file_path', 'plagiarism_score',
        'section_id', 'locale', 'status', 'submission_progress'
    ];

    public function authors()
    {
        return $this->hasMany(Author::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}