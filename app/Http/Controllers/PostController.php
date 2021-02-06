<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
public function __construct()
{
    $this->middleware('auth');
}

    public function index()
    {

        return view('posts.index', [
            'posts' => Post::with('user')->latest()->paginate(20) // eager loading
        ]);
    }

    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'body' => 'required',
        ]);

        // create post
        $post = auth()->user()->posts()->create(
            $request->all() // request->all() vrati pole a to mozme hned ulozit do db
        );
        $post->save();
        //redirect
        return redirect()->route('posts');
    }
}
