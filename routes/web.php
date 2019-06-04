<?php

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
//  start admin panel routes
Route::group(array('prefix' => 'admin'), function () {
    Auth::routes();
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');

        Route::get('activity','Admin\ActivityController@show')->name('show_activity');
        Route::get('add-activity','Admin\ActivityController@index')->name('index_activity');
        Route::post('add-activity','Admin\ActivityController@create')->name('add_activity');
        Route::get('update-activity/{id}','Admin\ActivityController@updateIndex')->name('update_index_activity');
        Route::post('update-activity/{id}','Admin\ActivityController@update')->name('update_activity');
        Route::get('activity-delete/{id?}','Admin\ActivityController@delete')->name('delete_activity');

        Route::get('products','Admin\ProductController@show')->name('show_products');
        Route::get('add-product','Admin\ProductController@index')->name('index_product');
        Route::post('add-product','Admin\ProductController@create')->name('add_product');
        Route::get('update-product/{id}','Admin\ProductController@updateIndex')->name('update_index_product');
        Route::post('update-product/{id}','Admin\ProductController@update')->name('update_product');
        Route::get('product-delete/{id?}','Admin\ProductController@delete')->name('delete_product');

        Route::get('users','Admin\UserController@show')->name('show_users');
        Route::get('user-detail/{id}','Admin\UserController@showUserDetail')->name('show_user_detail');
        Route::get('user-diet-detail/{id}','Admin\UserController@showUserDietDetail')->name('show_user_diet_detail');
        // Route::get("logout", "HomeController@logout")->name('logout');

        Route::get('recipes','Admin\RecipeController@show')->name('show_recipe');
        Route::get('recipe-detail/{id}','Admin\RecipeController@showRecipeDetail')->name('show_recipe_detail');
        Route::get('update-recipe/{id}','Admin\RecipeController@indexUpdateRecipe')->name('update_index_recipe');
        Route::post('update-recipe','Admin\RecipeController@updateRecipe')->name('update_recipe');
        Route::get('recipe-delete/{id?}','Admin\RecipeController@delete')->name('delete_recipe');
        Route::get('add-recipe','Admin\RecipeController@showAddRecipe')->name('add_index_recipe');
        Route::post('add-recipe','Admin\RecipeController@create')->name('add_recipe');
        Route::get('recipe-delete-step/{id?}','Admin\RecipeController@deleteRecipeStep')->name('delete_recipe_step');


        Route::get('add-diet-chart/{id}','Admin\DietChartController@index')->name('index_diet');
        Route::post('add-diet-chart','Admin\DietChartController@create')->name('create_diet');
    });
 });
 // end admin panel routes

 // start website routes
Route::get('user-information','Web\UserController@index')->name('index_user_information');
Route::post('user-information','Web\UserController@create')->name('create_user_information');
 //end website routes
