<?php

use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ControllerCalendar;
use App\Http\Controllers\ControllerEvent;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Middleware\Admin;
use App\Http\Controllers\Auth\RedirectIfNotVerifiedController;
use App\Http\Controllers\MarketingController;


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

Auth::routes(['verify' => true]);

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('products', [ProductController::class, 'productList'])->name('products.list');
    Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'generateInvoice'])->name('checkout.generateInvoice');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout', [CheckoutController::class, 'showForm'])->name('checkout.show');
    Route::post('/checkout/process', 'CheckoutController@process')->name('checkout.process');
    Route::get('/checkout/confirmation', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
    Route::get('/checkout/form', [CheckoutController::class, 'showForm'])->name('checkout.form');
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/confirmation/{invoiceId}', [CheckoutController::class, 'confirmation'])->name('confirmation');
    Route::get('/invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download');

    Route::get('Calendar/event/{mes}', 'ControllerCalendar@index_month');
    Route::get('Calendar/event', 'ControllerCalendar@index');

    Route::get('evento/form', 'ControllerEvent@form');
    Route::post('Evento/create', 'ControllerEvent@create');
    Route::get('Evento/details/{id}', 'ControllerEvent@details');
    Route::get('Evento/index', 'ControllerEvent@index');
    Route::get('Evento/index/{month}', 'ControllerEvent@index_month');

    Route::get('Evento/index', [ControllerCalendar::class, 'index'])->name('index');
    Route::get('Evento/index/{month}', [ControllerEvent::class, 'index_month'])->name('evento.index.month');
    Route::post('Evento/calendario', [ControllerEvent::class, 'calendario'])->name('evento.calendario');
    Route::get('Evento/form', [ControllerEvent::class, 'form'])->name('evento.form');
    Route::post('Evento/create', [ControllerEvent::class, 'create'])->name('evento.create');
    Route::get('Evento/details/{id}', [ControllerEvent::class, 'details'])->name('evento.details');

    Route::get('Calendar/event/{mes}', [ControllerCalendar::class, 'index_month'])->name('calendar.event.month');
    Route::get('Calendar/event', [ControllerCalendar::class, 'index'])->name('calendar.event');

    Route::delete('/Evento/{id}', [ControllerEvent::class, 'destroy'])->name('Evento.destroy');

    Route::get('/evento/index', [ControllerEvent::class, 'index'])->name('Evento.index');

    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('admin/products/save', [ProductController::class, 'save'])->name('admin.products.save');
        Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin/products/edit');
        Route::put('/admin/products/edit/{id}', [ProductController::class, 'update'])->name('admin/products/update');
        Route::get('/admin/products/delete/{id}', [ProductController::class, 'delete'])->name('admin/products/delete');
        Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::put('/users/update/{id}', [AdminUserController::class, 'updateType'])->name('update.type');
        Route::delete('/users/destroy/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
            Route::get('categories', [CategoriesController::class, 'index'])->name('admin.categories.index');
            Route::get('admin/categories', [CategoriesController::class, 'index'])->name('admin.categories.index');
            Route::post('/admin/categories', 'App\Http\Controllers\Admin\CategoryController@store')->name('admin.categories.store');
            Route::put('/admin/categories/{category}', 'App\Http\Controllers\Admin\CategoryController@update')->name('admin.categories.update');
            Route::delete('/admin/categories/{category}', 'App\Http\Controllers\Admin\CategoryController@destroy')->name('admin.categories.destroy');
        });

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('categories', CategoriesController::class);
            Route::resource('products', ProductController::class);
        });

        Route::middleware(['auth'])->prefix('admin')->group(function () {
            Route::resource('categories', CategoriesController::class);
        });
        Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
    });

    Route::get('products', [ProductController::class, 'productList'])->name('products.list')->middleware('redirectIfAdmin');
    Route::post('/products/{product}/review', [ProductController::class, 'storeReview'])->name('product.review');
   
    Route::get('/send-marketing-email', function () {
        return view('send-marketing-email');
    })->middleware('auth');
    
    Route::post('/send-marketing-email', [MarketingController::class, 'sendMarketingEmail'])->name('marketing.send');
    
});

require __DIR__.'/auth.php';

