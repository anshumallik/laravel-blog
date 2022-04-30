<?php

use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Frontend\FrontendController as FrontendController;
use App\Http\Controllers\UserController as AdminUserController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes(['register' => true]);

Route::group(["middleware" => ["auth", 'adminMiddleware']], function () {
    Route::group(["prefix" => "admin/", "as" => "admin."], function () {
        Route::get("dashboard", [AdminDashboardController::class, "dashboard"])->name("dashboard");

        Route::group(["prefix" => "user/", "as" => "user."], function () {
            Route::get("", [AdminUserController::class, 'index'])->name('index');
            Route::get("frontuser", [AdminUserController::class, 'frontuser'])->name('frontuser');
            Route::get("create", [AdminUserController::class, 'create'])->name('create');
            Route::post("store", [AdminUserController::class, 'store'])->name('store');
            Route::get("edit/{id}", [AdminUserController::class, 'edit'])->name('edit');
            Route::match(['put', "patch"], "update/{id}", [AdminUserController::class, 'update'])->name('update');
            Route::post("update-status", [AdminUserController::class, "updateStatus"])->name("updateStatus");

            Route::get("profile/", [AdminUserController::class, "profile"])->name("profile");
            Route::post("change-admin-password", [AdminUserController::class, "adminNewPassword"])->name("adminNewPassword");
            Route::post("change-admin-email", [AdminUserController::class, "changeAdminEmail"])->name("changeAdminEmail");
            Route::post("change-admin-profile", [AdminUserController::class, "changeAdminAvatar"])->name("changeAdminAvatar");

        });

        Route::group(["prefix" => "category/", "as" => "category."], function () {
            Route::get("", [AdminCategoryController::class, "index"])->name("index");
            Route::get("create", [AdminCategoryController::class, "create"])->name("create");
            Route::post("store", [AdminCategoryController::class, "store"])->name("store");
            Route::get("edit/{id}", [AdminCategoryController::class, "edit"])->name("edit");
            Route::put("update/{id}", [AdminCategoryController::class, "update"])->name("update");
            Route::post("update-status", [AdminCategoryController::class, "updateStatus"])->name("updateStatus");
            Route::delete("delete/{id}", [AdminCategoryController::class, "delete"])->name("delete");
        });
        Route::group(["prefix" => "tag/", "as" => "tag."], function () {
            Route::get("", [AdminTagController::class, "index"])->name("index");
            Route::get("create", [AdminTagController::class, "create"])->name("create");
            Route::post("store", [AdminTagController::class, "store"])->name("store");
            Route::get("edit/{id}", [AdminTagController::class, "edit"])->name("edit");
            Route::put("update/{id}", [AdminTagController::class, "update"])->name("update");
            Route::post("update-status", [AdminTagController::class, "updateStatus"])->name("updateStatus");
            Route::delete("delete/{id}", [AdminTagController::class, "delete"])->name("delete");
        });
        Route::group(["prefix" => "blog/", "as" => "blog."], function () {
            Route::get("", [AdminBlogController::class, "index"])->name("index");
            Route::get("create", [AdminBlogController::class, "create"])->name("create");
            Route::post("store", [AdminBlogController::class, "store"])->name("store");
            Route::get("edit/{id}", [AdminBlogController::class, "edit"])->name("edit");
            Route::put("update/{id}", [AdminBlogController::class, "update"])->name("update");
            Route::post("update-status", [AdminBlogController::class, "updateStatus"])->name("updateStatus");
            Route::delete("delete/{id}", [AdminBlogController::class, "destroy"])->name("delete");

        });

    });

});

Route::group(['as' => 'frontend.'], function () {
    Route::get('', [FrontendController::class, 'index'])->name('index');
    Route::get('/blog/{slug}', [FrontendController::class, 'blog'])->name('blog');
    Route::get('/blog-tag/{slug}', [FrontendController::class, 'blog_tag'])->name('blog_tag');
    Route::get('/blog-detail/{slug}', [FrontendController::class, 'blog_detail'])->name('blog_detail');
    Route::get('/user-login', [FrontendController::class, 'login'])->name('login');
    Route::get('/user-register', [FrontendController::class, 'register'])->name('register');
    Route::get('/user-profile', [FrontendController::class, 'user_profile'])->name('user_profile')->middleware('auth');
    Route::get("search", [FrontendController::class, "search"])->name("search");

// user profile
    Route::post("change-user-email", [FrontendController::class, "changeUserEmail"])->name("changeUserEmail");
    Route::post("change-user-password", [FrontendController::class, "userNewPassword"])->name("userNewPassword");
    Route::post("change-user-profile", [FrontendController::class, "changeUserProfile"])->name("changeUserProfile");

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
