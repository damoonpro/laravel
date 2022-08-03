<?php

namespace App\Module\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Bcategory extends Model
{
    use HasFactory, HasPersianSlug;

    protected $fillable = [
        'user_id',
        'parent_id',
        'label',
        'slug',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
        ->generateSlugsFrom('label')
        ->saveSlugsTo('slug');
    }

    public function blogs(){
        return $this->belongsToMany(Blog::class);
    }
}
