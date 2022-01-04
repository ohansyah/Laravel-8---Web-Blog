<?php

namespace App\Services;

use App\Exceptions\PostNotFoundException;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{

    public function validateUserPost($post_id)
    {
        $post = Post::where(['id' => $post_id, 'user_id' => Auth::id()])->first();
        if (!$post) {
            throw new PostNotFoundException('The provided credentials do not match our records');
        }
        return $post;
    }

    /**
     * Validate Owner of the Post
     *
     * @param int posts->user_id
     */
    public function isOwner($user_id)
    {
        $isOwner = false;
        if ($user_id == Auth::id()) {
            $isOwner = true;
        }

        return $isOwner;
    }
}
