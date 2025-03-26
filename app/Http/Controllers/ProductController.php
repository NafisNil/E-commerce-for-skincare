<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Skintype;
use Image;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::orderBy('id', 'desc')->get();
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::orderBy('name', 'asc')->get();
        $subCategory = SubCategory::orderBy('name', 'asc')->get();
        $brand = Brand::orderBy('name', 'asc')->get();
        $skintype = Skintype::orderBy('name', 'asc')->get();
        return view('backend.products.create',[
            'category' => $category,
            'subCategory' => $subCategory,
            'brand' => $brand,
            'skintype' => $skintype
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'regular_price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sku' => 'required',
        ]);

        $product = Product::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'regular_price' => $request->regular_price,
            'skintype_id' => $request->skintype_id,
            'sales_price' => $request->sales_price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'stock_status' => $request->stock_status,
            'featured' => $request->featured,
            'sku' => $request->sku,
        ]);
        if ($request->hasFile('logo')) {
            @unlink('storage/'.$product->logo);
            $this->_uploadImage($request, $product);
        }
   
        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;
        if ($request->hasFile('images')) {
            # code...
            $allowedfileExtension = ['jpg', 'png', 'jpeg', 'gif'];
            $files = $request->file('images');
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $filename = time() . $counter . '.' . $extension;
                    Image::make($file)->resize(600, 600)->save('storage/' . $filename);
                   array_push($gallery_arr, $filename);
                  
                    $counter++;
                }
            }
            $gallery_images = implode(',', $gallery_arr);
            $product->images = $gallery_images;
        }
     
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return view('backend.products.show',[
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $category = Category::orderBy('name', 'asc')->get();
        $subCategory = SubCategory::orderBy('name', 'asc')->get();  
        $skintype = Skintype::orderBy('name', 'asc')->get();
        $brand = Brand::orderBy('name', 'asc')->get();
        return view('backend.products.edit',[
            'edit' => $product,
            'category' => $category,
            'subCategory' => $subCategory,
            'brand' => $brand,
            'skintype' => $skintype
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    
        $request->validate([
            'name' => 'required',
            'regular_price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sku' => 'required',
        ]);
        $product->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'brand_id' => $request->brand_id,
            'skintype_id' => $request->skintype_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'regular_price' => $request->regular_price,
            'sales_price' => $request->sales_price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'stock_status' => $request->stock_status,
            'featured' => $request->featured,
            'sku' => $request->sku,
        ]);
        if ($request->hasFile('logo')) {
            @unlink('storage/'.$product->logo);
            $this->_uploadImage($request, $product);
        }

        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;
        if ($request->hasFile('images')) {
            # code...
            foreach (explode(',',$product->images)  as $key => $value) {
                # code...
                @unlink('storage/'.$value);
            }
            $allowedfileExtension = ['jpg', 'png', 'jpeg', 'gif'];
            $files = $request->file('images');
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $filename = time() . $counter . '.' . $extension;
                    Image::make($file)->resize(600, 600)->save('storage/' . $filename);
                   array_push($gallery_arr, $filename);
                  
                    $counter++;
                }
            }
            $gallery_images = implode(',', $gallery_arr);
            $product->images = $gallery_images;
        }
      
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
       
        if(!empty($product->logo))
        @unlink('storage/'.$product->logo);

        if(!empty($product->images)){
            # code...
            foreach (explode(',',$product->images)  as $key => $value) {
                # code...
                @unlink('storage/'.$value);
            }
        }
        $product->delete();

        return redirect()->route('products.index')->with('status','Product deleted successfully!');
    }

    private function _uploadImage($request, $about)
    {
        # code...
        if( $request->hasFile('logo') ) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
          
            Image::make($image)->resize(600, 600)->save('storage/' . $filename);
            $about->logo = $filename;
            $about->save();
        }

    }
}
