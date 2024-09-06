<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function addNewProduct(Request $request){
            
        \Log::info('Test');
        $newproduct = new Product();
        $newproduct->name = $request->name;
        $newproduct->stock = $request->stock;
        $newproduct->seller_id = Auth::guard('sellers')->user()->id;

        if($newproduct->save()){
            //success
            // \Log::info('New Product Added');
            return redirect()->route('sellerProductsPage')->with('message', 'New Product Added');
         
        }
        else{
            \Log::info('Error Adding New Product');
            return redirect()->route('sellerProductsPage')->with('message', ' Added');

        }
        // $newproduct->
    }

    function editProduct(Request $req, $id){
        $product = Product::find($id);
        // $product->name = $req->name; 
            //Cancelled option to edit name, can uncomment if want 
        $product->stock = $req->stock;
        $product->save();
        return redirect()->route('sellerProductsPage')->with('message', 'Product Stock Updated');

    }

}
