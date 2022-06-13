<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Contact;
use App\Order;
use App\PackageList;
use App\Plan;
use App\PlanUser;
use App\Position;
use App\User;
use App\WalletLog;
use Illuminate\Http\Request;
use SoapClient;

class IndexController extends Controller
{
    public function index()
    {

        $bestSellers = User::where('best', 1)->where('level', 'visitor')->get();

        $brands = Brand::all();

        return view('index', [
            'bestSellers' => $bestSellers,
            'brands' => $brands,
        ]);
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'string', 'max:11', 'min:11',
                'regex:/09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/'],
            'name' => 'required',
            'last_name' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $contact = new Contact();

        $contact->create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'title' => $request->title,
            'description' => $request->description
        ]);

        alert()->success('پیام شما با موفقیت ثبت شد', 'با تشکر از حسن انتخاب شما');
        return redirect()->back();
    }

    public function storePayment()
    {
        $MerchantID = 'aeeee87e-8f7b-11e9-bd33-000c29344814';
        $Amount = 0; //Amount will be based on Toman
        $Authority = \request('Authority');

        $order = Order::where('Authority', $Authority)->with('orderLists')->first();

        auth()->loginUsingId($order->user_id);

        $commission = 0;

        foreach ($order->orderLists as $orderList) {
            if (auth()->user()->hasPlan($orderList->product->categories()->first()->parent_id))
                $commission += ($orderList->discount - $orderList->company_price) * $orderList->count;

            $Amount += $orderList->count * $orderList->discount;
        }

        $Amount = $Amount - $commission + 15000;

        if (\request('Status') == 'OK' && $order->status != 'success') {

            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100 || $result->Status == 101) {

                $order = Order::where('Authority', $Authority)->first();

                auth()->loginUsingId($order->user_id);

                foreach ($order->orderLists as $orderList) {

                    $orderList->product->increment('buyCount');

//                    if (auth()->user()->parent) {
//                        $p1 = (($orderList->discount - $orderList->company_price) * $orderList->count) * 30 / 100;
//                        auth()->user()->parentUser->increment('wallet', $orderList->product->commission);
//                        WalletLog::create([
//                            'user_id' => auth()->user()->parentUser->user_id,
//                            'price' => floor($p1),
//                            'subject' => 'پورسانت پلن direct selling'
//                        ]);
//                    }

                    $orderList->product->decrement('limit_count', $orderList->count);
                }

//                auth()->user()->increment('wallet', floor((($commission * 50) / 100)));

//                if ($commission) {
//                    WalletLog::create([
//                        'user_id' => auth()->user()->id,
//                        'price' => floor((($commission * 50) / 100)),
//                        'subject' => 'پورسانت آنی'
//                    ]);
//                }

                $order->status = 'success';
                $order->RefID = $result->RefID;
                $order->save();

                auth()->user()->carts()->delete();

                return redirect()->route('shopping.orders.show', ['id' => $order->id]);
            } else {

                auth()->loginUsingId($order->user_id);

                $order->status = 'failed';
                $order->save();

                alert()->error('خطا در پرداخت.');

                return redirect('/shop');
            }
        } else {
            auth()->loginUsingId($order->user_id);

            $order->status = 'failed';
            $order->save();

            alert()->error('پرداخت لغو گردید.');

            return redirect('/shop');
        }
    }

    public function storePackage()
    {
        if (!\request()->has('Authority')) {
            return redirect('/');
        }

        $Authority = request('Authority');
        $planUser = PlanUser::where('Authority', $Authority)->first();

        if (!$planUser) {
            return redirect('/');
        }

        $plan = Plan::find($planUser->plan_id);

        auth()->loginUsingId($planUser->user_id);

        $MerchantID = 'aeeee87e-8f7b-11e9-bd33-000c29344814';
        $Amount = $plan->price + $plan->price * (9 / 100); //Amount will be based on Toman

        if (\request('Status') == 'OK') {

            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );
            if ($result->Status == 100) {
                PlanUser::where('Authority', $Authority)->update([
                    'status' => 'success',
                    'RefID' => $result->RefID,
                ]);

                if (auth()->user()->level == "customer") {
                    $price = $plan->price * (60 / 100);
                    Position::where('visitor_code', auth()->user()->parent)
                        ->increment('wallet', $price);

                    WalletLog::create([
                        'user_id' => auth()->user()->parentUser->user_id,
                        'price' => $price,
                        'subject' => 'پورسانت فروش پکیج'
                    ]);
                }

                alert()->success('پکیج با موفقیت ثبت شد');

                return redirect('user/homePage');

            } else {
                alert()->error('پرداخت نا موفق.');

                PlanUser::where('Authority', $Authority)->update([
                    'status' => 'failed',
                ]);

                return redirect('/');
            }

        } else {
            alert()->info('پرداخت با موفقیت لغو گردید.');
            PlanUser::where('Authority', $Authority)->update([
                'status' => 'failed',
            ]);
            return redirect('/');
        }
    }

    public function storePlan()
    {
        if (!\request()->has('Authority')) {
            return redirect('/');
        }

        $Authority = request('Authority');
        $planUsers = PlanUser::where('Authority', $Authority)->get();

        if (count($planUsers) == 0) {
            return redirect('/');
        }

        $plans = session('planCart');

        $price = $planUsers->sum('price');
        $price += $price * (9 / 100);

        auth()->loginUsingId($planUsers->first()->user_id);

        $MerchantID = 'aeeee87e-8f7b-11e9-bd33-000c29344814';
        $Amount = $price; //Amount will be based on Toman

        if (\request('Status') == 'OK') {

            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100) {
                PlanUser::where('Authority', $Authority)->update([
                    'status' => 1,
                    'RefID' => $result->RefID,
                ]);

                alert()->success('پکیج با موفقیت ثبت شد');
                auth()->loginUsingId($planUsers->first()->user_id);
                return redirect('user/homePage');

            } else {
                alert()->error('پرداخت نا موفق.');

                PlanUser::where('Authority', $Authority)->update([
                    'status' => 0,
                ]);
                auth()->loginUsingId($planUsers->first()->user_id);
                return redirect('/');
            }

        } else {

            alert()->info('پرداخت با موفقیت لغو گردید.');
            PlanUser::where('Authority', $Authority)->update([
                'status' => 0,
            ]);
            auth()->loginUsingId($planUsers->first()->user_id);
            return redirect('/');
        }
    }
}
