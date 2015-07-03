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
        Route::get('/', ['as'=>'admin.categories', 'uses'=>'Admin\CategoriesController@index']);
        Route::get('create', ['as'=>'admin.categories.create', 'uses'=>'Admin\CategoriesController@create']);
        Route::post('create', ['as'=>'admin.categories.store', 'uses'=>'Admin\CategoriesController@store']);
//        Route::get('{id}/show', ['as'=>'admin.categories.show', 'uses'=>'Admin\CategoriesController@show']);
        Route::get('{id}/edit', ['as'=>'admin.categories.edit', 'uses'=>'Admin\CategoriesController@edit']);
        Route::put('{id}/update', ['as'=>'admin.categories.update', 'uses'=>'Admin\CategoriesController@update']);
        Route::get('{id}/destroy', ['as'=>'admin.categories.destroy', 'uses'=>'Admin\CategoriesController@destroy']);
//        Route::delete('{id}/destroy', ['as'=>'admin.categories.destroy', 'uses'=>'Admin\CategoriesController@destroy']);
    });

    Route::group(['prefix'=>'products'], function() {
        Route::get('/', ['as'=>'admin.products', 'uses'=>'Admin\ProductsController@index']);
        Route::get('create', ['as'=>'admin.products.create', 'uses'=>'Admin\ProductsController@create']);
        Route::post('create', ['as'=>'admin.products.store', 'uses'=>'Admin\ProductsController@store']);
//        Route::get('{id}/show', ['as'=>'admin.products.show', 'uses'=>'Admin\ProductsController@show']);
        Route::get('{id}/edit', ['as'=>'admin.products.edit', 'uses'=>'Admin\ProductsController@edit']);
        Route::put('{id}/update', ['as'=>'admin.products.update', 'uses'=>'Admin\ProductsController@update']);
        Route::get('{id}/destroy', ['as'=>'admin.products.destroy', 'uses'=>'Admin\ProductsController@destroy']);

        Route::group(['prefix'=>'images'], function() {
            Route::get('{id}/product', ['as'=>'admin.products.images', 'uses'=>'Admin\ProductsController@images']);
            Route::get('create/{id}/product', ['as'=>'admin.products.images.create', 'uses'=>'Admin\ProductsController@createImage']);
            Route::post('store/{id}/product', ['as'=>'admin.products.images.store', 'uses'=>'Admin\ProductsController@storeImage']);
            Route::get('destroy/{id}/image', ['as'=>'admin.products.images.destroy', 'uses'=>'Admin\ProductsController@destroyImage']);
        });
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