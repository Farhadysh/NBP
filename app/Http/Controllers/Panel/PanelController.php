<?php

namespace App\Http\Controllers\Panel;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function homePanel()
    {
        $ordersCount = Order::whereHas('orderLists', function ($q) {
            $q->whereHas('product', function ($qs) {
                return $qs->where('user_id', auth()->user()->id);
            });
        })->where('status', 'success')->count();

        $newOrderCount = Order::whereHas('orderLists', function ($q) {
            $q->whereHas('product', function ($qs) {
                return $qs->where('user_id', auth()->user()->id);
            });
        })->where('send_status', 'init')
            ->where('status', 'success')->count();

        $products = Product::where('limit_count', '<', 5)->where('user_id', auth()->user()->id)->get();

        return view(\request()->route()->getName(), [
            'ordersCount' => $ordersCount,
            'newOrderCount' => $newOrderCount,
            'wallet' => auth()->user()->wallet,
            'products' => $products,
            'income' => auth()->user()->checkouts()->where('status', 'success')->sum('price')
        ]);
    }

    public function uploadImage($file, $model)
    {
        return $file ? $this->upload($file, $model) : null;
    }

    public function upload($file, $model)
    {
        $fileName = time() . rand(1, 5000);

        $file->move(public_path('/upload/' . $model), $fileName);

        return "/upload/" . $model . "/" . $fileName;
    }
}
