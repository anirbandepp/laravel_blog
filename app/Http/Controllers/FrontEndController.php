<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Cache\RateLimiting\Limit;
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

        $footerPosts = Post::with('category', 'user', 'tags')->inRandomOrder()->limit(4)->get();
        $footerPostFirst1 = $footerPosts->splice(0, 1);
        $footerPostMiddle2 = $footerPosts->splice(0, 2);
        $footerPostLast1 = $footerPosts->splice(0, 1);

        return view('website.home', [
            'posts' => $posts,
            // Top Group Post
            'recentPosts' => $recentPosts,
            'postFirst2' => $postFirst2,
            'postMiddle1' => $postMiddle1,
            'postLast2' => $postLast2,

            // Footer Group Post
            'footerPostFirst1' => $footerPostFirst1,
            'footerPostMiddle2' => $footerPostMiddle2,
            'footerPostLast1' => $footerPostLast1,
        ]);
    }

    public function about()
    {
        return view('website.about');
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $posts = Post::where('category_id',  $category->id)->with('category', 'user', 'tags')->paginate(2);
            return view('website.category', [
                'category' => $category,
                'posts' => $posts
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function contact()
    {
        return view('website.contact');
    }

    public function post($slug)
    {
        $post = Post::with('category', 'user', 'tags')->where('slug', $slug)->first();
        $posts = Post::with('category', 'user', 'tags')->inRandomOrder()->limit(3)->get();
        $categories = Category::all();
        $tags = Tag::all();

        if ($post) {
            return view('website.single', [
                'post' => $post,
                'posts' => $posts,
                'categories' => $categories,
                'tags' => $tags,
            ]);
        } else {
            return redirect('/');
        }
    }
}
