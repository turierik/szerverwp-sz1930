<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function index(){
        return Post::all();
    }

    public function show(Post $post){
        return $post;
    }

    public function store(Request $request){
        $validated = $request -> validate([
            'title' => 'required|max:20',
            'content' => 'required|min:10',
            //'author_id' => 'required|integer|exists:users,id',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|exists:categories,id',
            'imagefile' => 'nullable|file|image'
        ]);
        $validated['author_id'] = $request -> user() -> id;
        $post = Post::create($validated);
        return response($post, 201);
    }

    public function login(Request $request){
        $validated = $request -> validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $validated['email']) -> first();
        if ($user){
            if (Auth::attempt($validated)){
                $token = $user -> createToken($user -> email, []);
                return [
                    "token" => $token -> plainTextToken
                ];
            } else return ["errors" => ["Login failed."]];
        } else return ["errors" => ["Login failed."]];
    }
}
