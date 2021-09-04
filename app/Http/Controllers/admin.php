<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product_type;
use App\Models\product;

//database
use DB;

class admin extends Controller
{
    //

    function index(){
        // $products = DB::table('products')->get();
        $products = product::all();
        $category = product_type::all();
        return view('admin', ["products" => $products, "category"=>$category]);
    }

    function product(Request $req){
        echo "<pre>";
        print_r($req->input());
        print_r($req->file('product'));


        $product = new product;

        $files = $req->file('product');
        $allFiles = [];

        foreach($files as $fl){            
            $allFiles[] = array("img" => $fl->store('products'));
        }

        // print_r(json_encode($allFiles));
        // echo count($allFiles)." ".count($files);


        if(count($allFiles) == count($files)){

            echo "ssss";

            try{
                // DB::table('products')->insert([
                //     "name"=>$req->input('name'),
                //     "amount"=>$req->input('amount'),
                //     "info"=>$req->input('info'),
                //     "sku"=>"pro".rand(),
                //     "images"=>json_encode($allFiles),
                //     "unit_price"=>$req->input('unit')
                // ]);

                $product->name = $req->input('name');
                $product->amount = $req->input('amount');
                $product->info = $req->input('info');
                $product->sku = "pro".rand();
                $product->images = json_encode($allFiles);
                $product->unit_price = $req->input('unit');
                $product->product_type = $req->input('category');
                $product->save();

                return redirect('/dash');
            }
            catch (Exception $e){
                echo $e-> getMessage();
            }

        }
        

    }


    function category(Request $req){

        

        try{
            $product_type = new product_type;
            $product_type->name = $req->input('name');
            $product_type->save();
            return redirect("/dash");
        }
        catch (Exception $e){
            echo $e-> getMessage();
        }

    }

}
