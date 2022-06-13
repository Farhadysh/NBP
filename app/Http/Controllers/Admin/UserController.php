<?php

namespace App\Http\Controllers\Admin;

use App\Plan;
use App\Position;
use App\Role;
use App\User;
use App\Jobs\mlm;
use App\WalletLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = new User();
        $users = $users->where('active', 1)
            ->orderBy('id', 'desc')->paginate(10);

        return view(\request()->route()->getName())->with([
            'users' => $users
        ]);
    }

    public function plan()
    {

        $positions = new Position();
        $positions = $positions->get();


        foreach ($positions as $position) {
            if ($position->r_hand >= 1 && $position->l_hand >= 1) {
                $r_hand_k = intdiv($position->r_hand, 1);
                $l_hand_k = intdiv($position->l_hand, 1);

                while ($r_hand_k >= 1 && $l_hand_k >= 1) {
                    $position->wallet += 130000;
                    $position->save();

                    WalletLog::create([
                        'user_id' => $position->user_id,
                        'price' => 130000,
                        'subject' => 'پاداش مشاور',
                    ]);

                    $r_hand_k--;
                    $l_hand_k--;
                }

                $r_hand_b = fmod($position->r_hand, 1);
                $l_hand_b = fmod($position->l_hand, 1);

                $position->r_hand = $r_hand_k * 1;
                $position->l_hand = $l_hand_k * 1;
                $position->save();

                $position->r_hand += $r_hand_b;
                $position->l_hand += $l_hand_b;
                $position->save();
            }
        }

//        $job = new mlm();
//        $this->dispatch($job);
//        Artisan::call('queue:work');

        alert()->success('با موفقیت انجام شد');
        return redirect()->back();
    }

    public function showChild($id)
    {
        $user = new User();
        $user = $user->where('id', $id)->with('positions')->first();

        return view('admin.users.showChild')->with([
            'user' => $user,
        ]);
    }

    public function search(Request $request)
    {
        $users = new User();

        if ($request->last_name) $users = $users->where('last_name', 'LIKE', '%' . $request->last_name . '%');
        if ($request->mobile) $users = $users->where('mobile', $request->mobile);
        if ($request->visitor_cod) $users = $users->where('visitor_cod', $request->visitor_cod);
        if ($request->level) $users = $users->where('level', $request->level);

        $users = $users->paginate(10);

        return view('admin.users.index')->with([
            'users' => $users
        ]);

    }

    public function addWallet(Request $request)
    {
        $user = new User();
        $user = $user->where('id', $request->user_id)->first();
        if ($request->type)
            $user->wallet += $request->addWallet;
        else
            $user->wallet -= $request->addWallet;
        $user->save();

        alert()->success('درخواست با موفقیت انجام شد');

        return redirect()->back();
    }

    public function walletRequest()
    {
        auth()->user()->update([
            'wallet_status' => 1
        ]);

        alert()->success('درخواست با موفقیت ارسال شد');

        return redirect()->back();
    }

    public function profileEdit()
    {
        $user = auth()->user();

//        return $user;

        return view('profile.index')->with([
            'user' => $user
        ]);
    }

    public function profileImage(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);

        $image = $this->uploadImage($request->file('image'), 'profile');

        auth()->user()->update([
            'image' => $image,
            'best' => 0
        ]);

        alert()->success('با موفقیت ویرایش شد');

        return redirect()->back();
    }

    public function profileUpdate(Request $request, User $user)
    {
        if ($user->level == 'visitor' || $user->level == 'admin') {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'Reference_code' => 'nullable|exists:positions,visitor_code'
            ]);

            $user->email = $request->email;
            $user->bank_id = $request->bank_id;
            $user->save();

            alert()->success('با موفقیت ویرایش شد');
            return redirect()->back();

        } elseif ($user->level == 'user') {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'last_name' => ['required', 'string'],
                'mobile' => ['required', 'numeric', 'unique:users,id,' . $user->id],
            ]);

            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->save();

            alert()->success('با موفقیت ویرایش شد');
            return redirect()->back();
        }
    }

    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        alert()->success('رمز با موفقیت تغییر یافت');

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = $user->load('plans');

        return view(\request()->route()->getName())->with([
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view(\request()->route()->getName())->with([
            'user' => $user,
            'roles' => Role::all(),
            'plans' => Plan::where('active', 1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|unique:users,id,' . $user->id,
            'national_code' => 'required',
            'level' => 'required',
            'parent' => 'nullable|exists:positions,visitor_code',
            'password' => 'nullable|string|max:255'
        ]);

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        $user->national_code = $request->national_code;
        $user->level = $request->level;
        $user->parent = $request->parent;
        if ($request->password)
            $user->password = Hash::make($request->password);
        $user->save();

        if ($request->role_id[0])
            $user->roles()->sync($request->role_id);

        alert()->success('با موفقیت ویرایش شد');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function bestSeller(User $user)
    {
        $message = "";
        if ($user->best) {
            $user->best = 0;
            $message = "با موفقیت از لیست حذف شد.";
        } else {
            $user->best = 1;
            $message = "با موفقیت به لیست اضافه شد.";
        }

        $user->save();

        alert()->success($message);

        return back();
    }

    public function addPlan(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'plan_id' => 'required'
        ]);

        $user = User::find($request->user_id);
        $plan = Plan::find($request->plan_id);
        $user->plans()->create([
            'plan_id' => $plan->id,
            'price' => 0,
            'score' => $plan->score,
            'expire_at' => now()->addDays(365),
            'status' => 1,
            'Authority' => 0
        ]);

        alert()->success('شغل با موفقیت اضافه شد.');

        return back();
    }
}
