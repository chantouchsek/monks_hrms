<?php
/**
 * Author: Chantouch Sek
 * Date: 2018-06-07
 * Time: 8:13 PM
 */

Route::group(
    ['middleware' => ['web']],
    function () {
        Route::post('countries/import', 'CountryController@import')->name('countries.import');
        Route::resource('countries', 'CountryController');
    }
);

Route::group(
    ['middleware' => ['web']],
    function () {
        Route::post('provinces/import', 'ProvinceController@import')->name('provinces.import');
        Route::resource('provinces', 'ProvinceController');
    }
);

Route::group(
    ['middleware' => ['web']],
    function () {
        Route::post('districts/import', 'DistrictController@import')->name('districts.import');
        Route::resource('districts', 'DistrictController');
    }
);

Route::group(
    ['middleware' => ['web']],
    function () {
        Route::post('communes/import', 'CommuneController@import')->name('communes.import');
        Route::resource('communes', 'CommuneController');
    }
);

Route::group(
    ['middleware' => ['web']],
    function () {
        Route::post('villages/import', 'VillageController@import')->name('villages.import');
        Route::resource('villages', 'VillageController');
    }
);
