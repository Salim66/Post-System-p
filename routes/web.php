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

// Route::get('/', function () {
//     return view('welcome');
// });

//Frontend
Route::get('/', 'App\Http\Controllers\Frontend\FrontendController@index');
Route::get('/about-us', 'App\Http\Controllers\Frontend\FrontendController@aboutUs')->name('about.us');
Route::get('/contact-us', 'App\Http\Controllers\Frontend\FrontendController@contactUs')->name('contact.us');
Route::get('/news-events/details/{id}', 'App\Http\Controllers\Frontend\FrontendController@newsEventsDetails')->name('news_events.details');
Route::get('/our-mission', 'App\Http\Controllers\Frontend\FrontendController@ourMission')->name('our.mission');
Route::get('/our-vission', 'App\Http\Controllers\Frontend\FrontendController@ourVission')->name('our.vission');
Route::get('/news-and-events', 'App\Http\Controllers\Frontend\FrontendController@newsAndEvents')->name('news.events');
Route::post('/communicate/user', 'App\Http\Controllers\Frontend\FrontendController@communicateUser')->name('user.communicate');


Auth::routes();

//Backend
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::prefix('users')->group(function () {
        Route::get('/view', 'App\Http\Controllers\Backend\UserController@view')->name('users.view');
        Route::get('/add', 'App\Http\Controllers\Backend\UserController@add')->name('users.add');
        Route::post('/store', 'App\Http\Controllers\Backend\UserController@store')->name('users.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\Backend\UserController@edit')->name('users.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\Backend\UserController@update')->name('users.update');
        Route::get('/delete/{id}', 'App\Http\Controllers\Backend\UserController@delete')->name('users.delete');
    });

    Route::prefix('profiles')->group(function () {
        Route::get('/view', 'App\Http\Controllers\Backend\ProfileController@view')->name('profile.view');
        Route::get('/edit', 'App\Http\Controllers\Backend\ProfileController@edit')->name('profile.edit');
        Route::post('/update', 'App\Http\Controllers\Backend\ProfileController@update')->name('profile.update');
        Route::get('/change/password', 'App\Http\Controllers\Backend\ProfileController@changePassword')->name('profile.password.change');
        Route::post('/password/update', 'App\Http\Controllers\Backend\ProfileController@changePasswordUpdate')->name('profile.password.update');
    });


    Route::prefix('suppliers')->group(function () {
        Route::get('/view', 'App\Http\Controllers\Backend\SupplierController@view')->name('suppliers.view');
        Route::get('/add', 'App\Http\Controllers\Backend\SupplierController@add')->name('suppliers.add');
        Route::post('/store', 'App\Http\Controllers\Backend\SupplierController@store')->name('suppliers.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\Backend\SupplierController@edit')->name('suppliers.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\Backend\SupplierController@update')->name('suppliers.update');
        Route::delete('/delete/{id}', 'App\Http\Controllers\Backend\SupplierController@delete')->name('suppliers.delete');
    });


    Route::prefix('customers')->group(function () {
        Route::get('/view', 'App\Http\Controllers\Backend\CustomerController@view')->name('customers.view');
        Route::get('/add', 'App\Http\Controllers\Backend\CustomerController@add')->name('customers.add');
        Route::post('/store', 'App\Http\Controllers\Backend\CustomerController@store')->name('customers.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\Backend\CustomerController@edit')->name('customers.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\Backend\CustomerController@update')->name('customers.update');
        Route::delete('/delete/{id}', 'App\Http\Controllers\Backend\CustomerController@delete')->name('customers.delete');
    });


    Route::prefix('units')->group(function () {
        Route::get('/view', 'App\Http\Controllers\Backend\UnitController@view')->name('units.view');
        Route::get('/add', 'App\Http\Controllers\Backend\UnitController@add')->name('units.add');
        Route::post('/store', 'App\Http\Controllers\Backend\UnitController@store')->name('units.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\Backend\UnitController@edit')->name('units.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\Backend\UnitController@update')->name('units.update');
        Route::delete('/delete/{id}', 'App\Http\Controllers\Backend\UnitController@delete')->name('units.delete');
    });


    Route::prefix('categories')->group(function () {
        Route::get('/view', 'App\Http\Controllers\Backend\CategoryController@view')->name('categories.view');
        Route::get('/add', 'App\Http\Controllers\Backend\CategoryController@add')->name('categories.add');
        Route::post('/store', 'App\Http\Controllers\Backend\CategoryController@store')->name('categories.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\Backend\CategoryController@edit')->name('categories.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\Backend\CategoryController@update')->name('categories.update');
        Route::delete('/delete/{id}', 'App\Http\Controllers\Backend\CategoryController@delete')->name('categories.delete');
    });


    Route::prefix('products')->group(function () {
        Route::get('/view', 'App\Http\Controllers\Backend\ProductController@view')->name('products.view');
        Route::get('/add', 'App\Http\Controllers\Backend\ProductController@add')->name('products.add');
        Route::post('/store', 'App\Http\Controllers\Backend\ProductController@store')->name('products.store');
        Route::get('/edit/{id}', 'App\Http\Controllers\Backend\ProductController@edit')->name('products.edit');
        Route::put('/update/{id}', 'App\Http\Controllers\Backend\ProductController@update')->name('products.update');
        Route::delete('/delete/{id}', 'App\Http\Controllers\Backend\ProductController@delete')->name('products.delete');
    });


    Route::prefix('purchases')->group(function () {
        Route::get('/view', 'App\Http\Controllers\Backend\PurchaseController@view')->name('purchases.view');
        Route::get('/add', 'App\Http\Controllers\Backend\PurchaseController@add')->name('purchases.add');
        Route::post('/store', 'App\Http\Controllers\Backend\PurchaseController@store')->name('purchases.store');
        Route::delete('/delete/{id}', 'App\Http\Controllers\Backend\PurchaseController@delete')->name('purchases.delete');
        Route::get('/pending-list', 'App\Http\Controllers\Backend\PurchaseController@purchasePendingList')->name('purchases.pending.list');
        Route::get('/approved/{id}', 'App\Http\Controllers\Backend\PurchaseController@purchaseApproved')->name('purchases.approved');
    });

    Route::get('/supplier-wise-category', 'App\Http\Controllers\Backend\DefaultController@supplierWiseCategory')->name('supplier.wise.cateogry');
    Route::get('/category-wise-product', 'App\Http\Controllers\Backend\DefaultController@categoryWiseProduct')->name('category.wise.product');
});
