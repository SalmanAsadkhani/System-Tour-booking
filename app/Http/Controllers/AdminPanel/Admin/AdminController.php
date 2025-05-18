<?php

namespace App\Http\Controllers\AdminPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\AdminLoginRequest;
use App\Http\Requests\AdminAuth\AdminStoreRequest;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Http\Resources\AdminInfoResource;
use App\Http\Resources\AdminStoreResource;
use App\Http\Resources\StoreTourResource;
use App\Http\Resources\UpdateTourRecource;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

     private static $_all_tours  = null;


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


    public function showTours()
    {


        if (is_null(self::$_all_tours)) {
            self::$_all_tours = Tour::all();
        }

        if(self::$_all_tours->toArray()  == null)
        {
            return response()->json([
                "message"=>"لیست هیچ توری یافت  نشد "
            ],
                404);
        }

        return response()->json([
            'message' => "لیست  تور ها با موفقیت دریافت گردید",
            'data' => self::$_all_tours,
        ]);
    }

    public function storeTours(StoreTourRequest $request , Tour $tour)
    {


        $admin = auth()->user();

        if (!$admin->roles()->where('title_en', 'admin')->exists()) {

            return response()->json([
                'message' => 'دسترسی غیرمجاز',
            ], 401);
        }

        $tours = Tour::create($request->all());

        if ($request->hasFile('image')) {
            $imageUrl = Storage::putFile('/Tour', $request->image);
            $tour->update([
                'image' => $imageUrl
            ]);
        }
        return response()->json([
            'message' => 'تور با موفقیت ایجاد گردید',
            'data' => new StoreTourResource($tours)
        ] , 200);

    }

    public function updateTours(UpdateTourRequest $request , Tour $tour)
    {
        $admin = auth()->user();

        if (!$admin->roles()->where('title_en', 'admin')->exists()) {

            return response()->json([
                'message' => 'دسترسی غیرمجاز',
            ], 401);
        }

        $tour->update($request->all());

        if ($request->hasFile('image')) {
            $imageUrl = Storage::putFile('/Tour', $request->image);
            $tour->update([
                'image' => $imageUrl
            ]);
        }

        return response()->json([
            'message' => 'ویرایش تور با موفقیت انجام گردید',
            'data' => new UpdateTourRecource($tour)
        ]);
    }

    public function destroyTours(Tour $tour)
    {
        $tour->delete();
        return response()->json([
            'message' => "تور مورد نظر با موفقیت حذف شد.",
        ]);
    }
}
