<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\register;
use App\Package;
use App\PackageCart;
use App\PackageList;
use App\Plan;
use App\PlanUser;
use App\Position;
use App\User;
use Illuminate\Contracts\Session\Session;
use App\Http\Controllers\Controller;
use SoapClient;

class PackageCartController extends Controller
{
    public function cart($id)
    {
        if (session()->has('user_id')) {
            $user_id = session('user_id');
        } else {
            $user_id = auth()->user()->id;
        }
        $package = new Package();
        $package = $package->where('id', $id)->first();

        PackageCart::create([
            'user_id' => $user_id,
            'package_id' => $id,
            'total_points' => $package->points,
            'image' => $package->image,
            'name' => $package->name,
        ]);

        $packageCart = new PackageCart();
        $packageCart = $packageCart->where('user_id', $user_id)->get();

        return compact('packageCart');
    }

    public function sendPayment()
    {
        if (auth()->check()) {
            $plan = Plan::find(\session('plan_id'));

            $total_points = 0;
            foreach (auth()->user()->packageCarts as $packCart) {
                $total_points += $packCart->total_points * $packCart->count;
            }

            if ($total_points != $plan->score) {
                alert()->error('امتیازات شما نباید بیشتر یا کمتر از مقدار تعیین شده باشد')->autoclose(5000);
                return redirect()->back();
            } else {

                if($plan){
                    $planUser = auth()->user()->planUsers()->create([
                        'plan_id' => $plan->id,
                        'price' => $plan->price,
                        'score' => $plan->score,
                        'positionCount' => $plan->positionCount,
                        'expire_at' => now()->addDays($plan->expire_time),
                        'Authority' => "random",
                        'status' => 'success'
                    ]);

                    foreach (auth()->user()->packageCarts as $packageCart) {
                        $planUser->packageLists()->create([
                            'plan_user_id' => $planUser->id,
                            'package_id' => $packageCart->package_id,
                            'count' => $packageCart->package_id == 2 ? $packageCart->count * 8 : $packageCart->count * 1,
                            'total_points' => $packageCart->total_points,
                            'expire_at' => now()->addDays($plan->expire_time),
                        ]);
                    }

                    auth()->user()->packageCarts()->delete();
                }

//                if ($plan) {
//                    $MerchantID = 'aeeee87e-8f7b-11e9-bd33-000c29344814'; //Required
//                    $Amount = $plan->price + $plan->price * (9 / 100); //Amount will be based on Toman - Required
//                    $Description = 'خرید پکیج خدماتی'; // Required
//                    $Email = 'nbpacademy@gmail.com'; // Optional
//                    $Mobile = auth()->user()->mobile; // Optional
//                    $CallbackURL = 'http://www.nbpmarketing.ir/packageCart/final/store'; // Required
//
//                    $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
//
//                    $result = $client->PaymentRequest(
//                        [
//                            'MerchantID' => $MerchantID,
//                            'Amount' => $Amount,
//                            'Description' => $Description,
//                            'Email' => $Email,
//                            'Mobile' => $Mobile,
//                            'CallbackURL' => $CallbackURL,
//                        ]
//                    );
//
//                    //Redirect to URL You can do it also by creating a form
//                    if ($result->Status == 100) {
//
//                        $planUser = auth()->user()->planUsers()->create([
//                            'plan_id' => $plan->id,
//                            'price' => $plan->price,
//                            'score' => $plan->score,
//                            'positionCount' => $plan->positionCount,
//                            'expire_at' => now()->addDays($plan->expire_time),
//                            'Authority' => $result->Authority,
//                        ]);
//
//                        foreach (auth()->user()->packageCarts as $packageCart) {
//                            $planUser->packageLists()->create([
//                                'plan_user_id' => $planUser->id,
//                                'package_id' => $packageCart->package_id,
//                                'count' => $packageCart->package_id == 2 ? $packageCart->count * 8 : $packageCart->count * 1,
//                                'total_points' => $packageCart->total_points,
//                                'expire_at' => now()->addDays($plan->expire_time),
//                            ]);
//                        }
//
//                        auth()->user()->packageCarts()->delete();
//
//                        return redirect('https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
//                    } else {
//                        return redirect('/');
//                    }
//                } else {
//                    return redirect('/');
//                }
            }
        }
        return redirect('/');
    }

    public function destroy($delete_id)
    {
        if (is_numeric($delete_id)) {


            $Cart_destroy = new PackageCart();
            $Cart_destroy = $Cart_destroy->where('id', $delete_id)->first();
            $Cart_destroy->delete();

            if (session()->has('user_id')) {
                $user_id = session('user_id');
            } else {
                $user_id = auth()->user()->id;
            }
            $packageCart = new PackageCart();
            $packageCart = $packageCart->where('user_id', $user_id)->get();

            return compact('packageCart');
        }
    }

    public function adminStore()
    {
        if (session()->has('user_id')) {
            $user = User::find(session('user_id'));
        } else {
            $user = auth()->user();
        }

        $job = new register($user);
        $this->dispatch($job);

        $total_points = 0;
        foreach ($user->packageCarts as $packCart) {
            $total_points += $packCart->total_points * $packCart->count;
        }

        if ($total_points != 25) {
            alert()->error('امتیازات شما نباید بیشتر یا کمتر از مقدار تعیین شده باشد')->autoclose(5000);
            return redirect()->back();

        } else {

            if (session()->has('user_id')) {
                $user = User::find(session('user_id'));
            } else {
                $user = auth()->user();
            }


            foreach ($user->packageCarts as $packageCart) {
                PackageList::create([
                    'user_id' => $user->id,
                    'package_id' => $packageCart->package_id,
                    'count' => $packageCart->package_id == 2 ? $packageCart->count * 3 : $packageCart->count * 1,
                    'ref_id' => 1234,
                    'total_points' => $packageCart->total_points,
                    'expire_at' => now()->addYear(),
                ]);
            }

            if ($user->visitor_cod == null && $user->Consultant_cod != null) {
                $rand = time();
                $user->visitor_cod = $rand;
                $user->save();
            }

            if ($user->parent) {
                $user->parent->wallet += 50000;
                $user->parent->save();
            }


            $user->packageCarts()->delete();

            Session::forget('user_id');

            alert()->success('پکیج با موفقیت ثبت شد');

            return redirect('/admin');
        }
    }

    public function withOutPackages()
    {
        $users = new User();
        $users = $users->where('level', 'visitor')->doesntHave('packageLists')->orderBy('id', 'desc')->paginate(10);

        return view('admin.adminPackage.index')->with([
            'users' => $users
        ]);
    }

    public function count($cart_id, $count)
    {
        PackageCart::where('id', $cart_id)->update([
            'count' => $count
        ]);

        if (session()->has('user_id')) {
            $user_id = session('user_id');
        } else {
            $user_id = auth()->user()->id;
        }

        $packageCart = new PackageCart();
        $packageCart = $packageCart->where('user_id', $user_id)->get();

        return compact('packageCart');

    }
}
