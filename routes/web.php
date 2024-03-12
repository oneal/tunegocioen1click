<?php

use App\Http\Controllers\Admin\Professionals;
use App\Http\Controllers\Admin\Stores;
use App\Http\Controllers\Admin\Restaurants;
use App\Http\Controllers\Admin\WorkOffers;
use App\Http\Controllers\Admin\Homes;
use App\Http\Controllers\Admin\Hotels;
use App\Http\Controllers\Admin\Invoices;
use App\Http\Controllers\Admin\BlogsAd;
use App\Http\Controllers\Web\Home;
use App\Http\Controllers\Web\Professional;
use App\Http\Controllers\Web\Stores as StoresWeb;
use App\Http\Controllers\Web\Hotel;
use App\Http\Controllers\Web\Restaurant;
use App\Http\Controllers\Web\WorkOffer;
use App\Http\Controllers\Web\Blogs;
use App\Http\Controllers\Web\PrivacyPolicy;
use App\Http\Controllers\Web\Legal;
use App\Http\Controllers\Web\Contact;
use App\Http\Controllers\Web\SiteMapController;
use App\Http\Controllers\Admin\Duplicate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'professionals', 'middleware' => ['admin.user']], function () {
        Route::post('get-position-not-used', [Professionals::class, 'getPositionNotUsed'])
            ->name('professionals.getPositionNotUsed');
        Route::get('list-position-professionals', [Professionals::class, 'listPositionProfessionals'])
            ->name('professionals.listPositionProfessionals');
        Route::get('resumen-invoice/{id}', [Professionals::class, 'resumenInvoice'])
            ->name('professionals.resumenInvoice');
        Route::post('generate-invoice/{id}', [Professionals::class, 'generateInvoice'])
            ->name('professionals.generateInvoice');
        Route::get('create', [Professionals::class, 'create'])
            ->name('professionals.create');
        Route::get('{id}/create', [Professionals::class, 'create'])
            ->name('professionals.create');
    });
    Route::group(['prefix' => 'stores', 'middleware' => ['admin.user']], function () {
        Route::post('get-position-not-used', [Stores::class, 'getPositionNotUsed'])
            ->name('stores.getPositionNotUsed');
        Route::get('list-position-stores', [Stores::class, 'listPositionStores'])
            ->name('stores.listPositionStores');
        Route::get('resumen-invoice/{id}', [Stores::class, 'resumenInvoice'])
            ->name('stores.resumenInvoice');
        Route::post('generate-invoice/{id}', [Stores::class, 'generateInvoice'])
            ->name('stores.generateInvoice');
        Route::get('create', [Stores::class, 'create'])
            ->name('stores.create');
        Route::get('{id}/create', [Stores::class, 'create'])
            ->name('stores.create');
    });
    Route::group(['prefix' => 'restaurants', 'middleware' => ['admin.user']], function () {
        Route::post('get-position-not-used', [Restaurants::class, 'getPositionNotUsed'])
            ->name('restaurants.getPositionNotUsed');
        Route::get('list-position-restaurants', [Restaurants::class, 'listPositionRestaurants'])
            ->name('restaurants.listPositionRestaurants');
        Route::get('resumen-invoice/{id}', [Restaurants::class, 'resumenInvoice'])
            ->name('restaurants.resumenInvoice');
        Route::post('generate-invoice/{id}', [Restaurants::class, 'generateInvoice'])
            ->name('restaurants.generateInvoice');
        Route::get('create', [Restaurants::class, 'create'])
            ->name('restaurants.create');
        Route::get('{id}/create', [Restaurants::class, 'create'])
            ->name('restaurants.create');
    });
    Route::group(['prefix' => 'hotels', 'middleware' => ['admin.user']], function () {
        Route::post('get-position-not-used', [Hotels::class, 'getPositionNotUsed'])
            ->name('hotels.getPositionNotUsed');
        Route::get('list-position-hotels', [Hotels::class, 'listPositionHotels'])
            ->name('hotels.listPositionHotels');
        Route::get('resumen-invoice/{id}', [Hotels::class, 'resumenInvoice'])
            ->name('hotels.resumenInvoice');
        Route::post('generate-invoice/{id}', [Hotels::class, 'generateInvoice'])
            ->name('hotels.generateInvoice');
        Route::get('create', [Hotels::class, 'create'])
            ->name('hotels.create');
        Route::get('{id}/create', [Hotels::class, 'create'])
            ->name('hotels.create');
    });
    Route::group(['prefix' => 'work-offers', 'middleware' => ['admin.user']], function () {
        Route::post('get-position-not-used', [WorkOffers::class, 'getPositionNotUsed'])
            ->name('workoffers.getPositionNotUsed');
        Route::get('list-position-workoffers', [WorkOffers::class, 'listPositionWorkOffers'])
            ->name('workoffers.listPositionWorkOffers');
        Route::get('resumen-invoice/{id}', [WorkOffers::class, 'resumenInvoice'])
            ->name('workoffers.resumenInvoice');
        Route::post('generate-invoice/{id}', [WorkOffers::class, 'generateInvoice'])
            ->name('workoffers.generateInvoice');
        Route::get('create', [WorkOffers::class, 'create'])
            ->name('workoffers.create');
        Route::get('{id}/create', [WorkOffers::class, 'create'])
            ->name('workoffers.create');
    });
    Route::group(['prefix' => 'homes', 'middleware' => ['admin.user']], function () {
        Route::post('get-position-not-used', [Homes::class, 'getPositionNotUsed'])
            ->name('homes.getPositionNotUsed');
        Route::get('list-position-homes', [Homes::class, 'listPositionHomes'])
            ->name('homes.listPositionHomes');
        Route::get('resumen-invoice/{id}', [Homes::class, 'resumenInvoice'])
            ->name('homes.resumenInvoice');
        Route::post('generate-invoice/{id}', [Homes::class, 'generateInvoice'])
            ->name('homes.generateInvoice');
        Route::get('create', [Homes::class, 'create'])
            ->name('homes.create');
        Route::get('{id}/create', [Homes::class, 'create'])
            ->name('homes.create');
    });
    Route::group(['prefix' => 'invoices', 'middleware' => ['admin.user']], function () {
        Route::get('paid/{id}', [Invoices::class, 'paidInvoice'])
            ->name('invoice.paid');
        Route::get('generate-invoice-pdf/{id}', [Invoices::class, 'generateInvoicePdf'])
            ->name('invoice.generarteinvoicepdf');
    });
    Route::group(['prefix' => 'blogs-ads', 'middleware' => ['admin.user']], function () {
        Route::get('resumen-invoice/{id}', [BlogsAd::class, 'resumenInvoice'])
            ->name('blogads.resumenInvoice');
        Route::post('generate-invoice/{id}', [BlogsAd::class, 'generateInvoice'])
            ->name('blogads.generateInvoice');
    });

    Route::group(['prefix' => 'duplicate', 'middleware' => ['admin.user']], function () {
        Route::post('create', [Duplicate::class, 'addDuplicate'])
            ->name('duplicate.addDuplicate');
        Route::get('search-data-by-type', [Duplicate::class, 'searchDataByType'])
            ->name('duplicate.searchDataByType');
        Route::get('search-category-by-type', [Duplicate::class, 'searchCategoryByType'])
            ->name('duplicate.searchCategoryByType');
        Route::get('search-positions', [Duplicate::class, 'searchPositions'])
            ->name('duplicate.searchPositions');
        Route::get('/', [Duplicate::class, 'index'])
            ->name('duplicate.index');
    });

    Voyager::routes();
});

Route::get('/', [Home::class, 'index'])
    ->name('home.index');

Route::get('/profesionales', [Professional::class, 'index'])
    ->name('professional.index');
Route::get('/profesionales/{category}', [Professional::class, 'index'])
    ->name('professional.index.category.province');
Route::get('/profesionales/{province}', [Professional::class, 'index'])
    ->name('professional.index.category.province');
Route::get('/profesionales/{category}/{province}', [Professional::class, 'index'])
    ->name('professional.index.category.province');

Route::get('/almacenes', [StoresWeb::class, 'index'])
    ->name('store.index');
Route::get('/almacenes/{category}', [StoresWeb::class, 'index'])
    ->name('store.index.category.province');
Route::get('/almacenes/{province}', [StoresWeb::class, 'index'])
    ->name('store.index.category.province');
Route::get('/almacenes/{category}/{province}', [StoresWeb::class, 'index'])
    ->name('store.index.category.province');

Route::get('/hoteles', [Hotel::class, 'index'])
    ->name('hotel.index');
Route::get('/hoteles/{province}', [Hotel::class, 'index'])
    ->name('hotel.index.province');

Route::get('/bares-restaurantes', [Restaurant::class, 'index'])
    ->name('restaurant.index');
Route::get('/bares-restaurantes/{province}', [Restaurant::class, 'index'])
    ->name('restaurant.index.province');

Route::get('/ofertas-trabajo', [WorkOffer::class, 'index'])
    ->name('workoffer.index');
Route::get('/ofertas-trabajo/{province}', [WorkOffer::class, 'index'])
    ->name('workoffer.index.province');

Route::get('/blog', [Blogs::class, 'index'])
    ->name('blog.index');

Route::get('/blog/{category}', [Blogs::class, 'blogsCategory'])
    ->name('blog.category.index');

Route::get('/blog/post/{slug}', [Blogs::class, 'post'])
    ->name('blog.post.index');

Route::get('/sitemap', [SiteMapController::class, 'index'])
    ->name('sitemap.index');

Route::get('/contacto', [Contact::class, 'index'])
    ->name('contact.index');
Route::post('/contact/submit', [Contact::class, 'sendContact'])
    ->name('contact.sendcontact');

Route::get('/politica-privacidad', [PrivacyPolicy::class, 'index'])
    ->name('privacy.politic');
Route::get('/aviso-legal', [Legal::class, 'index'])
    ->name('legal');

Route::get('/clear-cache', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
});
