<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\Seller;
Use App\Models\Product;
Use App\Models\Purchase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function registerUser(Request $req){
        \Log::info('User Registration');
        \Log::info(json_encode($req->all()));

        //Check if email already exists or not 
        $users = User::all();
        foreach($users as $curuser){
            if($req->email == $curuser->email){
                return back()->withErrors('Email is already in use');
            }
        }

        $newuser = new User();
        $newuser->name = $req->name;
        $newuser->email = $req->email;
        $newuser->phone_no = $req->phone_no;
        $newuser->password = bcrypt($req->password);    

        if($newuser->save()){
            \Log::info('User Register Success');
            $this->authUser($req);
            // return view('homepage');
            \Log::info(Auth::user());
            return redirect()->route('homepage');
        }
        else{
            \Log::info('User Register Fail');
            return back()->withErrors('User Register Fail');
        }
    }

    //
    function userLogin(){
        return view('userLogin');
    }

    function userRegister(){
        return view('userRegister');
    }

    function userHomepage(){
        //need to return all seller page 
            //ignore the top 4 product idea first 
        // \Log::info(Seller::all());
        return view('homepage', ['sellers' => Seller::all()]);
    }

    function userLogout(){
        Auth::logout();
        return redirect()->route('userLogin');
    }

  

    function storePage($id){
        //this is the seller id 
        
        //retrieve seller based on id 
        $seller = Seller::find($id);

        //retrieve all products for this seller 
        $products = Product::where('seller_id', $id)->where('stock', '>', 0)->get();

        //pass seller and products back to view 
        return view('storePage', ['seller' => $seller, 'products' => $products, 'seller' => $seller]);
    }

    function purchaseHistoryPage(){
        $user = Auth::user();
        $purchases = Purchase::where('user_id', $user->id)->with('product.seller')->orderBy('created_at', 'desc')->get();

        return view('purchaseHistoryPage', ['purchases' => $purchases]);
    }

    function accountPage(){
        $user = Auth::user();
        return view('accountPage', ['user' => $user]);
    }



    function authUser(Request $req){
        $credentials = $req->only('email', 'password');
        if(Auth::attempt($credentials)){
            //since user is using the default 'web' guard, we dont need to specify it 
            //unlike seller, where we do Auth::guard('sellers')->attempt($credentials)
            \Log::info('User Login success');

            
            // return view('homepage'); This just opens a view. SInce we are using middleware, need to use redirect()
            return redirect()->intended(route('homepage'));
                //We are using route since we want the route to have the middleware

        }
        else{
            \Log::info('User Login fail');
            return back()->withErrors('The given email or password does not match our database');
        }
    }

    

    function userUpdateAccount(Request $req){
        $user = Auth::user();
        $user->name = $req->name;
        $user->phone_no = $req->phone_no;

        if($user->save()){
            return back()->with('message', 'Account information updated');
        }
        else{
            return back()->withErrors('Account update failed');
        }
    }

    function userUpdatePassword(Request $req){
        $user = Auth::user();
        
        if(Hash::check($req->cur_password, $user->password)){
            $user->password = bcrypt($req->new_password);
            if($user->save()){
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
}
