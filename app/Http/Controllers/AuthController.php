<?php


namespace App\Http\Controllers;


use App\ActiveCode;
use App\services\SendSms;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        if (auth()->check())
            return redirect('/');
    }

    public function showForgetForm()
    {
        return view('auth.password.forgetPassword');
    }

    public function verifyMobile(Request $request)
    {
        $data = $request->validate([
            'mobile' => 'required|numeric|digits:11|exists:users'
        ]);

        $user = User::where('mobile', $data['mobile'])->first();

        if (!$user)
            return redirect('/password/forget');

        $code = ActiveCode::generateCode($user);
        \request()->session()->flash('mobile', $data['mobile']);

        try {
            $sms = new SendSms();
            $data = [
                'mobile' => $user->mobile,
                'code' => $code
            ];

            $sms->otp($data);
        } catch (\Exception $exception) {

        }

        return redirect('/password/verify');
    }

    public function showVerifyForm()
    {
        if (!\request()->session()->has('mobile'))
            return redirect('/password/forget');


        \request()->session()->reflash();
        $code = \request()->session()->get('code');
        $mobile = \request()->session()->get('mobile');

        return view('auth.password.verify', ['code' => $code, 'mobile' => $mobile]);
    }

    public function verify(Request $request)
    {
        \request()->session()->reflash();

        $request->validate([
            'code' => 'required'
        ]);

        $user = User::where('mobile', \request()->session()->get('mobile'))->first();

        if (!$user)
            return redirect('/password/forget');

        $status = ActiveCode::verifyCode($request->code, $user);

        if ($status) {
            $user->activeCode()->delete();
            return redirect('/password/reset');
        }
        return back()->withErrors([
            'code' => 'کد وارد شده صحیح نمی‌باشد.'
        ]);
    }

    public function showResetForm()
    {
        if (!\request()->session()->has('mobile'))
            return redirect('/password/forget');

        \request()->session()->reflash();

        return view('auth.password.reset');
    }

    public function reset(Request $request)
    {
        \request()->session()->reflash();

        $request->validate([
            'password' => 'required|string|max:255|confirmed|min:6'
        ]);

        if (!\request()->session()->has('mobile'))
            return redirect('/password/forget');


        $user = User::where('mobile', \request()->session()->get('mobile'))->first();

        if (!$user)
            return redirect('/password/forget');

        $user->password = Hash::make($request->password);
        $user->save();

        alert()->success("رمز عبور شما با موفقیت ویرایش شد.");

        return redirect(route('login'));
    }

    public function resend()
    {
        if (!\request()->session()->has('mobile'))
            return redirect('/password/forget');

        \request()->session()->reflash();

        $data['mobile'] = \request()->session()->get('mobile');

        $user = User::where('mobile', $data['mobile'])->first();

        if (!$user)
            return redirect('/password/forget');

        $code = ActiveCode::generateCode($user);

        try {
            $sms = new SendSms();
            $data = [
                'mobile' => $user->mobile,
                'code' => $code
            ];

            return $sms->otp($data);
        } catch (\Exception $exception) {
        }

        return redirect('/password/verify');
    }
}
