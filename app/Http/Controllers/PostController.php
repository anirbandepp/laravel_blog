<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // validation
        $this->validate($r, [
            'title' => 'required|unique:posts,title',
            'image' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        $post = Post::create([
            'title' => $r->title,
            'slug' => Str::slug($r->title, '_'),
            'image' => 'image.jpg',
            'description' => $r->description,
            'category_id' => $r->category_id,
            'user_id' => auth()->user()->id,
            'published_at' => Carbon::now()
        ]);

        $post->tags()->attach($r->tags);

        if ($r->has('image')) {
            $image = $r->image;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/post', $image_new_name);
            $post->image = '/storage/post/' . $image_new_name;
            $post->save();
        }

        Session::flash('success', 'Post created successfully');
        return redirect()->route('post_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.post.edit', [
            'categories' => $categories,
            'post' => $post,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        // validation
        $this->validate($r, [
            'title' => 'required|unique:posts,title',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        $post = Post::find($id);

        $post->title = $r->title;
        $post->slug =  Str::slug($r->title, '_');
        $post->description = $r->description;
        $post->category_id = $r->category_id;
        $post->user_id = auth()->user()->id;
        $post->published_at = Carbon::now();

        $post->tags()->sync($r->tags);

        if ($r->has('image')) {

            $obj = Post::find($id);
            if (file_exists(public_path($obj->image))) {
                unlink(public_path($obj->image));
            }

            $image = $r->image;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/post', $image_new_name);
            $post->image = '/storage/post/' . $image_new_name;
            $post->save();
        }
        $post->update();
        Session::flash('success', 'Post updated successfully');
        return redirect()->route('post_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Post::find($id);

        if (file_exists(public_path($obj->image))) {
            unlink(public_path($obj->image));
        }

        $obj->delete();

        Session::flash('success', 'Category deleted successfully');
        return redirect()->route('post_index');
    }
}
