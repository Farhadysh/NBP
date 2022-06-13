<?php

namespace App\Http\Controllers\Panel;

use App\Cart;
use App\Category;
use App\Image;
use App\PackageList;
use App\Product;
use App\Tag;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends PanelController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = new Product();
        $products = $products->where('user_id', auth()->user()->id);
        $products = $products->orderBy('id', 'desc')->with('categories')->paginate(10);

        $categories = Category::where('parent_id', 0)->get();

        return view(\request()->route()->getName())->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function unconfirmed(Request $request)
    {
        $products = new Product();

        $products = $products->where('approved', 0);

        $products = $products->where('user_id', auth()->user()->id);

        if ($request->name) $products = $products->where('name', 'LIKE', '%' . $request->name . '%');
        if ($request->code) $products = $products->where('id', $request->code);

        $products = $products->orderBy('id', 'desc')->paginate(10);


        return view(\request()->route()->getName())->with([
            'products' => $products,
        ]);
    }

    public function search(Request $request)
    {
        $products = new Product();

        $products = $products->where('user_id', auth()->user()->id);

        if ($request->name) $products = $products->where('name', 'LIKE', '%' . $request->name . '%');
        if ($request->code) $products = $products->where('id', $request->code);

        if ($request->subCat)
            $products = $products->whereHas('categories', function ($q) use ($request) {
                return $q->where('parent_id', $request->subCat);
            });
        elseif ($request->category_id)
            $products = $products->whereHas('categories', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });

        if ($request->brand)
            $products = $products->where('brand', 'LIKE', "%{$request->brand}%");

        if ($request->active)
            $products = $products->where('active', $request->active);

        $products = $products->orderBy('id', 'desc')->paginate(10);

        $categories = Category::where('parent_id', 0)->get();


        return view('panel.products.index')->with([
            'products' => $products,
            'categories' => $categories,
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
            'description' => 'nullable|string',
            'parent_id' => 'required',
            'limit_count' => 'nullable|numeric',
            'limit_weight' => 'nullable|numeric',
            'brand' => 'required|string',
            'commission' => 'required|integer',
            'prop.*' => 'nullable|string',
            'title.*' => 'nullable|string',
            'image.*' => 'nullable|mimes:jpeg,png,jpg',
            'sendDay' => 'required'
        ]);

        DB::beginTransaction();

        try {
            $product = new Product();
            $product->user_id = auth()->user()->id;
            $product->name = $request->input('name');
            $product->code = $this->generateCode();
            $product->price = $request->input('price');
            $product->commission = $request->input('commission');
            $product->discount = $request->input('discount');
            $product->company_price = $request->input('company_price');
            $product->production_price = $request->input('production_price');
            $product->limit_weight = $request->input('limit_weight') ?? 0;
            $product->limit_count = $request->input('limit_count') ?? 0;
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

            return redirect(route('panel.products.index'));

        } catch (\Exception $e) {
            DB::rollback();
            alert()->error('محصول ثبت نشد دوباره امتحان کنید.');

            return redirect(route('panel.products.index'));
        }
    }

    public function show($productSlug)
    {
        $user_categories = [];
        if (auth()->check()) {
            $plans = auth()->user()->planUsers()->where('expire_at', '>', now())->pluck('id')->toArray();

            $user = auth()->user();
            if ($user->level == 'visitor') {
                $user_categories = PackageList::whereHas('planUser', function ($q) use ($plans) {
                    $q->whereIn('id', $plans);
                })->with('package')->get()->where('package.category_id', '!=', null)->pluck('package.category_id')->toArray();
            }
        }

        $cart_count = new Cart();
        $cart_count = $cart_count->count();

        $all_product = new Product();
        $product = $all_product->where('slug', $productSlug)->with('categories')->first();

        $similar_products = $all_product->where('active', 1)->whereHas('categories', function ($q) use ($product) {
            $q->where('id', $product->categories()->first()->id);
        })->get();

        return view('marketing.single')->with([
            'product' => $product,
            'cart_count' => $cart_count,
            'similar_products' => $similar_products,
            'user_categories' => $user_categories
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

        return view('panel.products.edit', [
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
            'commission' => 'required|integer',
            'parent_id' => 'required',
            'limit_count' => 'nullable|numeric',
            'limit_weight' => 'nullable|numeric',
            'prop.*' => 'nullable|string',
            'title.*' => 'nullable|string',
            'image.*' => 'nullable|mimes:jpeg,png,jpg',
            'sendDay' => 'required',
        ]);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->discount = $request->input('discount');
        $product->company_price = $request->input('company_price');
        $product->commission = $request->input('commission');
        $product->production_price = $request->input('production_price');
        $product->limit_weight = $request->input('limit_weight') ?? 0;
        $product->limit_count = $request->input('limit_count') ?? 0;
//        $product->unit = $request->input('unit');
        $product->brand = $request->input('brand');
        $product->telegram = $request->input('telegram');
        $product->instagram = $request->input('instagram');
        $product->description = $request->input('description');
        $product->sendDay = $request->input('sendDay');
        $product->active = 0;
        $product->approved = 0;
        $product->cause = null;
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

        return redirect(route('panel.products.index'));
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

    public function generateCode()
    {
        $code = rand(11111, 99999);

        if (Product::where('code', $code)->exists())
            return $this->generateCode();

        return $code;
    }
}
