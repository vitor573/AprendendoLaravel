<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts  = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body'=> 'required',
        ]);
        Post::create($request->all());
        return redirect()->route('post.index')
        ->with('success','Postagem criada com sucesso.');
    }

    public function show(string $id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body'=> 'required',
        ]);
        $post = Post::find($id);
        $post->update($request->all());
        return redirect()->route('post.index')
            ->with('success', 'Postagem atualizada com sucesso');
    }

    public function destroy(string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body'=> 'required',
        ]);
        $post = Post::find($id);
        $post->delete();
    }
}
