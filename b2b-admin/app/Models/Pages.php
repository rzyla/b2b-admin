<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    protected $table = 'admin_pages';

    protected $fillable = 
    [
        'language_id',
        'symbol',
        'title',
        'lead',
        'description',
        'published',
        'meta_title',
        'meta_words',
        'meta_description'
    ];
}
