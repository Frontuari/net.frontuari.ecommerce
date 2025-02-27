<?php
@session_start();
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
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IdempiereProductController;
use App\Http\Controllers\IdempiereConnectionController;
use TCG\Voyager\Facades\Voyager;




Route::get('/',"HomeController@index")->name("home");
Route::get('/international-payment-button/{nb}/{ap}/{ci}/{nai}/{mt}/{em}/{from?}','HomeController@InternationalPaymentButton')->name('InternationalPaymentButton');
Route::get('/123pago/despedida','HomeController@url_despedida');

Route::get('/123pago/getdataresponse/{orderno?}','HomeController@getdataresponse');

Route::post('/123pago/retorno','HomeController@url_retorno');

Route::get('/terminos-condiciones',"HomeController@terminos")->name("home");
Route::get('/faq',"HomeController@faq")->name("home");

Route::get('/catalog','CatalogController@index')->name("Catalog");

Route::get('/join',"HomeController@join")->name("join");
Route::get('/recover',"HomeController@recover")->name("join");

Route::get('/profile','ProfileController@index')->name("profile");

Route::get('/cart','CartController@index')->name("cart");

Route::get('/resume/{id}','OrdersController@show')->name("cart");

Route::get('/validateUser/{hash}','API\RegisterController@validateUser');

// For SinglePages
Route::get('/culture',"SinglePageController@culture")->name("culture");
Route::get('/sucursal/{id?}',"SinglePageController@sucursal")->name("sucursal");
Route::get('/contact',"SinglePageController@contact")->name("contact");


// Auth::routes();






Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('masivo', ['uses' => 'Subscriptions@home', 'as' => 'voyager.masivo']);
    Route::get('reportes', ['uses' => 'Reportes@home', 'as' => 'voyager.reportes']);
    Route::get('/products', 'ProductsController@index')->name('products.index');
    Route::delete('/products/delete/{product}', 'ProductsController@destroy')->name('products.destroy');
    Route::get('/products', 'ProductsController@index')->name('voyager.products.index');
    Route::get('/products/create', 'ProductsController@create')->name('products.create');
    Route::post('products', "ProductsController@store")->name('products.store');
    // Route::get('/orders/{id}', 'OrdersController@showItems')->name('orders.showItems');
    Route::post('login', 'VoyagerAuthController@postLogin')->name('voyager.login');
    Route::get('voyager/order-products', 'ProductsController@index')->name('voyager.order-products.index');
    Route::put('packages/{id}', 'PackagesController@update')->name('voyager.packages.update');
    Route::post('packages', 'PackagesController@store')->name('voyager.packages.store');



    Route::get('products/{id}', 'API\ProductController@getProduct')->name("products.detalle");
    Route::get('products/{id}/edit','API\ProductController@edit')->name('products.edit');
    Route::get('/opiniones', 'RatingProductsController@index')->name('opiniones.index');
    Route::get('rating-products', 'API\RatingProductsController@index')->name('voyager.rating-products.index');
    

    Route::get('/order-products', 'OrdersController@products')->name('orders.productos');


    Route::get('kpis/transactions-for-period','KpisController@TransactionsForPeriod');
    Route::get('kpis/sales-for-period','KpisController@SalesForPeriod');
    Route::get('kpis/sales-units-for-period','KpisController@SalesUnitsForPeriod');
    
    Route::post('kpis/getData', 'KpisController@getData')->name('get_data');
 


    //Vista Idempiere Para actualizar dato y ver los datos del Token

    Route::get('idempiere/products', [IdempiereProductController::class, 'getProducts']);
    // Rutas protegidas solo para el rol 'super'
    Route::get('/idempiere', [IdempiereConnectionController::class, 'index'])->name('idempiere.index');
    Route::get('/idempiere/create', [IdempiereConnectionController::class, 'create'])->name('idempiere.create');
    Route::post('/idempiere', [IdempiereConnectionController::class, 'store'])->name('idempiere.store');
    
        // Vista para Editar el Idempiere
    Route::get('/connection/{id}/edit', [IdempiereConnectionController::class, 'edit'])->name('connection.edit');
    Route::put('/connection/{id}', [IdempiereConnectionController::class, 'update'])->name('connection.update');
 

    

});
