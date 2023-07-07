<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AttributesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExchangesController;
use App\Http\Controllers\FiltersController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\NamesController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () 
{
    Route::get('/login', 'form')->name('form');
    Route::post('/login', 'login')->name('login');
    Route::get('/logout', 'logout')->name('logout');
});

Route::group( ['middleware' => 'auth' ], function()
{
    Route::controller(AccountController::class)->group(function () 
    {
        Route::get('/account', 'show')->name('account');
        Route::put('/account', 'update')->name('account.update');
    });

    Route::controller(AttributesController::class)->group(function () 
    {
        Route::resource('attributs', AttributesController::class)->parameters(
        [
            'attributs' => 'id'
        ]);
    });

    Route::controller(BannersController::class)->group(function () 
    {
        Route::resource('banners', BannersController::class)->parameters(
        [
            'banners' => 'id'
        ]);
    });

    Route::controller(CategoriesController::class)->group(function () 
    {
        Route::resource('categories', CategoriesController::class)->parameters(
        [
             'categories' => 'id'
        ]);
    });

    Route::any('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::any('/', [DashboardController::class, 'index']);

    Route::controller(ExchangesController::class)->group(function () 
    {
        Route::resource('exchanges', ExchangesController::class)->parameters(
        [
            'exchanges' => 'id'
        ]);
    });

    Route::controller(FiltersController::class)->group(function () 
    {
        Route::get('/filters/{prefix}', 'clearFilters')->name('filters.clear');
        Route::post('/filters/{prefix}', 'setFilters')->name('filters');
        Route::get('/orderBy/{prefix}/{orderBy?}/{orderDir?}', 'setOrderBy')->name('orderBy');
    });

    Route::controller(GroupsController::class)->group(function () 
    {
        Route::resource('groups', GroupsController::class)->parameters(
        [
            'groups' => 'id'
        ]);
    });

    Route::controller(MessagesController::class)->group(function () 
    {
        Route::resource('messages', MessagesController::class)->parameters(
        [
           'messages' => 'id'
        ]);
    });

    Route::controller(NamesController::class)->group(function () 
    {
        Route::resource('names', NamesController::class)->parameters(
        [
            'names' => 'id'
        ]);
    });

    Route::controller(PackagesController::class)->group(function () 
    {
        Route::resource('packages', PackagesController::class)->parameters(
        [
            'packages' => 'id'
        ]);
    });

    Route::controller(PagesController::class)->group(function () 
    {
        Route::resource('pages', PagesController::class)->parameters(
        [
            'pages' => 'id'
        ]);
    });

    Route::controller(ProductsController::class)->group(function () 
    {
        Route::resource('products', ProductsController::class)->parameters(
        [
            'products' => 'id'
        ]);
    });

    Route::controller(TypesController::class)->group(function () 
    {
        Route::resource('types', TypesController::class)->parameters(
        [
            'types' => 'id'
        ]);
    });

    Route::controller(UsersController::class)->group(function () 
    {
        Route::resource('users', UsersController::class)->parameters(
        [
            'users' => 'id'
        ]);
    });
});