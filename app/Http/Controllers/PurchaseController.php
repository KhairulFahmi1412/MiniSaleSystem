<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    function addPurchase(Request $req){
        \Log::info($req->all());
        //This is successfully passed, now need to process, redirect, and include success message 
        
        //Create instance of item 
        //No need to verify quantity again, since when the user ordered the quantity has been checked 
        //Save, and return with message if successful 
        //Else, return with error message
        $purchase = new Purchase();
        $purchase->user_id = Auth::user()->id;
        $purchase->product_id = $req->product_id;
        $purchase->quantity = $req->quantity;

        if($purchase->save()){
            \Log::info('Purchase successfully added');
            return back()->with('message', 'Order placed successfully');
        }
        else{
            \Log::info('Purchase failed');
            return back()->withErrors('Order failed');
        }
        

    }

    function processPurchase($id){
        $purchase = Purchase::find($id);
        $product = Product::find($purchase->product_id);

        if($product->stock - $purchase->quantity < 0){
            return back()->withErrors('Not enough stock to process order');
        }
        else{
            $product->stock -= $purchase->quantity;
            $purchase->status = 'processed';

            if($product->save() && $purchase->save()){
                return back()->with('message', 'Order processed');
            }
            else{
                return back()->withErrors('Order processing failed');
            }
        }

    }

    function rejectPurchase($id){
        $purchase = Purchase::find($id);
        $purchase->status = 'rejected';

        if($purchase->save()){
            return back()->with('message', 'Order rejected succesfully');
        }
        else{
            return back()->withErrors('Order rejection failed');
        }
        
    }

    function deletePurchase($id){
        $purchase = Purchase::find($id);
      

        if($purchase->delete()){
            \Log::info("Purchase with id $purchase->id deleted by User with id $purchase->user_id");
            return back()->with('message', 'Order deleted succesfully');
        }
        else{
            return back()->withErrors('Order deletion failed');
        }
        
    }
    
}
