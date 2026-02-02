<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [

        'category_id',
        'title',
        'slug',
        'content',
        'color',
        'thumbnail',
        'tags',
        'published',
    ];

    protected $casts = [
        'tags' => 'array',
        'published' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_post')->withPivot('order')->orderBy('order');
    }
}
