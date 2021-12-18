<?php

use Illuminate\Support\Facades\Route;

/*************************/
/*Start Developer routes*/
/****************************/

Route::get('home','\Developer\Controllers\DeveloperController@index');
Route::get('extensions','\Developer\Controllers\ExtensionsController@index');
Route::get('export_extension','\Developer\Controllers\ExtensionsController@export_extension');
Route::get('delete_extension','\Developer\Controllers\ExtensionsController@delete_extension');
Route::get('install_extension','\Developer\Controllers\ExtensionsController@viewInstall_module');
Route::post('install_extension','\Developer\Controllers\ExtensionsController@install_module');
Route::get('start_project','\Developer\Controllers\ProjectController@view');
Route::post('start_project','\Developer\Controllers\ProjectController@store');
Route::get('deployment','\Developer\Controllers\ProjectController@view_deployment');
Route::post('deployment_web','\Developer\Controllers\ProjectController@deployment_web');

//Route::get('create_extension','\Developer\Controllers\DeveloperController@create_module');
Route::get('create_extension_table','\Developer\Controllers\DeveloperController@create_extension_table');
//Route::get('get_table_fields','\Developer\Controllers\DeveloperController@get_table_fields');
Route::get('get_theme_items','\Developer\Controllers\DeveloperController@get_theme_items');
Route::post('create_extension','\Developer\Controllers\DeveloperController@store_extension');
Route::post('create_extension_table','\Developer\Controllers\DeveloperController@send_table_fields');


Route::get('customize_theme_url','\Developer\Controllers\ThemesController@view_theme_url_customize');
Route::post('customize_theme_url','\Developer\Controllers\ThemesController@customize_theme_url');


/*************************/
/*End Developer routes*/
/****************************/
