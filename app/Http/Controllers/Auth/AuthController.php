<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('auth.index');
        }
        $request->validate([
            'phone' => 'required|iran_mobile|digits:11'
        ]);

        try {
            //ارسال پیامک
            $response = Http::get(env('APP_URL_API').'/tokenservice/entry/'.$request->phone);
//            اعتبار سنجی
            $data = $response->json();
            if ($data['status']){
                $user = User::where('Phone', $request->phone)->first();
                $token = Hash::make('asleseyhf@!asfyseaf@%%$$!!');
                if ($user) {
                    $user->update([
                        'LoginToken' => $token,
                        'Name' => $data['name'],
                        'Avatar' => $data['avatar'],
                        'Role' => $data['level']==1 ? 1 : 2,
                    ]);
                    $user->save();
                    return response(['loginToken' => $token], 200);
                } else {
                    $user=User::create([
                        'Phone'=>$request->phone,
                        'LoginToken' => $token,
                        'Name' => $data['name'],
                        'Avatar' => $data['avatar'],
                        'Role' => $data['level']==1 ? 1 : 2,
                    ]);
                    $user->save();
                }

                return response(['loginToken' => $token], 200);
            }else{
                return response(['errors' => 'خطایی در ارسال پیامک وجود دارد.'], 422);
            }
        } catch (\Exception $exception) {
            return response(['errors' => 'خطایی در ارسال پیامک وجود دارد.'], 422);
        }
    }

    public function admin(Request $request){
        if ($request->method() == 'GET') {
            return view('auth.admin');
        }

        $request->validate([
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('Status', 1)->where('Role', 1)->where('Email', $request->email)->first();
        if ($user){
            if (Hash::check($request->password,$user->Password)){
                auth()->login($user, $remember = true);
                alert()->success('با موفقیت وارد شدید.', 'با تشکر');
                return redirect()->route('admin.index');
            }
            return redirect()->back()->withErrors(['password' => 'پسورد نامعتبر است.']);
        }else{

            return redirect()->back()->withErrors(['email' => 'ایمیل انتخاب شده، معتبر نیست.']);
        }
    }

    public function otp(Request $request)
    {

        $request->validate([
            'otp' => 'required|digits:5',
            'loginToken' => 'required',
        ]);
        try {
            $user = User::where('LoginToken', $request->loginToken)->firstOrFail();
            $response = Http::get(env('APP_URL_API').'/tokenservice/check_token/'.$user->Phone.'/'.$request->otp);
            $data = $response->json();

            if ($data['status']) {
                auth()->login($user, $remember = true);
                alert()->success('با موفقیت وارد شدید.', 'با تشکر');
                return response(['role' => $user->Role==1 ? "admin" : "user"], 200);
            } else {
                return response(['errors' => ['otp' => ['کد تایید نامعتبر است .']]], 422);
            }

        } catch (\Exception $exception) {
            return response(['errors' => $exception->getMessage()], 422);
        }
    }


    public function resendOtp(Request $request)
    {
        $request->validate([
            'loginToken' => 'required',
        ]);

        try {
            $user = User::where('LoginToken', $request->loginToken)->where('Role', 2)->firstOrFail();
            $token = Hash::make('asleseyhf@!asfyseaf@%%$$!!');

            //ارسال پیامک
            $response = Http::get(env('APP_URL_API').'/tokenservice/entry/'.$user->Phone);
            $data = $response->json();

            if ($data['status']) {
                $user->update([
                    'LoginToken' => $token,
                ]);
                return response(['loginToken' => $token], 200);
            }else {
                return response(['errors' => 'خطا در ارسال پیامک'], 422);
            }

        } catch (\Exception $exception) {
            return response(['errors' => $exception->getMessage()], 422);
        }
    }

    public function logout(){
        auth()->logout();
        alert()->success('خروج با موفقیت انجام شد.', 'موفق');
        return redirect(route('home.index'));
    }
}
