<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function home()
    {
        $posts = Post::orderBy('created_at', 'DESC')->take(5)->get();
        $recentPosts =  Post::with('category', 'user', 'tags')->orderBy('created_at', 'DESC')->paginate(6);
        return view('website.home', [
            'posts' => $posts,
            'recentPosts' => $recentPosts
        ]);
    }

    public function about()
    {
        return view('website.about');
    }

    public function category()
    {
        return view('website.category');
    }

    public function contact()
    {
        return view('website.contact');
    }

    public function post($slug)
    {
        $post = Post::with('category', 'user', 'tags')->where('slug', $slug)->first();

        if ($post) {
            return view('website.single', ['post' => $post]);
        } else {
            return redirect('/');
        }
    }
}
