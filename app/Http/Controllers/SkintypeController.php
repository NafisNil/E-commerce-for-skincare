<?php

namespace App\Http\Controllers;

use App\Models\Skintype;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Str;
class SkintypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $skintype = Skintype::orderBy('id', 'desc')->get();
        return view('backend.skintype.index', compact('skintype'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.skintype.create');
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

        $skintype = Skintype::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        if ($request->hasFile('logo')) {
            @unlink('storage/'.$skintype->logo);
            $this->_uploadImage($request, $skintype);
        }

        return redirect()->route('skintype.index')->with('success', 'skintype created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skintype $skintype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skintype $skintype)
    {
        //
        return view('backend.skintype.edit',[
            'edit' => $skintype
        ]);
  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skintype $skintype)
    {
        //
        $request->validate([
            'name' => 'required',
            'logo' => 'image|max:2048',
        ]);
        $skintype->update($request->all());
        if ($request->hasFile('logo')) {
            @unlink('storage/'.$skintype->logo);
            $this->_uploadImage($request, $skintype);
        }

        return redirect()->route('skintype.index')->with('success','Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skintype $skintype)
    {
        //
        $skintype->delete();
        if(!empty($event->logo));
        @unlink('storage/'.$skintype->logo);

        return redirect()->route('skintype.index')->with('status','Data deleted successfully!');
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
