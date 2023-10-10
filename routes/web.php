<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Aws\S3\S3Client;


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
    return view('login');
});
// Route::get('/login', function () {
//     return view('login');
// });


/* Login Logout */
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/** tbl_orders List */
// Route::get('/realtime-data', 'RealTimeController@getData');
Route::get('/orders', [OrdersController::class, 'index'])->name('orders_all');
Route::get('/getStatus', [OrdersController::class, 'getData'])->name('getStatus');
Route::get('/OrdersList', [OrdersController::class, 'OrdersList'])->name('OrdersList');
Route::get('/order', [OrdersController::class, 'OrdersInfo'])->name('order');
Route::get('/order_update', [OrdersController::class, 'update'])->name('order_update');
Route::get('/show', [OrdersController::class, 'show'])->name('show');
Route::get('/send_sms', [OrdersController::class, 'send_sms'])->name('send_sms');


/** tbl_products List */
Route::get('/Products', [ProductController::class, 'index'])->name('ProductsList');
Route::get('/AddProduct', function () {
    return view('product.product_manage');
})->name('product_manage');
Route::post('/Add', [ProductController::class, 'create'])->name('AddPd');

Route::get('/EditProduct', [ProductController::class, 'store'])->name('editPd');
Route::post('/EditPd', [ProductController::class, 'update'])->name('EditPd');
Route::get('/forget-session', [ProductController::class, 'forgetSession'])->name('forget-session');
/* Update model Database */
// Route::get('/update_model', [ProductController::class, 'update_model']);





// Route::get('/images/{file}',[OrdersController::class, 'show'])->name('images');
Route::get('/images', function () {
});
Route::get('/show1', function () {
    return view('show');
});
