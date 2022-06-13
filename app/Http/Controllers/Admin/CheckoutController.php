<?php

namespace App\Http\Controllers\Admin;

use App\Checkout;
use App\Position;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{

    public function userIndex()
    {
        $user = auth()->user();
        $checkouts = $user->checkouts()->latest()->paginate(20);

        return view('homePages.checkouts')->with([
            'checkouts' => $checkouts,
            'user' => auth()->user()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'position_id' => 'nullable'
        ]);

        $position = Position::where('id', $request->position_id)->first();

        if ($position) {
            if ($position->wallet < 50000) {
                alert()->warning('حداقل مبلغ قابل برداشت 50,000 تومان میباشد.');
                return back();
            }

            if (auth()->user()->id == $position->user_id) {
                if (Checkout::where('position_id', $request->position_id)->where('status', 'init')->exists()) {
                    alert()->error('یک درخواست در دست بررسی موجود می‌باشد.')->cancelButton("باشه");
                } else {
//                    Checkout::create([
//                        'position_id' => $request->position_id,
//                        'price' => $position->wallet,
//                        'user_id' => auth()->user()->id,
//                        'status' => 'success'
//                    ]);

                    auth()->user()->increment('wallet', $position->wallet);

                    $position->decrement('wallet', $position->wallet);
                    $position->save();

                    alert()->success('با موفقیت به کیف پول انتقال پیدا کرد.');
                    return redirect()->back();
                }
            }
            return redirect()->back();
        } else {
            if (Checkout::where('user_id', auth()->user()->id)->where('status', 'init')->exists()) {
                alert()->error('یک درخواست در دست بررسی موجود می‌باشد.')->cancelButton("باشه");
                return redirect()->back();
            } else {

                if (auth()->user()->wallet < 50000) {
                    alert()->warning('حداقل مبلغ قابل برداشت 50,000 تومان میباشد.');
                    return back();
                }

                Checkout::create([
                    'price' => auth()->user()->wallet,
                    'user_id' => auth()->user()->id
                ]);

                alert()->success('درخواست تسویه حساب با موفقیت ذخیره گردید.');
                return redirect()->back();
            }
        }
    }

    public function userCommission()
    {
        $commissions = auth()->user()->commissions()->latest()->paginate(25);
        return view('homePages.commission', [
            'commissions' => $commissions,
            'user' => auth()->user()
        ]);
    }
}
