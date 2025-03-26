<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    //
    public function index(){
        return view('backend.index');
    } 

    public function all_user(){
        $user = User::where('utype', 'USR')->orderBy('id', 'desc')->get();
        return view('backend.all_user', compact('user'));
    }

    public function delete_user($user){
        $user->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully!');
    }
   
}
