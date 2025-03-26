<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ShopController extends Controller
{
    //
    public function index(){
        $data['product'] = Product::orderBy('id', 'desc')->paginate(9);
        return view('frontend.shop', $data );
    }

    public function product_details($slug){
        $data['product']  = Product::where('slug', $slug)->first();
        return view('frontend.details', $data );
    }
}
