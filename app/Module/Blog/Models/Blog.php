<?php


namespace App\Module\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

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
}
