<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image_path',
        'is_published',
        'category_id'
    ];

    //relacion de uno a muchos inversa
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //relacion de muchos a muchos inversa
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
