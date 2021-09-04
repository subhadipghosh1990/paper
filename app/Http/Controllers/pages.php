<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class pages extends Controller
{
    //

    function index(){
        $product = product::all();
        return view('index', ["product"=>$product]);
    }

    function about(){
        return view('about');
    }

    function productinfo(Request $req){
        
        $product = product::where('id', $req->id)->get()->first();
        return view("product-info", ["product"=>$product]);
    }
}
