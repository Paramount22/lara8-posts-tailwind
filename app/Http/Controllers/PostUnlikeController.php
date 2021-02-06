<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostUnlikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        if( $post->unLikedBy($request->user() ) ) {
        return response(null, 409);
    }
        $post->unlikes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();

    }
}
