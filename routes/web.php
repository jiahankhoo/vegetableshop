<?php

use Illuminate\Support\Facades\Route;
use App\Models\products;
use App\http\Controllers\productsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//home
Route::get("/home",[productsController::class,'home']);

Route::post("/addcart/{product}",[productsController::class,'addcart'])->middleware("auth");


//cart
Route::get("/cartlist",[productsController::class,'cartlist'])->name("cartlist");

Route::put("/checkout/{cartid}",[productsController::class,'checkout']);

Route::delete("/{id}/cartdelete",[productsController::class,'delete'])->name('delete');

Route::post('/checkbox', [productsController::class, 'checkout'])->name("checkbox");



//login
Route::get("/login",[productsController::class,'login'])->name("login");

Route::post("/loginverify",[productsController::class,'loginverify'])->name("loginpage");

Route::get("/register",[productsController::class,'register']);

Route::post("/res_user",[productsController::class,'res_user']);

Route::post("/logout",[productsController::class,'destroy']);








