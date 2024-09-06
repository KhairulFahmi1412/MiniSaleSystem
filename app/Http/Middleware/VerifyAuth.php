<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Seller;

class VerifyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $classString): Response
    {
        // \Log::info(Auth::user());
        
        if($classString == 'User'){
            //User
            if(Auth::user() instanceof User){
                // \Log::info('This user is valid');
                //The $class will be either the seller or user class, depending on the arguements passed by specific routes 
                return $next($request); // This line calls the route. So need logic before it
            }
            // \Log::info('This user is invalid');
        //    return redirect()->route('userLogin');

            return redirect()->guest(route('userLogin'))->withErrors('Please login first');
                //using guest will store the intended route that triggers this middleware
                //this allows the intended page to be opened after the user logs in 
        }
        else if($classString == 'Seller'){
            //Seller
            if(Auth::guard('sellers')->user() instanceof Seller){
                // \Log::info('This seller is valid');
                return $next($request);
            }
            // \Log::info('This seller is invalid');
           return redirect()->guest(route('sellerLogin'))->withErrors('Please login first');

        }
    
    }
}
