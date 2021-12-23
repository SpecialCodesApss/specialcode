<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

Route::get('/test', function () {

   $permissions = [];
    array_push($permissions,'User_Create');
    array_push($permissions,'User_Read');
    array_push($permissions,'User_Update');
    array_push($permissions,'User_Delete');
        foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
    }

    foreach ($permissions as $permission) {
        $role = Role::where(['name' => "super_admin"])->first();
        $role->givePermissionTo($permission);
        $role = Role::where(['name' => "admin"])->first();
        $role->givePermissionTo($permission);
    }

    //create role
//    $role = Role::create(['name' => "super_admin"]);
//    $role = Role::create(['name' => "admin"]);
//    $role = Role::create(['name' => "section_manager"]);
//    $role = Role::create(['name' => "supervisor"]);
//    $role = Role::create(['name' => "employee"]);
//    $role = Role::create(['name' => "user"]);

//
//    $module_name = "Dashboard";
//    $permissions = [];
//    array_push($permissions,''.$module_name.'-Create');
//    array_push($permissions,''.$module_name.'-Read');
//    array_push($permissions,''.$module_name.'-Update');
//    array_push($permissions,''.$module_name.'-Delete');


    //create premissions
//    foreach ($permissions as $permission) {
//        Permission::create(['name' => $permission]);
//    }

    //give premission to this role
//    foreach ($permissions as $permission) {
//        $role = Role::where(['name' => "super_admin"])->first();
//        $role->givePermissionTo($permission);
//        $role = Role::where(['name' => "admin"])->first();
//        $role->givePermissionTo($permission);
//    }

    //give role for user
//    $user = \App\Models\User::find(1);
//    $user->assignRole('super_admin');



//    $role = Role::where(['name' => "super_admin"])->first();
//    $role->syncPermissions($request->input('permission'));
//    $user = \App\Models\User::find(1);
//    $user->assignRole('admin');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/clearcache',function(){
    \Artisan::call('cache:clear');
    \Artisan::call('auth:clear-resets');
    \Artisan::call('config:clear');
    \Artisan::call('event:clear');
    \Artisan::call('optimize:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('cache:forget spatie.permission.cache');
    \Artisan::call('config:cache');
    return 'Done ..!';
});


Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);


Route::get('/changeLang', function () {

    App::setLocale("en");
    session()->put('locale', "en");
    return trans('messages.admin');
});




Route::get('/add_permission', function () {

    $permissions = [
        'Page-show',
        'Page-list',
        'Page-create',
        'Page-edit',
        'Page-delete',
    ];

    $role = Role::where(['name' => 'Admin'])->first();
    foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
        $role->givePermissionTo($permission);
    }




});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::group(['middleware' => ['auth']], function() {
//    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
//    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
//    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
//});





Route::get('admin/login','App\Http\Controllers\admin\LoginController@index');
Route::middleware("admin")->prefix('admin')->group(function () {

//    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
//    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
//    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

    $admin_sections=\App\Models\Admin_sections::where('controller_name','!=','')->get();
    foreach ($admin_sections as $admin_section){
        Route::resource($admin_section['section_flag'], 'App\Http\Controllers\Admin\\'.$admin_section['controller_name']);
    }

Route::get('/changePassword', 'PasswordController@viewChangePwd')->name('changePassword');
Route::post('/changePassword', 'PasswordController@changePwd')->name('ChangePwd');
});

