<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
// ROUTE FRONT-END
Auth::routes();
Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('homepage');

Route::get('/sach/{id}',[\App\Http\Controllers\HomeController::class,'viewBook'])->name('viewBook');
Route::get('/danh-muc/{id}',[\App\Http\Controllers\HomeController::class,'viewCategory'])->name('viewCategory');
Route::get('/sach-ban-chay-trong-tuan',[\App\Http\Controllers\HomeController::class,'viewHotBookWeek'])->name('viewHotBookWeek');
Route::get('/sach-ban-chay-trong-thang',[\App\Http\Controllers\HomeController::class,'viewHotBookMonth'])->name('viewHotBookMonth');
Route::get('/sach-ban-moi-xuat-ban',[\App\Http\Controllers\HomeController::class,'viewBookNewPublish'])->name('viewBookNewPublish');
Route::get('/theo-doi-don-hang',[\App\Http\Controllers\HomeController::class,'flowOrder'])->name('flowOrder');
Route::get('/tim-kiem/',[\App\Http\Controllers\HomeController::class,'search'])->name('search');

Route::get('/tac-gia/{id}',[\App\Http\Controllers\HomeController::class,'viewAuthor'])->name('viewAuthor');

Route::get('/cty-phat-hanh/{id}',[\App\Http\Controllers\HomeController::class,'viewCompany'])->name('viewCompany');

Route::get('/trang-quan-tri',[\App\Http\Controllers\DashBoardController::class,'index'])->name('dashboard');


Route::get('doi-mat-khau',[\App\Http\Controllers\UserController::class,'changePassword'])->name('changePassword');
Route::post('submitPassword',[\App\Http\Controllers\UserController::class,'submitPassword'])->name('submitPassword');




// ROUTE BACK-END

Route::get('category/list',[\App\Http\Controllers\CategoryController::class,'show'])->name('listCategory');
Route::get('author/list',[\App\Http\Controllers\AuthorController::class,'getList'])->name('listAuthor');
Route::get('company/list',[\App\Http\Controllers\CompanyController::class,'getlist'])->name('listCompany');
Route::get('slide/list',[\App\Http\Controllers\SlideController::class,'getlist'])->name('listSlide');
Route::get('category/list',[\App\Http\Controllers\CategoryController::class,'getlist'])->name('listCategory');

Route::get('book/list',[\App\Http\Controllers\BookController::class,'getlist'])->name('listBook');
Route::get('order/list',[\App\Http\Controllers\OrderController::class,'getlist'])->name('listOrder');


Route::post('book/uploadImagesBook',[\App\Http\Controllers\BookController::class,'uploadImagesBook'])->name('uploadImagesBook');
Route::post('book/uploadAvatarBook',[\App\Http\Controllers\BookController::class,'uploadAvatarBook'])->name('uploadAvatarBook');

Route::post('author/uploadAvatarAuthor',[\App\Http\Controllers\AuthorController::class,'uploadAvatarAuthor'])->name('uploadAvatarAuthor');

Route::post('company/uploadCompanyLogo',[\App\Http\Controllers\CompanyController::class,'uploadCompanyLogo'])->name('uploadCompanyLogo');
Route::post('slide/uploadSlideImage',[\App\Http\Controllers\SlideController::class,'uploadSlideImage'])->name('uploadSlideImage');

Route::get('comment/list',[\App\Http\Controllers\CommentController::class,'getlist'])->name('listComment');
Route::get('list-users',  [\App\Http\Controllers\UserController::class,'getList'])->name('getListUser');

Route::post('slide/order', [\App\Http\Controllers\SlideController::class,'order'])->name('slide.order');
Route::post('category/order',[\App\Http\Controllers\CategoryController::class,'order'])->name('submitOrderCategory');

Route::get('payment/success',  [\App\Http\Controllers\PaymentController::class,'success'])->name('payment.success');
Route::get('payment/cancel',  [\App\Http\Controllers\PaymentController::class,'cancel'])->name('payment.cancel');

Route::resource('user', 'UserController');
Route::resource('author', 'AuthorController');
Route::resource('category', 'CategoryController');
Route::resource('company', 'CompanyController');
Route::resource('slide', 'SlideController');
Route::resource('book', 'BookController');
Route::resource('comment', 'CommentController');
Route::resource('order', 'OrderController');
Route::resource('save', 'SaveController');
Route::resource('payment', 'PaymentController');

Route::post('save_add',[\App\Http\Controllers\SaveController::class,'save_add'])->name('save_add');
Route::post('updateOrders',[\App\Http\Controllers\OrderController::class,'updateOrders'])->name('order.updateOrders');

Route::post('cart/add', [\App\Http\Controllers\CartController::class,'addCart'])->name('cart.add');
Route::post('cart/updateCart', [\App\Http\Controllers\CartController::class,'updateCart'])->name('cart.updateCart');
Route::post('cart/deleteCart', [\App\Http\Controllers\CartController::class,'destroy'])->name('cart.deleteCart');
Route::resource('cart', 'CartController');
