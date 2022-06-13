<?php

namespace App\Http\Controllers\Admin;

use App\Checkout;
use App\Position;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CheckoutAdminController extends Controller
{
    public function index(Request $request)
    {
        $checkouts = new Checkout();

        $checkouts = $checkouts->whereHas('user', function ($q) {
            return $q->where('level', '<>', 'seller');
        });

        if ($request->last_name)
            $checkouts = $checkouts->whereHas('user', function ($q) use ($request) {
                $q->where('last_name', 'LIKE', '%' . $request->last_name . '%');
            });

        if ($request->mobile)
            $checkouts = $checkouts->whereHas('user', function ($q) use ($request) {
                $q->where('mobile', 'LIKE', '%' . $request->mobile . '%');
            });

        if ($request->visitor_code)
            $checkouts = $checkouts->whereHas('position', function ($q) use ($request) {
                $q->where('visitor_code', 'LIKE', '%' . $request->visitor_code . '%');
            });

        $checkouts = $checkouts->with('user', 'position')->latest()->paginate(30);

        return view(\request()->route()->getName(), [
            'checkouts' => $checkouts
        ]);
    }


    public function seller(Request $request)
    {
        $checkouts = new Checkout();

        $checkouts = $checkouts->whereHas('user', function ($q) {
            return $q->where('level', 'seller');
        });

        if ($request->last_name)
            $checkouts = $checkouts->whereHas('user', function ($q) use ($request) {
                $q->where('last_name', 'LIKE', '%' . $request->last_name . '%');
            });

        if ($request->mobile)
            $checkouts = $checkouts->whereHas('user', function ($q) use ($request) {
                $q->where('mobile', 'LIKE', '%' . $request->mobile . '%');
            });

        if ($request->visitor_code)
            $checkouts = $checkouts->whereHas('position', function ($q) use ($request) {
                $q->where('visitor_code', 'LIKE', '%' . $request->visitor_code . '%');
            });

        $checkouts = $checkouts->with('user', 'position')->latest()->paginate(30);

        return view(\request()->route()->getName(), [
            'checkouts' => $checkouts
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'position_id' => 'nullable',
            'checkout_id' => 'required'
        ]);

        DB::beginTransaction();

        try {

            $checkout = new Checkout();

            $checkout = $checkout->where('id', $request->checkout_id)->first();

            $checkout->status = 'success';
            $checkout->save();

            if ($request->position_id) {
                $position = new Position();
                $position = $position->where('id', $request->position_id)->first();

                $position->decrement('wallet', $checkout->price);
            } else {
                $user = new User();
                $user = $user->where('id', $checkout->user_id)->first();
                $user->decrement('wallet', $checkout->price);
                $user->save();
            }

            alert()->success("با موفقیت تسویه شد.");

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            alert()->error("خطایی رخ داده است.");
        }
        return redirect()->back();
    }
}
