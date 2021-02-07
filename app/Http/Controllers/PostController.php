<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store', 'destroy');
    }

    public function index()
    {

        return view('posts.index', [
            'posts' => Post::latest()->with('user', 'likes', 'unlikes')->paginate(20) // eager loading
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
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

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return back();

    }
}
