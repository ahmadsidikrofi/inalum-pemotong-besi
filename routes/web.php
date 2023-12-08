<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Models\MaterialModel;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $materialItems = MaterialModel::all()->take(4);
    $countMaterial = MaterialModel::count();
    return view('dashboard', compact(["materialItems", "countMaterial"]));
});

// Order Billet
Route::get('/order', [OrderController::class, "orderPage"]);
Route::post('/order-billet/{id}', [OrderController::class, "orderBillet"]);
Route::get('/status-order', [OrderController::class, "statusOrder"]);
Route::put('/confirm-sawing-billet/{id}', [OrderController::class, "konfirmasiStatus"]);


Route::get('/create-material', [MaterialController::class, "viewPage_createMaterial"]);
Route::post('/create-material-store', [MaterialController::class, "store_createMaterial"]);
Route::get('/edit-material/{id}', [MaterialController::class, "viewPage_editMaterial"]);
Route::put('/edit-material-store/{id}', [MaterialController::class, "store_editMaterial"]);
Route::get('/delete-material/{id}', [MaterialController::class, "delete_material"]);

// Auth
// Register
Route::get('/register', [AuthController::class, "regisPage"]);
