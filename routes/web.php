<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConveyingController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ConveyingEquipmentController;
use App\Models\AuthModel;
use App\Models\MaterialModel;
use App\Models\OrderModel;
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
    $recentOrderBillet = OrderModel::latest()->take(3)->get();
    $allUsers = AuthModel::latest()->get();
    return view('dashboard', compact(["materialItems", "countMaterial", 'recentOrderBillet', 'allUsers']));
});

// Order Billet
Route::get('/order', [OrderController::class, "orderPage"]);
Route::post('/order-billet/{id}', [OrderController::class, "orderBillet"]);
Route::get('/status-order', [OrderController::class, "statusOrder"]);
Route::put('/confirm-sawing-billet/{id}', [OrderController::class, "konfirmasiStatus"]);

// Conveying Equipment
// Route::get('/billet-stacker', [ConveyingController::class, "billetStacker"]);
Route::post('/conveying-equipment/{id}', [ConveyingController::class, "billetStackerStore"]);
Route::get('/detail/conveying/{id}', [ConveyingController::class, "detailBillet_page"]);


Route::get('/create-material', [MaterialController::class, "viewPage_createMaterial"]);
Route::post('/create-material-store', [MaterialController::class, "store_createMaterial"]);
Route::get('/edit-material/{id}', [MaterialController::class, "viewPage_editMaterial"]);
Route::put('/edit-material-store/{id}', [MaterialController::class, "store_editMaterial"]);
Route::get('/delete-material/{id}', [MaterialController::class, "delete_material"]);

// Conveying Equipment
Route::get('/conveying-equipment', [ConveyingController::class, "viewPage_conveyingEquipment"]);

// Auth
// Register
Route::get('/register', [AuthController::class, "regisPage"]);
Route::post('/register/store', [AuthController::class, "register_store"]);
// Login
Route::get('/login', [AuthController::class, "loginPage"]);
Route::post('/login/store', [AuthController::class, "login_store"]);
Route::get('/logout', [AuthController::class, "logout"]);
// Lupa password
Route::get('/lupa-password', [AuthController::class, "lupaPassword_page"]);
Route::put('/lupa-password/store', [AuthController::class, "lupaPassword_store"]);

Route::get('/info', function () {
    phpinfo();
});
Route::get('/get-data', [OrderController::class, 'getData']);


