<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Skintype;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blog = Blog::orderBy('id', 'desc')->get();
        return view('backend.blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $skintype = Skintype::orderBy('name', 'asc')->get();
        return view('backend.blog.create', compact('skintype'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'description' => 'required',
           'skintype_id' => 'required',
        ]);

        $blog = Blog::create([
            'description' => $request->description,
            'skintype_id' => $request->skintype_id,
        ]);
        return redirect()->route('blog.index')->with('success', 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
        $skintype = Skintype::orderBy('name', 'asc')->get();
        return view('backend.blog.edit',[
            'edit' => $blog,
            'skintype' => $skintype
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $request->validate([
            'description' => 'required',
           'skintype_id' => 'required',
        ]);

        $blog->update([
            'description' => $request->description,
            'skintype_id' => $request->skintype_id,
        ]);
        return redirect()->route('blog.index')->with('success', 'Blog created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
        $blog->delete();
      
        return redirect()->route('blog.index')->with('status','Data deleted successfully!');
    }
}
