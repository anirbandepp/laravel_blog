<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.category.create');
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

        $category = Category::create([
            'name' => $r->name,
            'slug' => Str::slug($r->name, '_'),
            'description' => $r->description
        ]);

        Session::flash('success', 'Created created successfully');
        return redirect()->route('category_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        // validation
        $this->validate($r, [
            'name' => 'required|unique:categories,name'
        ]);

        $category = Category::find($id);

        $category->name = $r->name;
        $category->slug =  Str::slug($r->name, '_');
        $category->description = $r->description;
        $category->update();

        Session::flash('success', 'Category updated successfully');
        return redirect()->route('category_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $r, $id)
    {
        $obj = Category::find($id);
        $obj->delete();

        Session::flash('success', 'Category deleted successfully');
        return redirect()->route('category_index');
    }
}
