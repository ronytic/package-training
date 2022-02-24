<?php

Route::group(['middleware' => ['auth']], function () {
    Route::get('admin/package-training', 'PackageTrainingController@index')->name('package.skeleton.index');
    Route::get('package-training', 'PackageTrainingController@index')->name('package.skeleton.tab.index');

    Route::get('package-training2', 'PackageTrainingController@newindex')->name('package.training.tab.newindex');
});
