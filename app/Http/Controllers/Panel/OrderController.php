<?php

namespace App\Http\Controllers\Panel;

use App\Cart;
use App\Order;
use App\PackageList;
use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;

class OrderController extends Controller
{
    public function index()
    {
        $orders = new Order();

        $orders = $orders->with('orderLists',
            'orderLists.product');

        $orders = $orders->whereHas('orderLists', function ($q) {
            $q->whereHas('product', function ($qs) {
                return $qs->where('user_id', auth()->user()->id);
            });
        })->where('status', 'success');

        $data = [
            'total' => 0,
            'total_page' => 0,
//            'profit_total' => 0,
//            'profit_page' => 0,
        ];

        foreach ($orders->get() as $order) {
//            $data['total'] += $order->send_price;
            foreach ($order->orderLists as $orderList) {
                if ($orderList->product->user_id == auth()->user()->id) {
                    $data['total'] += $orderList->count * $orderList->company_price;

//                    $data['profit_total'] += (($orderList->discount - $orderList->company_price) * 20 / 100) * $orderList->count;
                }
            }
        }

        $orders = $orders->latest()->paginate(10);

        foreach ($orders as $order) {
//            $data['total_page'] += $order->send_price;
            foreach ($order->orderLists as $orderList) {
                if ($orderList->product->user_id == auth()->user()->id) {
                    $data['total_page'] += $orderList->count * $orderList->company_price;

//                    $data['profit_page'] += (($orderList->discount - $orderList->company_price) * 20 / 100) * $orderList->count;
                }
            }
        }


        return view('panel.orders.index')->with([
            'orders' => $orders,
            'data' => $data
        ]);
    }

    public function search(Request $request)
    {
        $orders = new Order();

        $orders = $orders->whereHas('orderLists', function ($q) {
            $q->whereHas('product', function ($qs) {
                return $qs->where('user_id', auth()->user()->id);
            });
        });


        if ($request->date) $orders = $orders->where('created_at', 'LIKE', '%' . $request->date . '%');
        if ($request->mobile) $orders = $orders->whereHas('user', function ($q) use ($request) {
            $q->where('mobile', $request->mobile);
        });
        if ($request->id) $orders = $orders->where('id', $request->id);
        if ($request->status) $orders = $orders->where('status', $request->status);
        if ($request->send_status) $orders = $orders->where('send_status', $request->send_status);

        $data = [
            'total' => 0,
            'total_page' => 0,
//            'profit_total' => 0,
//            'profit_page' => 0,
        ];

        foreach ($orders as $order) {
//            $data['total'] += $order->send_price;
            foreach ($order->orderLists as $orderList) {
                $data['total'] += $orderList->count * $order->company_price;
            }
        }

        $orders = $orders->paginate(25);

        return view('panel.orders.index')->with([
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
            $total += $orderList->company_price * $orderList->count;
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
            if ($orderList->product->user_id == auth()->user()->id)
                $total += $orderList->company_price * $orderList->count;
        }

        return view('panel.orders.factor')->with([
            'order' => $order,
            'total' => $total,
        ]);
    }

    public function changeStatus($id, $status)
    {
        Order::where('id', $id)->update([
            'send_status' => $status
        ]);

        alert()->success('با موفقیت تغییر وضعیت داده شد');

        return response()->json([], 200);
    }

    public function show(Order $order)
    {
        $total = 0;
        foreach ($order->orderLists as $orderList) {
            if ($orderList->product->user_id == auth()->user()->id)
                $total += $orderList->company_price * $orderList->count;
        }

        return view('marketing.factor')->with([
            'order' => $order,
            'total' => $total,
        ]);
    }

    public function send(Order $order)
    {
        $order->orderLists()->update([
            'send' => 1
        ]);
        alert()->success('سفارش با موفقیت ارسال شد.');
        return redirect()->back();
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
}
