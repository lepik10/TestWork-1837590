<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    public function deleted(Post $post)
    {
        Storage::deleteDirectory($post->id);
    }
}
