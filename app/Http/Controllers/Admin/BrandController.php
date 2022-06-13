<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $brands = Brand::query();

        if ($name = \request('name'))
            $brands->where('name', "%{$name}%");

        $brands = $brands->latest()->paginate(20);

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image'
        ]);

        $image = $this->uploadImage($request->image, "brands");

        Brand::create([
            'name' => $request->name,
            'image' => $image
        ]);

        alert()->success('رند با موفقیت ذخیره گردید.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Brand $brand
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg'
        ]);

        $image = $brand->image;
        if ($request->image) {
            if (file_exists(public_path($brand->image)))
                unlink(public_path($brand->image));
            $image = $this->uploadImage($request->image, "brands");
        }

        $brand->update([
            'name' => $request->name,
            'image' => $image
        ]);

        alert()->success('رند با موفقیت ذخیره گردید.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
        } catch (\Exception $e) {
        }

        alert()->success('برند با موفقیت حذف گردید.');
        return back();
    }
}
