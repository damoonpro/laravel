<?php


namespace App\Module\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Blog extends Model
{
    use HasFactory, HasPersianSlug;

    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'description',
        'body',
        'meta_title',
        'meta_description',
        'confirmed',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('label')
            ->saveSlugsTo('slug');
    }
}
