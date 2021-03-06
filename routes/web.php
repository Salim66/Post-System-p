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
        Route::get('/credit/list', 'App\Http\Controllers\Backend\CustomerController@creditCustomerList')->name('customers.credit');
        Route::get('/credit/list/pdf', 'App\Http\Controllers\Backend\CustomerController@creditCustomerListPdf')->name('customers.credit.pdf');
        Route::get('/invoice/edit/{invoice_id}', 'App\Http\Controllers\Backend\CustomerController@customerInvoiceEdit')->name('customer.invoice.edit');
        Route::post('/invoice/update/{invoice_id}', 'App\Http\Controllers\Backend\CustomerController@customerInvoiceUpdate')->name('customer.invoice.update');
        Route::get('/invoice/details/{invoice_id}', 'App\Http\Controllers\Backend\CustomerController@customerInvoiceDetailsPdf')->name('customer.invoice.details.pdf');
        Route::get('/paid/list', 'App\Http\Controllers\Backend\CustomerController@paidCustomerList')->name('customers.paid');
        Route::get('/paid/list/pdf', 'App\Http\Controllers\Backend\CustomerController@paidCustomerListPdf')->name('customers.paid.pdf');
        Route::get('/wise/report', 'App\Http\Controllers\Backend\CustomerController@customerWiseReport')->name('customers.wise.report');
        Route::get('/wise/credit/report', 'App\Http\Controllers\Backend\CustomerController@customerWiseCreditReport')->name('customers.wise.credit.report');
        Route::get('/wise/paid/report', 'App\Http\Controllers\Backend\CustomerController@customerWisePaidReport')->name('customers.wise.paid.report');
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
        Route::get('/daily-report', 'App\Http\Controllers\Backend\PurchaseController@purchaseDailyReport')->name('purchases.daily.report');
        Route::get('/daily-report-pdf', 'App\Http\Controllers\Backend\PurchaseController@purchaseDailyReportPdf')->name('purchases.daily.report.pdf');
    });

    Route::get('/supplier-wise-category', 'App\Http\Controllers\Backend\DefaultController@supplierWiseCategory')->name('supplier.wise.cateogry');
    Route::get('/category-wise-product', 'App\Http\Controllers\Backend\DefaultController@categoryWiseProduct')->name('category.wise.product');
    Route::get('/product-quantity', 'App\Http\Controllers\Backend\DefaultController@productQuantity')->name('product.quantity');


    Route::prefix('invoices')->group(function () {
        Route::get('/view', 'App\Http\Controllers\Backend\InvoiceController@view')->name('invoices.view');
        Route::get('/add', 'App\Http\Controllers\Backend\InvoiceController@add')->name('invoices.add');
        Route::post('/store', 'App\Http\Controllers\Backend\InvoiceController@store')->name('invoices.store');
        Route::delete('/delete/{id}', 'App\Http\Controllers\Backend\InvoiceController@delete')->name('invoices.delete');
        Route::get('/pending-list', 'App\Http\Controllers\Backend\InvoiceController@invoicePendingList')->name('invoices.pending.list');
        Route::get('/approved/{id}', 'App\Http\Controllers\Backend\InvoiceController@invoiceApproved')->name('invoices.approved');
        Route::get('/approved/{id}', 'App\Http\Controllers\Backend\InvoiceController@invoiceApproved')->name('invoices.approved');
        Route::post('/approved/store/{id}', 'App\Http\Controllers\Backend\InvoiceController@invoiceApprovedStore')->name('invoice.approved.store');
        Route::get('/print-list', 'App\Http\Controllers\Backend\InvoiceController@invoicePrintList')->name('invoices.print.list');
        Route::get('/print/{id}', 'App\Http\Controllers\Backend\InvoiceController@invoicePrint')->name('invoices.print');
        Route::get('/daily-report', 'App\Http\Controllers\Backend\InvoiceController@invoiceDailyReport')->name('invoices.daily.report');
        Route::get('/daily-report-pdf', 'App\Http\Controllers\Backend\InvoiceController@invoiceDailyReportPdf')->name('invoices.daily.report.pdf');
    });


    Route::prefix('stocks')->group(function () {
        Route::get('/report', 'App\Http\Controllers\Backend\StockController@stockReport')->name('stocks.report');
        Route::get('/report/pdf', 'App\Http\Controllers\Backend\StockController@stockReportPdf')->name('stock.report.pdf');
        Route::get('/supplier/product-wise-report', 'App\Http\Controllers\Backend\StockController@supplierProductWiseReport')->name('supplier.product.wise.stocks.report');
        Route::get('/supplier-wise-report', 'App\Http\Controllers\Backend\StockController@supplierWiseStockReportPdf')->name('supplier.wise.stock.report.pdf');
        Route::get('/product-wise-report', 'App\Http\Controllers\Backend\StockController@productWiseStockReportPdf')->name('product.wise.stock.report.pdf');
    });
});
