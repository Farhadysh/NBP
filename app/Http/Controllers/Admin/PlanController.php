<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Plan;
use App\PlanUser;
use Illuminate\Http\Request;

class PlanController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $plans = Plan::latest()->paginate(25);

        return view(\request()->route()->getName(), [
            'plans' => $plans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)
            ->where('active', 1)->OrWhere('name', 'محصول')->get();
        return view(\request()->route()->getName(), ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'discount' => 'nullable|integer',
            'score' => 'required|numeric',
            'image' => 'required',
            'category_id' => 'nullable',
            'description' => 'required|string',
        ]);

        $data['image'] = $this->uploadImage($request->image, "plans");

        Plan::create($data);

        alert()->success('پلن با موفقیت ایجاد گردید.');

        return redirect()->route('admin.plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Plan $plan
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Plan $plan)
    {
        return view(\request()->route()->getName(), [
            'show' => $plan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Plan $plan
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Plan $plan)
    {
        $categories = Category::where('parent_id', 0)
            ->where('active', 1)->OrWhere('name', 'محصول')->get();
        return view(\request()->route()->getName(), ['categories' => $categories, 'plan' => $plan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Plan $plan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Plan $plan)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'discount' => 'nullable|integer',
            'score' => 'required|numeric',
            'image' => 'nullable',
            'category_id' => 'nullable',
            'description' => 'required|string',
            'active' => 'required'
        ]);

        if ($request->image) {
            if (file_exists(public_path($plan->image)))
                unlink(public_path($plan->image));

            $data['image'] = $this->uploadImage($request->image, "plans");
        }

        $plan->update($data);

        alert()->success('پلن با موفقیت ویرایش گردید.');

        return redirect()->route('admin.plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Plan $plan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Plan $plan)
    {
        if ($plan->active) {
            $message = "پلن با موفیت غیر فعال شد";
            $plan->active = 0;
        } else {
            $message = "پلن با موفیت فعال شد";
            $plan->active = 1;
        }

        $plan->save();
        alert()->success($message);

        return back();
    }

    public function buy()
    {
        $plans = PlanUser::latest()->paginate(25);

        return view('admin.plans.buys', compact('plans'));
    }
}
