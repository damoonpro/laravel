<?php

namespace App\Module\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'label',
        'slug',
    ];
}
