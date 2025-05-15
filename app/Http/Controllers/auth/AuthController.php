<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{


    public function sendOtp(Request $request) {

        $request->validate(['mobile' => 'required|string | min:11 | max:11' ]);
        $code = rand(10000, 99999);
        OtpCode::updateOrCreate(
            ['mobile' => $request->mobile],
            [
                'code' => $code,
                'expires_at' => now()->addMinutes(2)
            ],
        );



        return response()->json([
            'message' => 'کد یکبار مصرف با موفقیت ارسال گردید',
            'data' => [
                'mobile' => $request->mobile,
                'code' => $code,
                ]
        ]);
    }



    public function verifyOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string | min:11 | max:11',
            'code' => 'required|string|min:5',
        ]);


        $otp = OtpCode::where('mobile', $request->mobile)
            ->where('code', $request->code)
            ->where('expires_at', '>=', now())
            ->first();


        if (!$otp) {
            return response()->json([
                'message' => 'کد یک‌بار مصرف نامعتبر یا منقضی شده است',
            ], 422);
        }

        $user = User::firstOrCreate(
            ['mobile' => $request->mobile],
            ['password' => null]
        );

        $otp->delete();

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'needs_password' => is_null($user->password),
            'message' => 'ورود شما موفقیت آمیز بود'
        ]);
    }


    public function resendOtp(Request $request)
    {


        $code = rand(10000, 99999);
        OtpCode::updateOrCreate(
            ['mobile' => $request->mobile],
            [
                'code' => $code,
                'expires_at' => now()->addMinutes(2)
            ]
        );

        return response()->json([
            'message' => 'کد یکبار مصرف دوباره ارسال گردید',
            'data' => [
                'mobile' => $request->mobile,
                'code' => $code,
            ]
        ]);
    }


    public function setPassword(Request $request) {

        $request->validate([
            'password' => 'required|string|min:8| max:27',
        ]);
        $user = auth()->user();


        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'message' => 'رمز عبور با موفقیت ثبت گردید'
        ]);
    }


    public function login(Request $request) {
        $request->validate([
            'mobile' => 'required|string |exists:users,mobile',
            'password' => 'required|string | min:8 |max:27',
        ]);
        $user = User::where('mobile', $request->mobile)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'شماره موبایل یا رمز عبور اشتباه است!'], 401);
        }
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'messages'  => ' ورود شما موفقیت آمیز بود',
            'data' => [
                'token' => $token,
                'user' => $user,
            ]

        ]);
    }




}
