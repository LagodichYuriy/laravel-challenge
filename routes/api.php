<?php

use Illuminate\Support\Facades\Route;

Route::get('countries',              'CountryController@index');
Route::get('countries/{country_id}', 'CountryController@index');

Route::get('regions',             'RegionController@index');
Route::get('regions/{region_id}', 'RegionController@index');

Route::get('cities',           'CityController@index');
Route::get('cities/{city_id}', 'CityController@index');

Route::get('streets',             'StreetController@index');
Route::get('streets/{street_id}', 'StreetController@index');

Route::get('buildings',               'BuildingController@index');
Route::get('buildings/{building_id}', 'BuildingController@index');

Route::get('citizens',              'CitizenController@index');
Route::get('citizens/{citizen_id}', 'CitizenController@index');

Route::get('car_brands',                'CarBrandController@index');
Route::get('car_brands/{car_brand_id}', 'CarBrandController@index');

Route::get('colors',            'ColorController@index');
Route::get('colors/{color_id}', 'ColorController@index');

Route::get('cars',          'CarController@index');
Route::get('cars/{car_id}', 'CarController@index');

