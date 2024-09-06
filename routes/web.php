<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\VerifyAuth;

//User
//Navi routes
Route::get('/', [UserController::class, 'userLogin' ])->name('userLogin');
Route::get('/userRegister', [UserController::class, 'userRegister' ])->name('userRegister');
//Process routes
Route::post('/registerUser', [UserController::class, 'registerUser'])->name('registerUser');
Route::post('/authUser', [UserController::class, 'authUser'])->name('authUser');
Route::get('/userLogout', [UserController::class, 'userLogout'])->name('userLogout');
Route::post('/addPurchase', [PurchaseController::class, 'addPurchase'])->name('addPurchase');
Route::post('/deletePurchase/{id}', [PurchaseController::class, 'deletePurchase'])->name('deletePurchase');

//Seller
//Navi route
Route::get('/sellerLogin', [SellerController::class, 'sellerLogin'])->name('sellerLogin');
Route::get('/sellerRegister', [SellerController::class, 'sellerRegister'])->name('sellerRegister');
//Process route
Route::post('/authSeller', [SellerController::class, 'authSeller'])->name('authSeller');
Route::post('/registerSeller', [SellerController::class, 'registerSeller'])->name('registerSeller');
Route::get('/sellerLogout', [SellerController::class, 'sellerLogout'])->name('sellerLogout');
Route::post('/addNewProduct', [ProductController::class, 'addNewProduct'])->name('addNewProduct');
Route::post('/editProduct/{id}', [ProductController::class, 'editProduct'])->name('editProduct');
Route::post('/processPurchase/{id}', [PurchaseController::class, 'processPurchase'])->name('processPurchase');
Route::post('/rejectPurchase/{id}', [PurchaseController::class, 'rejectPurchase'])->name('rejectPurchase');

//User-specific routes using middleware
Route::middleware([VerifyAuth::class . ':' . 'User'])->group(function () {
    //The : is to pass an arugmenet, since the VerifyAuth expects an arguement
    Route::get('/homepage', [UserController::class, 'userHomepage'])->name('homepage');
    Route::get('/storePage/{id}', [UserController::class, 'storePage'])->name('storePage');
        //need Seller ID
    Route::get('/purchaseHistoryPage', [UserController::class, 'purchaseHistoryPage'])->name('purchaseHistoryPage');
    Route::get('/accountPage', [UserController::class, 'accountPage'])->name('accountPage');
    Route::post('/userUpdateAccount', [UserController::class, 'userUpdateAccount'])->name('userUpdateAccount');
    Route::post('/userUpdatePassword', [UserController::class, 'userUpdatePassword'])->name('userUpdatePassword');
    
});
    //the auth name is based on what is registed in app.php

//Seller-specific routes using middleware 
Route::middleware([VerifyAuth::class . ':' . 'Seller'])->group(function () {
        //The : is to pass an arugmenet, since the VerifyAuth expects an arguement
        Route::get('/sellerHomepage', [SellerController::class, 'sellerHomepage'])->name('sellerHomepage');
        Route::get('/sellerNewProductPage', [SellerController::class, 'sellerNewProductPage'])->name('sellerNewProductPage');
        Route::get('/sellerProductsPage', [SellerController::class, 'sellerProductsPage'])->name('sellerProductsPage');
        Route::get('/sellerPurchaseHistoryPage', [SellerController::class, 'sellerPurchaseHistoryPage'])->name('sellerPurchaseHistoryPage');
        Route::get('/sellerAccountPage', [SellerController::class, 'sellerAccountPage'])->name('sellerAccountPage');
        Route::post('/sellerUpdateAccount', [SellerController::class, 'sellerUpdateAccount'])->name('sellerUpdateAccount');
        Route::post('/sellerUpdatePassword', [SellerController::class, 'sellerUpdatePassword'])->name('sellerUpdatePassword');
        
    });
