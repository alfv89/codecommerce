<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::pattern('id', '[0-9]+');

Route::get('/', function() {
    return view('welcome');
});

Route::group(['prefix'=>'admin'], function() {
    Route::group(['prefix'=>'categories'], function() {
        Route::get('/', ['as'=>'adminCategoriesList', 'uses'=>'AdminCategoriesController@index']);
        Route::post('/new', ['as'=>'adminCategoriesNew', 'uses'=>'AdminCategoriesController@create']);
        Route::get('/show/{id}', ['as'=>'adminCategoriesShow', 'uses'=>'AdminCategoriesController@show']);
        Route::get('/edit/{id}', ['as'=>'adminCategoriesEdit', 'uses'=>'AdminCategoriesController@edit']);
        Route::put('/update/{id}', ['as'=>'adminCategoriesUpdate', 'uses'=>'AdminCategoriesController@update']);
        Route::delete('/destroy/{id}', ['as'=>'adminCategoriesDestroy', 'uses'=>'AdminCategoriesController@destroy']);
    });

    Route::group(['prefix'=>'products'], function() {
        Route::get('/', ['as'=>'adminProductsList', 'uses'=>'AdminProductsController@index']);
        Route::post('/new', ['as'=>'adminProductsNew', 'uses'=>'AdminProductsController@create']);
        Route::get('/show/{id}', ['as'=>'adminProductsShow', 'uses'=>'AdminProductsController@show']);
        Route::get('/edit/{id}', ['as'=>'adminProductsEdit', 'uses'=>'AdminProductsController@edit']);
        Route::put('/update/{id}', ['as'=>'adminProductsUpdate', 'uses'=>'AdminProductsController@update']);
        Route::delete('/destroy/{id}', ['as'=>'adminProductsDestroy', 'uses'=>'AdminProductsController@destroy']);
    });
});

//Route::match(['get', 'post'], 'match', function() {
//    return "This is an match route example...";
//});

//Route::any('any', function() {
//    return "This is an any route example...";
//});

//Route::get('user/{id?}', function($id = 123) {
//    if ($id) {
//        return "Hello $id";
//    }
//
//    return "There is no ID...";
//});

//Route::get('category/{id}', function($id) {
//    $category = new \CodeCommerce\Category();
//    $c = $category->find($id);
//
//    return $c->name;
//});

//Route::get('category/{category}', function(\CodeCommerce\Category $category) {
//    return $category->name;
//    dd($category);
//});