<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::post('register', [App\Http\Controllers\API\RegisterController::class, 'register']);

//Route::post('login', [App\Http\Controllers\RegisterController::class, 'login']);

//Route::middleware('auth:api')->group( function () {
//    Route::resource('products', App\Http\Controllers\ProductController::class);
//});

//Route::resource('products', App\Http\Controllers\API\ProductController::class);



//forget password
Route::get('SendMobileResetCode/{mobile}', 'App\Http\Controllers\API\ForgotPasswordController@SendMobileResetCode');
Route::get('SendEmailResetCode/{email}', 'App\Http\Controllers\API\ForgotPasswordController@SendEmailResetCode');
Route::post('CheckResetCode', 'App\Http\Controllers\API\ForgotPasswordController@CheckResetCode');
Route::post('ResetPassword', 'App\Http\Controllers\API\ForgotPasswordController@ResetPassword');


Route::middleware('auth:api')->group( function () {

    //change password
    Route::post('ChangePassword', 'App\Http\Controllers\API\ForgotPasswordController@ChangePassword');
    //chnage user/store profile
    Route::get('GetProfile', 'App\Http\Controllers\API\UserController@index');
    Route::post('UpdateProfile', 'App\Http\Controllers\API\UserController@update');

    //Verify Email and mobile
    Route::post('SendMobVerifyCode', 'App\Http\Controllers\API\VerificationController@SendMobVerifyCode');
    Route::post('SendEmailVerifyCode', 'App\Http\Controllers\API\VerificationController@SendEmailVerifyCode');
    Route::post('VerifyCode', 'App\Http\Controllers\API\VerificationController@VerifyCode');
    Route::post('UpdateVerMobile', 'App\Http\Controllers\API\VerificationController@UpdateVerMobile');
    Route::post('UpdateVerEmail', 'App\Http\Controllers\API\VerificationController@UpdateVerEmail');

    //Notifications
    Route::get('notifications', 'App\Http\Controllers\API\NotificationController@index');
    Route::get('notifications/unread', 'App\Http\Controllers\API\NotificationController@unread');
    Route::delete('notifications/{id}', 'App\Http\Controllers\API\NotificationController@destroy');
    Route::put('notifications', 'App\Http\Controllers\API\NotificationController@update');

    //Profile
    Route::get('user/profile', 'App\Http\Controllers\API\UserController@profile');
    Route::put('users', 'App\Http\Controllers\API\UserController@update');


    //get routes for API which inserted into database Route Table For new modules
    $auth_routes=App\Models\Route::where(['type'=>'api_routes','middleware' => 'auth'])->get();
    if(isset($auth_routes)){
        foreach ($auth_routes as $route){
            if($route['request_method_type']=='get'){
                Route::get
                (''.$route['router_name'], $route['controller_name'].'@'.$route['controller_method']);
            }
            elseif ($route['request_method_type'] == 'post'){
                Route::post
                (''.$route['router_name'], $route['controller_name'].'@'.$route['controller_method']);
            }
        }
    }



    //get routes for API which inserted into database Route Table For new modules
    $default_routes=\App\Models\Route::where(['type'=>'api_routes','middleware' => null])->get();
    if(isset($default_routes)){
        foreach ($default_routes as $route){
            if($route['request_method_type']=='get'){
                Route::get
                (''.$route['router_name'], 'App\Http\Controllers\API\\'.$route['controller_name'].'@'.$route['controller_method']);
            }
            elseif ($route['request_method_type'] == 'post'){
                Route::post
                (''.$route['router_name'], 'App\Http\Controllers\API\\'.$route['controller_name'].'@'.$route['controller_method']);
            }
        }
    }



    //get routes for API which inserted into database Route Table For new modules
//    $auth_routes=\App\Route::where(['type'=>'api_routes','middleware' => 'auth'])->get();
//    if(isset($auth_routes)){
//        foreach ($auth_routes as $route){
//            if($route['request_method_type']=='get'){
//                Route::get
//                (''.$route['router_name'], $route['controller_name'].'@'.$route['controller_method']);
//            }
//            elseif ($route['request_method_type'] == 'post'){
//                Route::post
//                (''.$route['router_name'], $route['controller_name'].'@'.$route['controller_method']);
//            }
//        }
//    }


});


//
//Route::middleware('auth:api')->group( function () {
//    Route::get($request['name'], 'App\Http\Controllers\API\\'.$request['controller_name'].'@index');
//});


// Routes for Auto Generated Models

$api_requests=\App\Models\Api_request::all();
foreach ($api_requests as $request){

    //List
    if($request['list_authorization_status'] == 1){
        Route::middleware('auth:api')->group( function () use ($request) {
            Route::get($request['name'], 'App\Http\Controllers\API\\'.$request['controller_name'].'@index');
        });
    }else{
        Route::middleware('api')->group( function () use ($request) {
            Route::get($request['name'], 'App\Http\Controllers\API\\'.$request['controller_name'].'@index');
        });
    }

    //Create
    if($request['create_authorization_status'] == 1){
        Route::middleware('auth:api')->group( function () use ($request) {
            Route::post($request['name'], 'App\Http\Controllers\API\\'.$request['controller_name'].'@store');
        });
    }else{
        Route::middleware('api')->group( function () use ($request) {
            Route::post($request['name'], 'App\Http\Controllers\API\\'.$request['controller_name'].'@store');
        });
    }

    //Update
    if($request['update_authorization_status'] == 1){
        Route::middleware('auth:api')->group( function () use ($request) {
            Route::put($request['name'].'/{id}', 'App\Http\Controllers\API\\'.$request['controller_name'].'@update');
        });
    }else{
        Route::middleware('api')->group( function () use ($request) {
            Route::put($request['name'].'/{id}', 'App\Http\Controllers\API\\'.$request['controller_name'].'@update');
        });
    }

    //View
    if($request['view_authorization_status'] == 1){
        Route::middleware('auth:api')->group( function () use ($request) {
            Route::get($request['name'].'/{id}', 'App\Http\Controllers\API\\'.$request['controller_name'].'@show');
        });
    }else{
        Route::middleware('api')->group( function () use ($request) {
            Route::get($request['name'].'/{id}', 'App\Http\Controllers\API\\'.$request['controller_name'].'@show');
        });
    }

    //Delete
    if($request['delete_authorization_status'] == 1){
        Route::middleware('auth:api')->group( function () use ($request) {
            Route::delete($request['name'].'/{id}', 'App\Http\Controllers\API\\'.$request['controller_name'].'@destroy');
        });
    }else{
        Route::middleware('api')->group( function () use ($request) {
            Route::delete($request['name'].'/{id}', 'App\Http\Controllers\API\\'.$request['controller_name'].'@destroy');
        });
    }

}




