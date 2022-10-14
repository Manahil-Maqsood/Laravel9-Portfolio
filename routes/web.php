<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutPageController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;

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

/// Portfolio all Routes ///
Route::controller(PortfolioController::class)->group(function () {
    Route::get('/portfolio', 'Portfolio')->name('home.portfolio');
    Route::get('/portfolio/detail', 'PortfolioDetail')->name('home.portfolio.detail');

    Route::get('/admin/portfolio/all', 'AllPortfolio')->name('portfolio.all');
    Route::get('/admin/portfolio/add', 'AddPortfolio')->name('portfolio.add');
    Route::post('/admin/portfolio/save', 'SavePortfolio')->name('portfolio.add.save');

    Route::get('/edit/portfolio{id}', 'EditPortfolio')->name('edit.portflio.data');
    Route::post('/save/portfolio/update', 'SaveUpdatePortfolio')->name('save.portfolio.update');
    Route::get('/delete/portfolio{id}', 'DeletePortfolio')->name('delete.portflio.data');
});

/// BlogCategory all Routes ///
Route::controller(BlogCategoryController::class)->group(function () {
    Route::get('/blog/all/category', 'AllBlogCategory')->name('all.blog.category');
    Route::get('/blog/add/category', 'AddBlogCategory')->name('add.blog.category');
    Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');

    Route::get('/edit/blog/category{id}', 'EditBlogCategory')->name('edit.blog.category');
    Route::post('/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
    Route::get('/delete/blog/category{id}', 'DeleteBlogCategory')->name('delete.blog.category');
});

/// Blog all Routes ///
Route::controller(BlogController::class)->group(function () {
    Route::get('/all/blog', 'AllBlog')->name('all.blog');
    Route::get('/add/blog', 'AddBlog')->name('add.blog');

    Route::post('/store/blog', 'StoreBlog')->name('store.blog');
    Route::get('/edit/blog{id}', 'EditBlog')->name('edit.blog');
    Route::post('/update/blog', 'UpdateBlog')->name('update.blog');
    Route::get('/delete/blog{id}', 'DeleteBlog')->name('delete.blog');

    Route::get('/blog/details{id}', 'BlogDetails')->name('blog.details');
});

