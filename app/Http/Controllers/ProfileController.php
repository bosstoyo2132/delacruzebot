<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // SHOW ALL POSTS
    public function index()
    {
        $posts = Post::all();
        return view('dashboard', compact('posts'));
    }

    // STORE NEW POST
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Post::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

    // UPDATE POST
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $post->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }

    // DELETE POST
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }
}
