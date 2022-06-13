<?php

namespace App\Http\Controllers\Admin;

use App\Checkout;
use App\Discount;
use App\Product;
use App\Library;
use App\Package;
use App\PlanUser;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
//        if (auth()->user()->planUsers()->where('expire_at', '>=', now())->count() == 0) {
//            return redirect('/plans');
//        }

        if (auth()->user()->level == 'user')
            return abort(404);

        $user = auth()->user()->load('plans');

        $packages = new Package();
        $packages = $packages->get();

        $total = Checkout::where('user_id', auth()->user()->id)->sum('price');

        $pos = auth()->user()->positions()->sum('wallet');
        $store = auth()->user()->wallet;

        return view('homePages.index')->with([
            'user' => $user,
            'packages' => $packages,
            'pos' => $pos,
            'store' => $store,
            'total' => $total
        ]);
    }

    public function smsIndex($id)
    {
        return view('homePages.sms', [
            'plan_id' => $id
        ]);
    }

    public function discountCart()
    {
        return view('homePages.discountCart')->with([
            'discounts' => Discount::where('active', 1)->get()
        ]);
    }

    public function library()
    {
        $libraries = new Library();
        $libraries = $libraries->where('status', 1)->paginate(12);

        return view('homePages.libraries.index')->with([
            'libraries' => $libraries
        ]);
    }

    public function visitCart($id)
    {
        $user = auth()->user();

        return view('homePages.visitCart')->with([
            'user' => $user,
            'plan_id' => $id
        ]);
    }

    public function register_sms(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|numeric',
            'password' => 'required|string',
            'plan_id' => 'required'
        ]);

        $api_key = "6F465A5A7A754732615573674A4C6449564F44465875393730556F4362644F446453344974457657515A383D";

        $client = new Client();

        $response = $client->request('post', "http://api.kavenegar.com/v1/{$api_key}/client/add.json", [
            'form_params' => [
                'Fullname' => $request->name,
                'Username' => $request->mobile,
                'password' => $request->password,
                'Mobile' => $request->mobile,
                'Status' => 1,
                'Mininumallowedcredit' => 5000,
            ]
        ]);

        $status = json_decode($response->getBody()->getContents());

        if ($status->return->status == 200) {

            $plan = PlanUser::where('id', $request->plan_id)->first();
            if ($plan->used) {
                alert()->error('این شغل قبلا استفاده شده است.');
                return redirect('user/myPackages');
            }

            if (auth()->user()->id == $plan->user_id) {
                $plan->used = 1;
                $plan->save();
            }

            return redirect('http://nbpsms.ir');
        } else {
            return view('homePages.sms')->with([
                'massage' => "",
            ]);
        }
    }

    public function myPackages()
    {
        $user = auth()->user()->load(['plans' => function ($q) {
            $q->where('expire_at', '>=', now())->where('status', 1)->where('used', 0);
        }]);

        return view('homePages.myPackages', [
            'user' => $user,
        ]);
    }
}
