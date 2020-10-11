<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ItemController;

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



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');


Route::resource('units', UnitController::class)->middleware(['auth:sanctum', 'verified']);
Route::resource('brands', BrandController::class)->middleware(['auth:sanctum', 'verified']);
Route::resource('warehouses', WarehouseController::class)->middleware(['auth:sanctum', 'verified']);
Route::resource('items', ItemController::class)->middleware(['auth:sanctum', 'verified']);
Route::resource('customers', CustomerController::class)->middleware(['auth:sanctum', 'verified']);
