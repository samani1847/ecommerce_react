<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => 'cors'], function () {
    //authentication 
    Route::post('/authenticate', 'Admin\AuthController@login');
    // Route::get('/admin/category')
// });
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('cart/add', 'Frontend\CartController@addToCart');
});


Route::group(['middleware' => ['api', 'cors']], function () {
    Route::post('login', 'Frontend\AuthController@login');
    Route::post('register', 'Frontend\AuthController@register');
    Route::get('homepage', 'Frontend\HomepageController@homedata');
    Route::get('detail/{id}', 'Frontend\HomepageController@detailProduct');
  
});

Route::group(['middleware' => 'cors','prefix' => 'admin'], function(){

    //category module
    Route::group(['prefix' => 'category'], function(){
        Route::get('/data', 'Admin\CategoryController@data');
        Route::put('/update/{id}', 'Admin\CategoryController@update');
        Route::post('/create', 'Admin\CategoryController@create');
        Route::delete('/delete/{id}', 'Admin\CategoryController@delete');
        Route::get('/detail/{id}', 'Admin\CategoryController@get');
    });

    //subcategory module
    Route::group(['prefix' => 'subcategory'], function(){
        Route::get('/data', 'Admin\SubcategoryController@data');
        Route::put('/update/{id}', 'Admin\SubcategoryController@update');
        Route::post('/create', 'Admin\SubcategoryController@create');
        Route::delete('/delete/{id}', 'Admin\SubcategoryController@delete');
        Route::get('/detail/{id}', 'Admin\SubcategoryController@get');
    });


});