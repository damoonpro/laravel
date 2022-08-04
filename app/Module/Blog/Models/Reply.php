<?php

namespace App\Module\Blog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blog_id',
        'parent_id',
        'text',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function blog(){
        return $this->belongsTo(Blog::class);
    }
}
