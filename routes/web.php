<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {return inertia('Auth/Login'); });
Route::middleware(['auth'])->group(function () {
    Route::resource('/home', App\Http\Controllers\HomeController::class);
    Route::resource('/customers', App\Http\Controllers\CustomerController::class);
    Route::resource('/suppliers', App\Http\Controllers\SupplierController::class);

    Route::resource('/products', App\Http\Controllers\ProductController::class);
    Route::resource('/packages', App\Http\Controllers\PackageController::class);
    Route::resource('/customer', App\Http\Controllers\CustomerReturnController::class);
    Route::resource('/supplier', App\Http\Controllers\SupplierReturnController::class);

    Route::resource('/users', App\Http\Controllers\UserController::class);
    Route::resource('/orders', App\Http\Controllers\OrderController::class);
    Route::resource('/deliveries', App\Http\Controllers\DeliveryController::class);
    Route::resource('/receives', App\Http\Controllers\ReceivedController::class);
    Route::resource('/sales', App\Http\Controllers\SaleController::class);
    Route::resource('/discounts', App\Http\Controllers\DiscountController::class);
    Route::resource('/pricings', App\Http\Controllers\PricingController::class);
    
    Route::resource('/settings', App\Http\Controllers\SettingController::class);
    Route::resource('/backups', App\Http\Controllers\BackupController::class);
    Route::resource('/terms', App\Http\Controllers\TermController::class);

    Route::resource('/roles', App\Http\Controllers\RoleController::class);

    Route::get('/reports/{type}', [App\Http\Controllers\ReportController::class, 'index']);
    Route::get('reports/{month}/edit', [App\Http\Controllers\ReportController::class, 'edit']);
    Route::get('reports/{month}/sales', [App\Http\Controllers\ReportController::class, 'sales']);
    Route::get('reports/{month}/orders', [App\Http\Controllers\ReportController::class, 'orders']);
    Route::get('reports/{month}/adjustments', [App\Http\Controllers\ReportController::class, 'adjustments']);
    Route::get('reports/{month}/customers', [App\Http\Controllers\ReportController::class, 'customers']);
    Route::get('reports/{month}/suppliers', [App\Http\Controllers\ReportController::class, 'suppliers']);
    Route::get('reports/{month}/reorders', [App\Http\Controllers\ReportController::class, 'reorders']);

    Route::get('/download/{name}', [App\Http\Controllers\BackupController::class, 'download']);
});

require __DIR__.'/auth.php';