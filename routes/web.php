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

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/orders', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('admin/orders/api', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'api'])->name('orders.api');
    Route::post('admin/orders/fast', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'fast'])->name('orders.fast');
    Route::get('admin/orders/create', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
    Route::post('admin/orders', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('admin/orders/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::post('admin/orders/{model}/status', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'status'])->name('orders.status');
    Route::post('admin/orders/{model}/approve', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'approve'])->name('orders.approve');
    Route::post('admin/orders/{model}/shipping', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'ship'])->name('orders.ship');
    Route::get('admin/orders/{model}/shipping', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'shipping'])->name('orders.shipping');
    Route::get('admin/orders/{model}/print', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'print'])->name('orders.print');
    Route::get('admin/orders/{model}/edit', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'edit'])->name('orders.edit');
    Route::post('admin/orders/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'update'])->name('orders.update');
    Route::delete('admin/orders/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('admin/settings/orders', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'settings'])->name('orders.settings');
    Route::post('admin/settings/orders', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'settingsUpdate'])->name('orders.settings.update');
    Route::post('admin/info/user', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'user'])->name('orders.user');
    Route::post('admin/info/product', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderController::class, 'product'])->name('orders.product');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/orders-items', [\TomatoPHP\TomatoOrders\Http\Controllers\OrdersItemController::class, 'index'])->name('orders-items.index');
    Route::get('admin/orders-items/api', [\TomatoPHP\TomatoOrders\Http\Controllers\OrdersItemController::class, 'api'])->name('orders-items.api');
    Route::get('admin/orders-items/create', [\TomatoPHP\TomatoOrders\Http\Controllers\OrdersItemController::class, 'create'])->name('orders-items.create');
    Route::post('admin/orders-items', [\TomatoPHP\TomatoOrders\Http\Controllers\OrdersItemController::class, 'store'])->name('orders-items.store');
    Route::get('admin/orders-items/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\OrdersItemController::class, 'show'])->name('orders-items.show');
    Route::get('admin/orders-items/{model}/edit', [\TomatoPHP\TomatoOrders\Http\Controllers\OrdersItemController::class, 'edit'])->name('orders-items.edit');
    Route::post('admin/orders-items/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\OrdersItemController::class, 'update'])->name('orders-items.update');
    Route::delete('admin/orders-items/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\OrdersItemController::class, 'destroy'])->name('orders-items.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/order-logs', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderLogController::class, 'index'])->name('order-logs.index');
    Route::get('admin/order-logs/api', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderLogController::class, 'api'])->name('order-logs.api');
    Route::get('admin/order-logs/create', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderLogController::class, 'create'])->name('order-logs.create');
    Route::post('admin/order-logs', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderLogController::class, 'store'])->name('order-logs.store');
    Route::get('admin/order-logs/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderLogController::class, 'show'])->name('order-logs.show');
    Route::get('admin/order-logs/{model}/edit', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderLogController::class, 'edit'])->name('order-logs.edit');
    Route::post('admin/order-logs/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderLogController::class, 'update'])->name('order-logs.update');
    Route::delete('admin/order-logs/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\OrderLogController::class, 'destroy'])->name('order-logs.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/branches', [\TomatoPHP\TomatoOrders\Http\Controllers\BranchController::class, 'index'])->name('branches.index');
    Route::get('admin/branches/api', [\TomatoPHP\TomatoOrders\Http\Controllers\BranchController::class, 'api'])->name('branches.api');
    Route::get('admin/branches/create', [\TomatoPHP\TomatoOrders\Http\Controllers\BranchController::class, 'create'])->name('branches.create');
    Route::post('admin/branches', [\TomatoPHP\TomatoOrders\Http\Controllers\BranchController::class, 'store'])->name('branches.store');
    Route::get('admin/branches/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\BranchController::class, 'show'])->name('branches.show');
    Route::get('admin/branches/{model}/edit', [\TomatoPHP\TomatoOrders\Http\Controllers\BranchController::class, 'edit'])->name('branches.edit');
    Route::post('admin/branches/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\BranchController::class, 'update'])->name('branches.update');
    Route::delete('admin/branches/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\BranchController::class, 'destroy'])->name('branches.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/deliveries', [\TomatoPHP\TomatoOrders\Http\Controllers\DeliveryController::class, 'index'])->name('deliveries.index');
    Route::get('admin/deliveries/api', [\TomatoPHP\TomatoOrders\Http\Controllers\DeliveryController::class, 'api'])->name('deliveries.api');
    Route::get('admin/deliveries/create', [\TomatoPHP\TomatoOrders\Http\Controllers\DeliveryController::class, 'create'])->name('deliveries.create');
    Route::post('admin/deliveries', [\TomatoPHP\TomatoOrders\Http\Controllers\DeliveryController::class, 'store'])->name('deliveries.store');
    Route::get('admin/deliveries/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\DeliveryController::class, 'show'])->name('deliveries.show');
    Route::get('admin/deliveries/{model}/edit', [\TomatoPHP\TomatoOrders\Http\Controllers\DeliveryController::class, 'edit'])->name('deliveries.edit');
    Route::post('admin/deliveries/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\DeliveryController::class, 'update'])->name('deliveries.update');
    Route::delete('admin/deliveries/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\DeliveryController::class, 'destroy'])->name('deliveries.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/shipping-vendors', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingVendorController::class, 'index'])->name('shipping-vendors.index');
    Route::get('admin/shipping-vendors/api', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingVendorController::class, 'api'])->name('shipping-vendors.api');
    Route::get('admin/shipping-vendors/create', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingVendorController::class, 'create'])->name('shipping-vendors.create');
    Route::post('admin/shipping-vendors', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingVendorController::class, 'store'])->name('shipping-vendors.store');
    Route::get('admin/shipping-vendors/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingVendorController::class, 'show'])->name('shipping-vendors.show');
    Route::get('admin/shipping-vendors/{model}/edit', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingVendorController::class, 'edit'])->name('shipping-vendors.edit');
    Route::post('admin/shipping-vendors/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingVendorController::class, 'update'])->name('shipping-vendors.update');
    Route::delete('admin/shipping-vendors/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingVendorController::class, 'destroy'])->name('shipping-vendors.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/shipping-prices', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingPriceController::class, 'index'])->name('shipping-prices.index');
    Route::get('admin/shipping-prices/api', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingPriceController::class, 'api'])->name('shipping-prices.api');
    Route::get('admin/shipping-prices/create', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingPriceController::class, 'create'])->name('shipping-prices.create');
    Route::post('admin/shipping-prices', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingPriceController::class, 'store'])->name('shipping-prices.store');
    Route::get('admin/shipping-prices/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingPriceController::class, 'show'])->name('shipping-prices.show');
    Route::get('admin/shipping-prices/{model}/edit', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingPriceController::class, 'edit'])->name('shipping-prices.edit');
    Route::post('admin/shipping-prices/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingPriceController::class, 'update'])->name('shipping-prices.update');
    Route::delete('admin/shipping-prices/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\ShippingPriceController::class, 'destroy'])->name('shipping-prices.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/companies', [\TomatoPHP\TomatoOrders\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
    Route::get('admin/companies/api', [\TomatoPHP\TomatoOrders\Http\Controllers\CompanyController::class, 'api'])->name('companies.api');
    Route::get('admin/companies/create', [\TomatoPHP\TomatoOrders\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
    Route::post('admin/companies', [\TomatoPHP\TomatoOrders\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
    Route::get('admin/companies/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\CompanyController::class, 'show'])->name('companies.show');
    Route::get('admin/companies/{model}/edit', [\TomatoPHP\TomatoOrders\Http\Controllers\CompanyController::class, 'edit'])->name('companies.edit');
    Route::post('admin/companies/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
    Route::delete('admin/companies/{model}', [\TomatoPHP\TomatoOrders\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');
});
