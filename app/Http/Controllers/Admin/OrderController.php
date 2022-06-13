<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Order;
use App\PackageList;
use App\Province;
use App\WalletLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;

class OrderController extends Controller
{
    public function index()
    {
        $orders = new Order();

        $data = [
            'total' => 0,
            'total_page' => 0,
            'profit_total' => 0,
            'profit_page' => 0,
        ];

        foreach ($orders->get() as $order) {
            $data['total'] += $order->send_price;
            foreach ($order->orderLists as $orderList) {
                $data['total'] += $orderList->count * $orderList->discount;

                $data['profit_total'] += (($orderList->discount - $orderList->company_price) * 20 / 100) * $orderList->count;
            }
        }

        $orders = $orders->latest()->paginate(10);

        foreach ($orders as $order) {
            $data['total_page'] += $order->send_price;
            foreach ($order->orderLists as $orderList) {
                $data['total_page'] += $orderList->count * $orderList->discount;

                $data['profit_page'] += (($orderList->discount - $orderList->company_price) * 20 / 100) * $orderList->count;
            }
        }


        return view('admin.orders.index')->with([
            'orders' => $orders,
            'data' => $data
        ]);
    }

    public function search(Request $request)
    {
        $orders = new Order();

        if ($request->date) $orders = $orders->where('created_at', 'LIKE', '%' . $request->date . '%');
        if ($request->mobile) $orders = $orders->whereHas('user', function ($q) use ($request) {
            $q->where('mobile', $request->mobile);
        });
        if ($request->id) $orders = $orders->where('id', $request->id);
        if ($request->status) $orders = $orders->where('status', $request->status);

        $data = [
            'total' => 0,
            'total_page' => 0,
            'profit_total' => 0,
            'profit_page' => 0,
        ];

        foreach ($orders->get() as $order) {
            $data['total'] += $order->send_price;
            foreach ($order->orderLists as $orderList) {
                $data['total'] += $orderList->count * $orderList->discount;

                $data['profit_total'] += (($orderList->discount - $orderList->company_price) * 20 / 100) * $orderList->count;
            }
        }

        $orders = $orders->latest()->paginate(10);

        foreach ($orders as $order) {
            $data['total_page'] += $order->send_price;
            foreach ($order->orderLists as $orderList) {
                $data['total_page'] += $orderList->count * $orderList->discount;

                $data['profit_page'] += (($orderList->discount - $orderList->company_price) * 20 / 100) * $orderList->count;
            }
        }

        return view('admin.orders.index')->with([
            'orders' => $orders,
            'data' => $data
        ]);
    }

    public function showOrders($id)
    {
        $orders = new Order();
        $orders = $orders->where('user_id', $id)->paginate(10);

        return view('profile.order')->with([
            'orders' => $orders
        ]);
    }

    public function orderList(Order $order)
    {
        $order = $order->load('address', 'orderLists');

        $total = 0;
        foreach ($order->orderLists as $orderList) {
            $total += $orderList->price * $orderList->count;
        }


        return view('profile.factor')->with([
            'order' => $order,
            'total' => $total,
        ]);
    }

    public function factor($id)
    {
        $order = new Order();
        $order = $order->where('id', $id)->first();

        $total = 0;
        foreach ($order->orderLists as $orderList) {
            $total += $orderList->discount * $orderList->count;
        }

        $total += $order->send_price;

        return view('admin.orders.factor')->with([
            'order' => $order,
            'total' => $total,
        ]);
    }

    public function changeStatus($id, $status)
    {

        $order = new Order();
        $order = $order->where('id', $id)->first();
        $order->send_status = $status;
        $order->save();

        if ($status == 'delivery') {
            foreach ($order->orderLists as $orderList) {
                $orderList->product->user->increment('wallet', $orderList->company_price * $orderList->count);

                if ($order->user->parentUser) {
                    $order->user->parentUser->increment('wallet', $orderList->product->commission * $orderList->count);
                }
            }
        }

        alert()->success('با موفقیت تغییر وضعیت داده شد');

        return response()->json([], 200);
    }

    public function changeClear($id, $clear)
    {
        Order::where('id', $id)->update([
            'clear' => $clear
        ]);

        return response()->json([], 200);
    }

    public function create()
    {
        if (!auth()->check())
            return redirect('/');

        $provinces = new Province();
        $provinces = $provinces->get();

        $carts = Cart::where('user_id', auth()->user()->id)->get();
        $total_weight = 0;
        $total_cart = 0;
        $commission = 0;

        foreach ($carts as $cart) {
            $total_cart += $cart->product->discount * $cart->qty;
            $total_weight += $cart->qty * $cart->product->limit_weight;

            if (auth()->check() && auth()->user()->hasPlan($cart->product->categories()->first()->id)) {
                $commission += $cart->product->commission() * $cart->qty;
            }
        }

//        if ($total_weight > 10000) {
//            alert()->error('وزن سفارش شما نباید بیشتر از 10 کیلو گرم باشد')->autoclose('5000');
//            return redirect()->back();
//        } else {
//            $send_price = ['sefareshi' => 0, 'pishtaz' => 0];
//
//            if ($total_weight < 2000) {
////                $send_price['sefareshi'] = 15000;
//                $send_price['pishtaz'] = 25000;
//            } elseif ($total_weight >= 2000 && $total_weight < 5000) {
////                $send_price['sefareshi'] = 18000;
//                $send_price['pishtaz'] = 40000;
//            } elseif ($total_weight >= 5000 && $total_weight < 8000) {
////                $send_price['sefareshi'] = 30000;
//                $send_price['pishtaz'] = 60000;
//            } elseif ($total_weight >= 8000 && $total_weight <= 10000) {
////                $send_price['sefareshi'] = 38000;
//                $send_price['pishtaz'] = 80000;
//            }


        return view('marketing.orderStepTwo')->with([
            'carts' => $carts,
            'total_cart' => $total_cart,
            'total_weight' => $total_weight,
            'provinces' => $provinces,
            'commission' => $commission,
//            'send_price' => $send_price
        ]);
    }

    public function shopPayment(Request $request)
    {
        $request->validate([
            'postal_code' => 'required|digits:10|numeric',
            'address' => 'required|string',
            'mobile' => 'required|numeric|digits:11',
            'description' => 'nullable|string',
            'city_id' => 'required|numeric',
            'send_type' => 'required|numeric',
        ]);

        $city_id = $request->city_id;

        if ($request->address_index == 1) {
            $city_id = 217;
        }

        $address = auth()->user()->addresses()->create([
            'city_id' => $city_id,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'mobile' => $request->mobile,
        ]);

        $final_total = 0;
        $total_weight = 0;
        $commission = 0;
        foreach (auth()->user()->carts as $cart) {
            $final_total += $cart->product->discount * $cart->qty;
            $total_weight += $cart->qty * $cart->product->limit_weight;

            if (auth()->check() && auth()->user()->hasPlan($cart->product->categories()->first()->id)) {
                $commission += $cart->product->commission() * $cart->qty;
            }
        }

//        $send_price = ['sefareshi' => 0, 'pishtaz' => 0];
//
//        if ($total_weight < 2000) {
////                $send_price['sefareshi'] = 15000;
//            $send_price['pishtaz'] = 25000;
//        } elseif ($total_weight >= 2000 && $total_weight < 5000) {
////                $send_price['sefareshi'] = 18000;
//            $send_price['pishtaz'] = 40000;
//        } elseif ($total_weight >= 5000 && $total_weight < 8000) {
////                $send_price['sefareshi'] = 30000;
//            $send_price['pishtaz'] = 60000;
//        } elseif ($total_weight >= 8000 && $total_weight <= 10000) {
////                $send_price['sefareshi'] = 38000;
//            $send_price['pishtaz'] = 80000;
//        }

//        if ($request->send_type == 1)
//            $send_price = $send_price['sefareshi'];
//        else
//            $send_price = $send_price['pishtaz'];

        $final_total += 15000;
        $final_total -= $commission;

        $MerchantID = 'aeeee87e-8f7b-11e9-bd33-000c29344814';
        $Amount = $final_total;
        $Description = 'هزینه پست به شهرهای دیگر 15,000 تومان میباشد';
        $Email = 'nbpacademy@gmail.com';
        $Mobile = auth()->user()->mobile;
        $CallbackURL = 'http://www.nbpmarketing.ir/payments/result';

        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => $Email,
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );

//Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {

            $order = Order::create([
                'user_id' => auth()->user()->id,
                'address_id' => $address->id,
                'Authority' => $result->Authority,
                'status' => 'init',
                'send_price' => 0,
                'send_type' => $request->send_type,
                'description' => $request->description
            ]);

            foreach (auth()->user()->carts as $cart) {
                $order->orderLists()->create([
                    'product_id' => $cart->product_id,
                    'count' => $cart->qty,
                    'price' => $cart->product->price,
                    'discount' => $cart->product->discount,
                    'company_price' => $cart->product->company_price,
                    'production_price' => $cart->product->production_price,
                ]);
            }

            return redirect('https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
        } else {
            alert()->error('خطا در پرداخت.');
            return redirect('/shop');
        }
    }

    public function show(Order $order)
    {
        $total = 0;
        foreach ($order->orderLists as $orderList) {
            $total += $orderList->discount * $orderList->count;
        }

        return view('marketing.factor')->with([
            'order' => $order,
            'total' => $total,
        ]);
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }

    public function userOrders()
    {
        return view('homePages.orders', [
            'orders' => auth()->user()->orders
        ]);
    }

    public function userFactor($id)
    {
        $order = new Order();
        $order = $order->where('id', $id)->first();

        $total = 0;
        foreach ($order->orderLists as $orderList) {
            $total += $orderList->discount * $orderList->count;
        }

        return view('homePages.factor')->with([
            'order' => $order,
            'total' => $total,
        ]);
    }
}
