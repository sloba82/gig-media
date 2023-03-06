<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;


class PostController extends Controller
{
    public function index(Request $request)
    {


        $post = Post::paginate(3);
        return new PostResource($post);


    }
}
