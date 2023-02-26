<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
       
    return view('posts', [
        'posts' => Post::latest()->filter(request(['search','category']))->get(),
        'categories' => Category::all(),
        'currentCategory' => Category::firstWhere('slug', request('category'))
    ]);
    }

    public function show(Post $post) {
        return view('post', ['post' => $post, 'categories' => Category::all()]);
    }

    protected function getPosts() {
        $posts = Post::latest();
        if (request('search')){
            $posts
            -> where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%');
        }
    }
} 
