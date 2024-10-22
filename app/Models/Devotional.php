<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devotional extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'bible_text',
        'content',
        'prayer',
        'further_study',
        'am_scriptures',
        'pm_scriptures',
        'audio_path',
        'audio_name',
        'image_url',
        'custom_date', // Add this to the fillable array
        'total_views',
        'created_by',
        'updated_by',
    ];
}
