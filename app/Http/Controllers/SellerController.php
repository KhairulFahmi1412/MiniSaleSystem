<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Use App\Models\User;
Use App\Models\Product;
Use App\Models\Purchase;
use Illuminate\Support\Facades\Hash;


class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function sellerLogin(){
        return view('sellerLogin');
    }

    function sellerRegister(Request $request){
        return view('sellerRegister');
    }

    
    function sellerHomepage(){
        //Here need to return all pending purchases for any products that are owned by this seller 
        $seller = Auth::guard('sellers')->user();

        // $products = Product::where('seller_id', $seller->id)->get();
        // $products = Product::where('seller_id', $seller->id)->with(['purchases' => function ($query) {
        //                $query->where('status', 'pending')->with('user');
        //            }])->get();
                   
                
        //this code retrieve all products of this seller, and along it, retrieve all
        //purchases that are pending for each product (eager loading)
        $purchases = Purchase::whereIn('product_id', function($query) use ($seller) {
            $query->select('id')
                  ->from('products')
                  ->where('seller_id', $seller->id);
        })->where('status','pending')->with('product.seller')->orderBy('created_at', 'asc')->get();


        //return products that contains their pending purchases as well 
        return view('sellerhomepage', ['purchases' => $purchases]);
    }

    function sellerLogout(){
        Auth::guard('sellers')->logout();
        return redirect()->route('sellerLogin');
    }

    function sellerNewProductPage(){
        return view('sellerNewProductPage');
    }

       
    function sellerProductsPage(){
        $seller = Auth::guard('sellers')->user();
        $products = Product::where('seller_id', $seller->id)->get();

        return view('sellerProductsPage', ['products' => $products]);
    }

    function sellerAccountPage(){
        $seller = Auth::guard('sellers')->user();
        return view('sellerAccountPage', ['seller' => $seller]);
    }

    function sellerPurchaseHistoryPage(){
        $seller = Auth::guard('sellers')->user();

        $purchases = Purchase::whereIn('product_id', function($query) use ($seller) {
            $query->select('id')
                  ->from('products')
                  ->where('seller_id', $seller->id);
        })->orderBy('updated_at', 'desc')->with('product')->with('user')->get();
            //the whereIn function is used to filter condition based on a set of values 
            //in here, the set of values is returned by the subquery
            //Then, the product_id is checked against the list of values, and if it returns true, then it returns the
            //purchase. 
        // \Log::info($purchases);
        return view('sellerPurchaseHistoryPage', ['purchases' => $purchases]);

    }

    function sellerUpdateAccount(Request $req){
        $seller = Auth::guard('sellers')->user();
        $seller->name = $req->name;
        $seller->shop_name = $req->shop_name;
        $seller->phone_no = $req->phone_no;

        if($seller->save()){
            return back()->with('message', 'Seller Account Information Updated');
        }
        else{
            return back()->withErrors('Seller Account update failed');
        }
    }

    function sellerUpdatePassword(Request $req){
        $seller = Auth::guard('sellers')->user();
        
        if(Hash::check($req->cur_password, $seller->password)){
            $seller->password = bcrypt($req->new_password);
            if($seller->save()){
                return back()->with('message', 'Password updated');
            }
            else{
                return back()->withErrors('Password update failed');
            }
        }
        else{
            return back()->withErrors('Current password is incorrect');
        }

    }
        

    function authSeller(Request $request){
        $credentials = $request->only('email', 'password');
        // \Log::info($credentials);
        if(Auth::guard('sellers')->attempt($credentials)){
            //Success 
            \Log::info('Seller Login success');
            return redirect()->intended('sellerHomepage');
        }   
        else{
            \Log::info('Seller Login fail');
            return back()->withErrors('The given email or password does not match our database');
        }
    }

    function registerSeller(Request $request){
    
        //need to verify if email is unique 
        $sellers = Seller::all();
        foreach($sellers as $curseller){
            if($curseller->email == $request->email){
                return back()->withErrors('Email is already in use');
            }
        }
    
        $newseller = new Seller();
        $newseller->name = $request->name;
        $newseller->email = $request->email;
        $newseller->phone_no = $request->phone_no; 
        $newseller->shop_name = $request->shop_name;
        $newseller->password = bcrypt($request->password);
       
        
        if( $newseller->save()){
           //success 
              \Log::info('Seller Register Success');
              $this->authSeller($request);
            return redirect()->route('sellerHomepage');
        }
        else{
            //fail
            \Log::info('Seller Register Fail');
            return back()->withErrors('User Register Fail');
        }
    }

    }

