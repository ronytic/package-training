<?php
Route::group(['middleware' => ['auth:api', 'bindings']], function () {


    // New Endpoints
    Route::post('admin/package-training/searchcountries', 'PackageTestAdminController@searchCountries')->name('package.test.admin.searchcountries');
    Route::post('admin/package-training/savecountry', 'PackageTestAdminController@store')->name('package.test.admin.store');
    Route::get('admin/package-training/getregisters', 'PackageTestAdminController@getregisters')->name('package.test.admin.getregisters');


    Route::post('admin/package-training/updatecountry/{id_country}', 'PackageTestAdminController@update')->name('package.test.admin.update');


    Route::get('admin/package-training/fetch', 'PackageTrainingController@fetch')->name('package.skeleton.fetch');
    Route::apiResource('admin/package-training', 'PackageTrainingController');
});
