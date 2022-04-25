<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function home()
    {
        $posts = Post::with('category', 'user', 'tags')->orderBy('created_at', 'DESC')->take(5)->get();
        $postFirst2 = $posts->splice(0, 2);
        $postMiddle1 = $posts->splice(0, 1);
        $postLast2 = $posts->splice(0);

        $recentPosts =  Post::with('category', 'user', 'tags')->orderBy('created_at', 'DESC')->paginate(6);

        return view('website.home', [
            'posts' => $posts,
            'recentPosts' => $recentPosts,
            'postFirst2' => $postFirst2,
            'postMiddle1' => $postMiddle1,
            'postLast2' => $postLast2,
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
