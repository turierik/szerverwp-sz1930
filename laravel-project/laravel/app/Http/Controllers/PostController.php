<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreOrUpdateRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            // 'posts' => Post::all()
            'posts' => Post::with('user') -> get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Post::class);

        return view('posts.create', [
            'users' => User::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreOrUpdateRequest $request)
    {
        Gate::authorize('create', Post::class);

        $validated = $request -> validated();
        $validated['author_id'] = Auth::user() -> id;

        $p = Post::create($validated);
        $p -> categories() -> sync($validated['categories'] ?? []);

        Session::flash('post-created', $p);
        return redirect() -> route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', [ 'post' => $post ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.edit', [
            'users' => User::all(),
            'categories' => Category::all(),
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostStoreOrUpdateRequest $request, Post $post)
    {
        Gate::authorize('update', $post);

        $validated = $request -> validated();

        $post -> update($validated);
        $post -> categories() -> sync($validated['categories'] ?? []);

        Session::flash('post-updated', $post);
        return redirect() -> route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        
        $post -> delete();
        Session::flash('post-deleted');
        return redirect() -> route('posts.index');
    }
}
