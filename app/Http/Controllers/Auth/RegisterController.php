<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Position;
use App\Rules\VisitorCode;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/plans';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
//            'national_code' => ['required'],
            'mobile' => ['required', 'string', 'max:11', 'min:11', 'unique:users'],
//            'birth_date' => ['required', 'string'],
            'parent_id' => 'required|exists:positions,visitor_code',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
//            'email' => ['string', 'email', 'max:255', 'unique:users'],
//            'province' => ['required', 'integer'],
//            'city' => ['required', 'integer'],
        ]);
    }

    protected function customerValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string'],
//            'national_code' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'mobile' => ['required', 'string', 'max:11', 'min:11', 'unique:users'],
//            'birth_date' => ['required', 'string'],
//            'city' => ['required', 'string'],
        ]);
    }

    protected function userValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'last_name' => ['required', 'string'],
            'mobile' => ['required', 'string', 'max:11', 'min:11', 'unique:users'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
//            'national_code' => $data['national_code'],
            'mobile' => $data['mobile'],
//            'birth_date' => $data['birth_date'],
//            'city_id' => $data['city'],
            'level' => 'visitor',
            'parent' => $data['parent_id'],
//            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        alert()->success('ثبت نام با موفقیت انجام شد');
        return $user;
    }

    protected function customerCreate(array $data)
    {
        $register = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
//            'national_code' => $data['national_code'],
            'mobile' => $data['mobile'],
//            'birth_date' => $data['birth_date'],
//            'city_id' => $data['city'],
            'level' => 'seller',
            'password' => Hash::make($data['password']),
        ]);

        alert()->success('ثبت نام با موفقیت انجام شد');
        return $register;
    }

    protected function userCreate(array $data)
    {
        $register = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'level' => 'user',
            'password' => Hash::make($data['password']),
        ]);

        alert()->success('ثبت نام با موفقیت انجام شد');
        return $register;
    }
}
