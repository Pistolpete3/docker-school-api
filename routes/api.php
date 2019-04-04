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
Route::group(['prefix' => 'v1'], function() {
    /**
     * Heartbeat test Route
     */
    Route::get('heartbeat', 'HealthController@heartbeat');

    /**
     * School Routes
     */
    Route::get('schools', 'SchoolController@showAllSchools')->name('schools.index');
    Route::get('export/schools/{school?}', 'SchoolController@exportAllSchools')->name('schools.export');
    Route::resource('school', 'SchoolController');
    Route::resource('school/{school}/products', 'SchoolProductController');

    /**
     * Product Routes
     */
    Route::get('products/schoolsCount/{count?}', 'ProductController@retrieveProductsBySchoolCount');
    Route::get('products/value/{value?}', 'ProductController@retrieveProductsByValue');
});
