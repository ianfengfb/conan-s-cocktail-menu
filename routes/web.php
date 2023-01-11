<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  

// // All Listings
// Route::get('/', [ListingController::class, 'index']);

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// show conan menus
Route::get('/menus', [MenuController::class, 'index']);

// Show Create menu page
Route::get('/menus/create', [MenuController::class, 'create'])->middleware('auth');

// Store Listing Data
Route::post('/menus', [MenuController::class, 'store'])->middleware('auth');

// Show Menu Edit Form
Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->middleware('auth');

// Update Menu
Route::put('/menus/{menu}', [MenuController::class, 'update'])->middleware('auth');

// Delete Menu
Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->middleware('auth');

// toggle menu available
Route::post('/menus/{menu}/available', [MenuController::class, 'available'])->middleware('auth');

// read recipe
Route::post('/menus/recipe', [MenuController::class, 'recipe'])->middleware('auth');

// show conan orders page
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth');;

// show conan cocktails page
Route::get('/cocktails', [OrderController::class, 'cocktails'])->middleware('auth');;

// show conan customers page
Route::get('/customers', [OrderController::class, 'customers'])->middleware('auth');;

// show conan single customer
Route::get('/customers/{customer}', [OrderController::class, 'single_customer'])->middleware('auth');;

// show conan workshop
Route::get('/workshop', [OrderController::class, 'workshop'])->middleware('auth');;

// accept an order
Route::post('/orders/accept/{id}', [OrderController::class, 'accept']);

// decline an order
Route::post('/orders/decline/{id}', [OrderController::class, 'decline']);

// ready an order
Route::post('/orders/ready/{id}', [OrderController::class, 'ready']);

// picked_up an order
Route::post('/orders/picked_up/{id}', [OrderController::class, 'picked_up']);



// show customer menus
Route::get('/customer/menus', [MenuController::class, 'customer_menu']);


// create cart
Route::post('/cart/create', [CartController::class, 'store']);

// read cart
Route::post('/cart/read', [CartController::class, 'read']);

// show customer orders
Route::get('/customer/orders', [OrderController::class, 'customer_order']);

// create orders
Route::post('/order/create', [OrderController::class, 'store']);


// test notifications
Route::get('/test', [OrderController::class, 'test']);

// fire test notifications
Route::post('/test', [OrderController::class, 'fire']);