<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = new Package();
        $packages = $packages->paginate(10);

        return view(\request()->route()->getName())->with([
            'packages' => $packages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = new Category();
        $categories = $categories->where('active', 1)->get();

        return view(\request()->route()->getName())->with([
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'price' => 'required',
            'points' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $image = $this->uploadImage($request->file('image'), 'category');

        $packages = new Package();
        $packages->name = $request->input('name');
        $packages->image = $image;
        $packages->category_id = $request->input('category_id');
        $packages->price = $request->input('price');
        $packages->points = $request->input('points');
        $packages->save();

        alert()->success('با موفقیت ثبت شد.');

        return redirect(route('admin.packages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $categories = new Category();
        $categories = $categories->where('active', 1)->get();

        return view(\request()->route()->getName())->with([
            'package' => $package,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'price' => 'required',
            'points' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $image = $package->image;

        if ($request->hasFile('image')) {
            if (file_exists(public_path($package->image)))
                unlink(public_path($package->image));
            $image = $this->uploadImage($request->file('image'), 'category');
        }

        $package->name = $request->input('name');
//        $package->category_id = $request->input('category_id');
        $package->price = $request->input('price');
        $package->points = $request->input('points');
        $package->image = $image;
        $package->active = $request->active;
        $package->save();

        alert()->success('با موفقیت ویرایش شد');

        return redirect(route('admin.packages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}
