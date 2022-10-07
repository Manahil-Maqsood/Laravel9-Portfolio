<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutPageController;

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
    return view('frontend.index');
})->name('frontend.index');


Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


/// Admin all Routes ///
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');

    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/admin/edit_profile', 'edit_profile')->name('admin.profile.edit');
    Route::post('/admin/update_profile', 'update_profile')->name('update.profile');

    Route::get('/admin/change_password', 'change_password')->name('change.password');
    Route::post('/admin/update_password', 'update_password')->name('update.password');
});


/// HomeSlider all Routes ///
Route::controller(HomeSliderController::class)->group(function () {
    Route::get('/home/slider', 'HomeSlider')->name('home.slide');
    Route::post('/slider/update', 'UpdateSlider')->name('update.slide');
});

/// AboutPage all Routes ///
Route::controller(AboutPageController::class)->group(function () {
    Route::get('/about', 'AboutDetail')->name('about.detail');

    Route::get('/about/page', 'AboutPage')->name('about.page');
    Route::post('/about/update', 'UpdateAbout')->name('update.about');

    Route::get('/about/multi/image', 'MultiImage')->name('about.multi.image');
    Route::post('/store/multi/image', 'StoreMultiImage')->name('store.multi.image');
    Route::get('/all/multi/image', 'AllMultiImage')->name('all.multi.image');
    Route::get('/edit/multi/image{id}', 'EditMultiImage')->name('edit.multi.image');
    Route::post('/update/multi/image', 'UpdateMultiImage')->name('update.multi.image');
    Route::get('/delete/multi/image{id}', 'DeleteMultiImage')->name('delete.multi.image');
});

