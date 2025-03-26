<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $category = Category::orderBy('id', 'desc')->get();
        return view('backend.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'logo' => 'required|image|max:2048',
        ]);

        $Category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        if ($request->hasFile('logo')) {
            @unlink('storage/'.$Category->logo);
            $this->_uploadImage($request, $Category);
        }

        return redirect()->route('category.index')->with('success', 'Category created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('backend.category.edit',[
            'edit' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name' => 'required',
            'logo' => 'image|max:2048',
        ]);
        $category->update($request->all());
        if ($request->hasFile('logo')) {
            @unlink('storage/'.$category->logo);
            $this->_uploadImage($request, $category);
        }

        return redirect()->route('category.index')->with('success','Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        if(!empty($event->logo));
        @unlink('storage/'.$category->logo);

        return redirect()->route('category.index')->with('status','Data deleted successfully!');
    }

    private function _uploadImage($request, $about)
    {
        # code...
        if( $request->hasFile('logo') ) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
          
            Image::make($image)->resize(120, 120)->save('storage/' . $filename);
            $about->logo = $filename;
            $about->save();
        }

    }
}
