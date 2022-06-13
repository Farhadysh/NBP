<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Category;
use App\Image;
use App\PackageList;
use App\Product;
use App\Tag;
use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
	
//			Product::where('id','>',0)->update([
//				'active' => 0
//			]);
//			return "done";
			
        $products = Product::query();

        if ($name = \request('name'))
            $products->where('name', 'LIKE', "%{$name}%");

        if ($code = \request('code'))
            $products->where('code', 'LIKE', "%{$code}%");

        if ($subCat = \request('subCat'))
            $products->whereHas('categories', function ($q) use ($subCat) {
                $q->where('parent_id', $subCat);
            });
        elseif ($category_id = \request('category_id'))
            $products->whereHas('categories', function ($q) use ($category_id) {
                $q->where('category_id', $category_id);
            });

        if ($user_id = \request('user_id'))
            $products->where('user_id', 'LIKE', "%{$user_id}%");

        if ($active = \request('active'))
            $products->where('active', $active);

        $products = $products
            ->orderBy('created_at', 'desc')
            ->orderBy('active', 'asc')
            ->with('categories')->paginate(10);

        return view(\request()->route()->getName())->with([
            'products' => $products,
            'subCat' => Category::where('parent_id', 0)->get(),
            'users' => User::where('level', 'seller')->get()
        ]);
    }

    public function search(Request $request)
    {
        $products = new Product();

        if ($request->name) $products = $products->where('name', 'LIKE', '%' . $request->name . '%');
        if ($request->code) $products = $products->where('id', $request->code);

        $products = $products->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.products.index')->with([
            'products' => $products
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
        $categories = $categories->where('active', 1)->where('parent_id', 0)->get();

        $tags = Tag::all();

        return view(\request()->route()->getName())->with([
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function ajaxCategories($id)
    {
        $categories = new Category();
        $categories = $categories->where('parent_id', $id)->get();

        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'discount' => 'required|integer|lte:price',
            'production_price' => 'nullable|integer',
            'company_price' => 'required|integer',
            'commission' => 'required|integer',
            'description' => 'nullable|string',
            'parent_id' => 'required',
            'limit_count' => 'required|numeric',
            'limit_weight' => 'required|numeric',
            'brand' => 'required|string',
            'prop.*' => 'nullable|string',
            'title.*' => 'nullable|string',
            'image.*' => 'nullable|mimes:jpg,jpeg,png',
            'sendDay' => 'required'
        ]);

        DB::beginTransaction();

        try {
            $product = new Product();
            $product->user_id = auth()->user()->id;
            $product->name = $request->input('name');
            $product->code = 'nbp-' . rand(1000, 9999);
            $product->price = $request->input('price');
            $product->commission = $request->input('commission');
            $product->discount = $request->input('discount');
            $product->company_price = $request->input('company_price');
            $product->production_price = $request->input('production_price');
            $product->limit_weight = $request->input('limit_weight');
            $product->limit_count = $request->input('limit_count');
//        $product->unit = $request->input('unit');
            $product->brand = $request->input('brand');
            $product->telegram = $request->input('telegram');
            $product->instagram = $request->input('instagram');
            $product->description = $request->input('description');
            $product->sendDay = $request->input('sendDay');
            $product->active = 0;
            $product->save();

            $product->tags()->sync($request->tag_id);

            foreach ($request->title as $index => $title) {
                if ($title != '' && $request->prop[$index] != '')
                    $product->properties()->create([
                        'title' => $title,
                        'prop' => $request->prop[$index]
                    ]);
            }

            $category_id = $request->category_id ? $request->category_id : $request->parent_id;

            $product->categories()->sync($category_id);

            if ($request->image)
                foreach ($request->file('image') as $index => $image) {

                    $images = $this->uploadImage($image, 'products');

                    $product->images()->create([
                        'image' => $images,
                        'thumb' => $request->thumb == $index ? 1 : 0
                    ]);
                }
            DB::commit();

            alert()->success('با موفقیت ثبت شد.');

            return redirect(route('admin.products.index'));

        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    }

    public function show($productSlug)
    {
        $cart_count = new Cart();
        $cart_count = $cart_count->count();

        $all_product = new Product();
        $product = $all_product->where('slug', $productSlug)->with('categories')->first();

        $similar_products = $all_product->where('active', 1)->whereHas('categories', function ($q) use ($product) {
            $q->where('id', $product->categories()->first()->id);
        })->get();

        $product->increment('viewCount');

        return view('marketing.single')->with([
            'product' => $product,
            'cart_count' => $cart_count,
            'similar_products' => $similar_products,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $categories = new Category();
        $categories = $categories->where('active', 1)->where('parent_id', 0)->get();

        $children = [];

        $parent_id = 0;

        if ($product->categories()->first()->parent_id == 0) {
            $children = $product->categories()->first()->children;

            $parent_id = $product->categories()->first()->id;
        } else {
            $children = $product->categories()->first()->parent->children;

            $parent_id = $product->categories()->first()->parent_id;
        }

        $product = $product->load('categories', 'images', 'properties');

        $tags = Tag::all();

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'parent_id' => $parent_id,
            'children' => $children,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'discount' => 'required|integer|lte:price',
            'production_price' => 'nullable|integer',
            'company_price' => 'required|integer',
            'description' => 'nullable|string',
            'brand' => 'required|string',
            'parent_id' => 'required',
            'limit_count' => 'required|numeric',
            'limit_weight' => 'required|numeric',
            'prop.*' => 'nullable|string',
            'title.*' => 'nullable|string',
            'image.*' => 'nullable|mimes:jpg,jpeg,png',
            'sendDay' => 'required',
            'commission' => 'required|integer',
        ]);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->commission = $request->input('commission');
        $product->discount = $request->input('discount');
        $product->company_price = $request->input('company_price');
        $product->production_price = $request->input('production_price');
        $product->limit_weight = $request->input('limit_weight');
        $product->limit_count = $request->input('limit_count');
//        $product->unit = $request->input('unit');
        $product->brand = $request->input('brand');
        $product->telegram = $request->input('telegram');
        $product->instagram = $request->input('instagram');
        $product->description = $request->input('description');
        $product->sendDay = $request->input('sendDay');
        $product->active = 0;
        $product->save();

        $product->tags()->sync($request->tag_id);

        $product->properties()->delete();

        if ($request->title)
            foreach ($request->title as $index => $title) {
                if ($title != '' && $request->prop[$index] != '')
                    $product->properties()->create([
                        'title' => $title,
                        'prop' => $request->prop[$index]
                    ]);
            }

        $category_id = $request->category_id ? $request->category_id : $request->parent_id;

        $product->categories()->sync($category_id);

        $product->images()->update([
            'thumb' => 0
        ]);

        if ($request->thumb) {
            $product->images()->where('id', $request->thumb)->update([
                'thumb' => 1
            ]);
        }


        if ($request->hasFile('image'))
            foreach ($request->file('image') as $index => $image) {

                $images = $this->uploadImage($image, 'products');

                $product->images()->create([
                    'image' => $images,
                    'thumb' => $request->thumb == $index ? 1 : 0
                ]);
            }

        alert()->success('با موفقیت ویرایش شد.');

        return redirect(route('admin.products.index'));
    }

    public function destroy_image($id)
    {
        $image = new Image();
        $image = $image->where('id', $id)->first();
        if (file_exists($image['image']))
            unlink($image['image']);

        $image->delete();
        alert()->success('با موفقیت حذف شد');
        return redirect()->back();
    }

    public function active($id)
    {
        $product = new Product();
        $product = $product->where('id', $id)->first();
        Product::where('id', $id)->update([
            'active' => !$product->getOriginal('active')
        ]);

        alert()->success('با موفقیت تغییر وضعیت داده شد');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (Exception $e) {
        }

        alert()->success('با موفقیت حذف شد');
        return redirect()->back();
    }

    public function approved(Product $product)
    {
        $product->approved = 1;
        $product->active = 1;
        $product->cause = null;
        $product->save();

        alert()->success('محصول با موفقیت تایید گردید.');

        return redirect()->back();
    }

    public function unapproved(Product $product)
    {
        return view(\request()->route()->getName(), [
            'product' => $product
        ]);
    }

    public function unapprovedStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'cause' => 'required',
        ]);

        Product::where('id', $request->product_id)->update([
            'approved' => 0,
            'cause' => $request->cause,
        ]);

        alert()->success('پیام با موفقیت ذخیره گردید.');

        return redirect()->route('admin.products.index');
    }

    public function special(Product $product)
    {
        if ($product->special) {
            $product->special = 0;
            $message = "محصول با موفقیت از ویژه حذف گردید.";
        } else {
            $product->special = 1;
            $message = "محصول با موفقیت به ویژه اضافه گردید.";
        }

        $product->save();


        alert()->success($message);

        return back();
    }
}
