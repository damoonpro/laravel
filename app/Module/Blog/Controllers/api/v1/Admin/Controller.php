<?php

namespace App\Module\Blog\Controllers\api\v1\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Module\Blog\Models\Blog;
use App\Tools\Helpers;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function confirmed(Blog $blog){
        $blog->update([
            'confirmed' => ! $blog->confirmed
        ]);

        $messages = [
            'وبلاگ با موفقیت غیرفعال شد',
            'وبلاگ با موفقیت فعال شد',
        ];

        return Helpers::responseWithMessage($messages[$blog->confirmed], [
            'blog' => [
                'slug' => $blog->slug
            ]
        ]);
    }
}
