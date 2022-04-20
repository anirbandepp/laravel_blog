<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.tag.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
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
            'name' => 'required|unique:categories,name'
        ]);

        $category = Tag::create([
            'name' => $r->name,
            'slug' => Str::slug($r->name, '_'),
            'description' => $r->description
        ]);

        Session::flash('success', 'Tag created successfully');
        return redirect()->route('tag_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tag.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        // validation
        $this->validate($r, [
            'name' => 'required|unique:categories,name'
        ]);

        $category = Tag::find($id);
        $category->name = $r->name;
        $category->slug =  Str::slug($r->name, '_');
        $category->description = $r->description;
        $category->update();

        Session::flash('success', 'Tag updated successfully');
        return redirect()->route('tag_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Tag::find($id);
        $obj->delete();

        Session::flash('success', 'Category deleted successfully');
        return redirect()->route('tag_index');
    }
}
