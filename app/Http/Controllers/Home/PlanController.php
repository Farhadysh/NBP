<?php

namespace App\Http\Controllers\Home;

use App\Address;
use App\Plan;
use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;

class PlanController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check())
                if (auth()->user()->level == 'user' ||
                    auth()->user()->level == 'seller') {
                    return redirect('/');
                } else {
                    return $next($request);
                }

            return redirect('/');
        });
    }

    public function index()
    {
        return view('homePages.plans', [
            'plans' => Plan::where('active', true)->get()
        ]);
    }

    public function addToCart(Plan $plan)
    {
        if ($plan && !is_null($plan)) {
            if (session()->has('planCart')) {
                $plans = session()->get('planCart');

                $plans[] = $plan;
                session()->put('planCart', $plans);

                return redirect('/plans/payments');
            }
            $plans[] = $plan;
            session()->put('planCart', $plans);
            return redirect('/plans/payments');
        }
        alert()->error('خطایی رخ داده است.');
        return back();

    }

    public function removeCart(Plan $plan)
    {
        if (session()->has('planCart')) {
            $plans = session()->get('planCart');
            if (count($plans)) {
                $hasPlan = collect($plans)->where('id', $plan->id)->first();
                if ($hasPlan)
                    foreach ($plans as $key => $p) {
                        if ($p->id == $hasPlan->id) {
                            unset($plans[$key]);
                            break;
                        }
                    }

                session()->put('planCart', $plans);
            }

            return redirect('/plans/payments');
        }

        return redirect('/plans/payments');
    }

    public function showPlanPayment()
    {
        $provinces = Province::get();
        $plans = session()->get('planCart');
        $total = 0;
        foreach ($plans as $plan) {
            if ($plan->discount)
                $total += $plan->discount;
            else
                $total += $plan->price;
        }
        return view('homePages.payment', compact(['plans', 'provinces', 'total']));
    }

    public function store(Request $request)
    {
        $plans = session()->get('planCart');

        if (collect($plans)->where('category_id', 100)->first()) {
            $rules = [
                'postal_code' => 'required|digits:10|numeric',
                'address' => 'required',
                'mobile' => 'required',
                'city_id' => 'required',
                'province' => 'required',
            ];

            $request->validate($rules);


            $address = auth()->user()->addresses()->create([
                'city_id' => $request->city_id,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'mobile' => $request->mobile,
                'description' => $request->description
            ]);
        }

        $price = 0;
        foreach ($plans as $plan) {
            if ($plan->discount)
                $price += $plan->discount;
            else
                $price += $plan->price;
        }

        $MerchantID = 'aeeee87e-8f7b-11e9-bd33-000c29344814';
        $Amount = $price + $price * (9 / 100);
        $Description = 'خرید شغل ';
        $Email = 'nbpacademy@gmail.com';
        $Mobile = auth()->user()->mobile;
        $CallbackURL = 'http://www.nbpmarketing.ir/plan/payments/callback';

        try {
            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentRequest([
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => $Email,
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]);

            if ($result->Status == 100) {
                foreach ($plans as $plan) {
                    auth()->user()->plans()->create([
                        'plan_id' => $plan->id,
                        'price' => $plan->price,
                        'score' => $plan->score,
                        'expire_at' => now()->addDays(365),
                        'Authority' => $result->Authority,
                        'address_id' => $address->id ?? null,
                    ]);
                }

                return redirect('https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
            }

            alert()->error('خطایی رخ داده است.');

        } catch (\SoapFault $e) {
        }

        return back();
    }
}
