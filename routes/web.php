<?php

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('tst' , function (){

//    $admin = \App\Models\Admin::find(1);
//    $role = \App\Models\Role::where('title_en', 'admin')->first();
//    $admin->roles()->attach($role->id); // یا sync([$role->id])
//
//    dd($admin->roles);
//    $permission = Permission::where('title_en', 'manage_tours')->first();
//
//    dd($permission);


    $admin = Admin::find(1);

    $role = Role::where('title_en', 'admin')->first();
    $permission = Permission::where('title_en', 'manage_tours')->first();

// دادن نقش به ادمین
    $admin->roles()->attach($role->id);

// دادن دسترسی مستقیم
    $admin->permissions()->attach($permission->id);

// دادن دسترسی به نقش
    $role->permissions()->attach($permission->id);

// بررسی دسترسی
    if ($admin->hasPermission('manage_tours')) {
        dd( "دسترسی دارد.");
    } else {
        dd ("دسترسی ندارد.");
    }



});
