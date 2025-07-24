<?php

use Illuminate\Support\Facades\Route;
use App\Models\products;
use App\Http\Controllers\ProductsController;
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
Route::get("/",[ProductsController::class,'home']);

Route::post("/addcart/{product}",[ProductsController::class,'addcart'])->middleware("auth");


//cart
Route::get("/cartlist",[ProductsController::class,'cartlist'])->name("cartlist")->middleware("auth");

Route::put("/checkout/{cartid}",[ProductsController::class,'checkout'])->middleware("auth");

Route::delete("/{id}/cartdelete",[ProductsController::class,'delete'])->name('delete')->middleware("auth");

Route::post('/checkbox', [ProductsController::class, 'checkout'])->name("checkbox")->middleware("auth");



//login
Route::get("/login",[ProductsController::class,'login'])->name("login");

Route::post("/loginverify",[ProductsController::class,'loginverify'])->name("loginpage");

Route::get("/register",[ProductsController::class,'register']);

Route::post("/res_user",[ProductsController::class,'res_user']);

Route::post("/logout",[ProductsController::class,'destroy']);








