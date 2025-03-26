<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('backend.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.brands.create');
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

        $brand = Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        if ($request->hasFile('logo')) {
            @unlink('storage/'.$brand->logo);
            $this->_uploadImage($request, $brand);
        }

        return redirect()->route('brands.index')->with('success', 'Brand created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
        return view('backend.brands.edit',[
            'edit' => $brand
        ]);
  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
        $request->validate([
            'name' => 'required',
            'logo' => 'image|max:2048',
        ]);
        $brand->update($request->all());
        if ($request->hasFile('logo')) {
            @unlink('storage/'.$brand->logo);
            $this->_uploadImage($request, $brand);
        }

        return redirect()->route('brands.index')->with('success','Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
        $brand->delete();
        if(!empty($event->logo));
        @unlink('storage/'.$brand->logo);

        return redirect()->route('brands.index')->with('status','Data deleted successfully!');
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
