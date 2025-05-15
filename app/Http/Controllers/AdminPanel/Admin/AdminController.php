<?php

namespace App\Http\Controllers\AdminPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminStoreRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function store(AdminStoreRequest $request)
    {
        dd($request->all());
    }


//    public function login(AdminLoginRequest $adminLoginRequest)
//    {
//        if($adminLoginRequest->role == 'admin')
//        {
//            $user = Admin::where('mobile',$adminLoginRequest->username)->first();
//        }
//    }
}
