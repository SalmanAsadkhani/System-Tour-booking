<?php

namespace App\Http\Controllers\AdminPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\AdminLoginRequest;
use App\Http\Requests\AdminAuth\AdminStoreRequest;
use App\Http\Requests\StoreTourRequest;
use App\Http\Resources\AdminInfoResource;
use App\Http\Resources\AdminStoreResource;
use App\Http\Resources\StoreTourResource;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Tour;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    public function register(AdminStoreRequest $request , Admin $admin)
    {

        $request['password'] = Hash::make($request['password']);

        $admin  = $admin->create($request->all());

        $defaultRole = Role::where('title_en', 'user')->first();


        if ($defaultRole) {
            $admin->roles()->attach($defaultRole->id);
        }

        if ($admin) {
            return response()->json([
                'message' => ' ثبت نام مدیر با موفقیت انجام گردید',
                'data' => new AdminStoreResource($admin)
            ] , 200);
        }

        return response()->json([
            'message' => 'خطایی در هنگام ثبت نام رخ داد '
        ]);
    }

    public function login(AdminLoginRequest $request)
    {

        $admin = Admin::where('mobile', $request['mobile'])
            ->with('roles')
            ->first();


        if (!$admin && Hash::check($request['password'], $admin->password)) {
            return response()->json([
                'message' => ' اطلاعات وارد شده نادرست است!'
            ], 401);
        }


        $token = $admin->createToken('admin-token')->plainTextToken;

        return response()->json([
            'message' => 'ورود ادمین با موفقیت انجام شد ',
            'token' => $token,
            'data' => new AdminInfoResource($admin)
        ]);
    }


    public function storeTours(StoreTourRequest $request)
    {

        ;
        $admin = auth()->user(); // یا auth('admin')->user() اگر گارد ادمین جدا تعریف کردی

        if (!$admin->roles()->where('title_en', 'admin')->exists()) {

            return response()->json([
                'message' => 'دسترسی غیرمجاز',
            ], 401);
        }

        $tour = Tour::create($request->all());

        return response()->json([
            'message' => 'تور با موفقیت ایجاد گردید',
            'data' => new StoreTourResource($tour)
        ] , 200);

    }

    public function updateTours()
    {

    }

    public function destroyTours()
    {

    }
}
