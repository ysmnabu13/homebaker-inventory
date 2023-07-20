<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('index');
});

//User Authentication
//Show Register Form
Route::get('/register', [UserController::class,'create']);
//Store New User
Route::post('/users', [UserController::class,'store']);
//Log User Out
Route::post('/logout', [UserController::class, 'logout']);
//Show Login Form
Route::get('/login', [UserController::class,'login']);
//Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//Menu Management
//Search Menu
Route::get('/menu/search', [MenuController::class, 'search']);
//Show Menu List
Route::get('/menu', [MenuController::class,'index']);
//Show Add Menu Form
Route::get('/menu/create', [MenuController::class, 'create']);
//Store Menu Data
Route::post('/menus', [MenuController::class,'store']);
//Manage Menu
Route::get('/menu/manage', [MenuController::class, 'manage'])->name('manageMenu');
//Show Edit Form
Route::get('/menu/{menu}/edit', [MenuController::class,'edit']);
//Update Menu
Route::put('/menu/{menu}', [MenuController::class,'update']);
//Delete Menu
Route::delete('/menu/{menu}', [MenuController::class,'destroy']);
//Show Menu's Cost
Route::get('/cost/{id}', [MenuController::class, 'cost']);
//Show Menu Recipe
Route::get('/recipe/{id}', [MenuController::class, 'recipe']);

//Inventory Management
//Show Inventory List
Route::get('/inventory', [InventoryController::class,'index']);
//Show Add Inventory Form
Route::get('/inventory/create', [InventoryController::class, 'create']);
//Store Inventory Data
Route::post('/inventories', [InventoryController::class,'store']);
//Show Edit Inventory Form
Route::get('/inventory/{inventory}/edit', [InventoryController::class,'edit']);
//Update Products in Inventory
Route::put('/inventory/{inventory}', [InventoryController::class,'update']);
//Delete Products from Inventory
Route::delete('/inventory/{inventory}', [InventoryController::class,'destroy']);
//Generate Inventory Report PDF
Route::get('/inventory/report', [InventoryController::class, 'generateReport']);
//Update Quantity and Status
Route::post('/inventory/{inventory}', [InventoryController::class, 'updateQuantity']);
//Search Products
Route::get('/inventory/search', [InventoryController::class, 'search']);

//Order Management
Route::get('/order', [OrderController::class, 'index']);
//Delete Order
Route::delete('/order/{orders}', [OrderController::class,'delete'])->name('deleteOrder');
//Add Products to Order List
Route::post('/addorder/{id}', [OrderController::class, 'addorder']);
//Update Quantity and Price
Route::post('/order/{id}', [OrderController::class, 'updateQuantity'])->name('updateQuantity');
//Order Products
Route::get('/finalorder', [OrderController::class, 'finalOrder'])->name('finalOrder');
//Generate Order Report PDF
Route::get('/order/report', [OrderController::class, 'generateReport']);