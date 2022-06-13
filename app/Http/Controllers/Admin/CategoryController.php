<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::query();
        if ($name = \request('name'))
            $categories->where('name', 'LIKE', "%{$name}%");

        if ($parent_id = \request('parent_id'))
            $categories->where('parent_id', $parent_id);

        $categories = $categories->latest()->paginate(5);

        $subCat = Category::where('parent_id', 0)->get();

        return view('admin.categories.index', [
            'categories' => $categories,
            'subCat' => $subCat,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = new Category();
        $categories = $categories->where('parent_id', 0)->get();
        return view('admin.categories.create')->with([
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $image = $this->uploadImage($request->file('image'), 'categories');

        $categories = new Category();
        $categories->name = $request->input('name');
        $categories->image = $image;
        $categories->parent_id = $request->input('parent_id');
        $categories->save();

        alert()->success('با موفقیت ثبت شد.');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $categories = new Category();
        $categories = $categories->where('parent_id', 0)->get();

        return view('admin.categories.edit', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $image = $category->image;

        if ($request->hasFile('image')) {
            if (file_exists(public_path($category->image)))
                unlink(public_path($category->image));

            $image = $this->uploadImage($request->file('image'), 'categories');
        }

        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->image = $image;
        $category->save();

        alert()->success('با موفقیت ویرایش شد');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->active = !$category->getOriginal('active');
        $category->save();

        alert()->success('با موفقیت تغییر وضعیت پیدا کرد.');

        return redirect()->back();
    }
}
