<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use Image;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subCategory = SubCategory::orderBy('id', 'desc')->get();
        return view('backend.subCategory.index', compact('subCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::orderBy('name', 'asc')->get();
        return view('backend.subCategory.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $subCategory = SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        if ($request->hasFile('logo')) {
            @unlink('storage/'.$subCategory->logo);
            $this->_uploadImage($request, $subCategory);
        }

        return redirect()->route('subCategory.index')->with('success', 'Sub Category created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
        $category = Category::orderBy('name', 'asc')->get();
        return view('backend.subCategory.edit',[
            'edit' => $subCategory,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $subCategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        if ($request->hasFile('logo')) {
            @unlink('storage/'.$subCategory->logo);
            $this->_uploadImage($request, $subCategory);
        }

        return redirect()->route('subCategory.index')->with('success', 'Sub Category created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        //
        $subCategory->delete();
        if(!empty($event->logo));
        @unlink('storage/'.$subCategory->logo);

        return redirect()->route('subCategory.index')->with('status','Data deleted successfully!');
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
