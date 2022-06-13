<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\PackageList;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
        $products = new Product();

        $products = $products->where('approved', 1)
            ->where('limit_count', '>', 0)->where('active', 1)->latest();
//        where('sell_count', '>', 5);

        $new_products = $products->take(15)->get();

        $mostViewProducts = $products->orderBy('viewCount', 'DESC')->take(15)->get();

        $bestSellers = $products->orderBy('buyCount', 'DESC')->take(15)->get();

        $specialProduct = $products->where('special', 1)->take(15)->get();

        $bestSellersUser = User::where('best', 1)->where('level', 'seller')->take(10)->get();

        $amazingProducts = $products->orderBy('buyCount', 'DESC')->whereNotIn('id', $bestSellers->pluck('id')->toArray())->take(15)->get();

        return view('marketing.index')->with([
            'new_products' => $new_products,
            'bestSellers' => $bestSellers,
            'mostViewProducts' => $mostViewProducts,
            'specialProduct' => $specialProduct,
            'bestSellersUser' => $bestSellersUser,
            'amazingProducts' => $amazingProducts,
        ]);
    }

    public function search(Request $request)
    {
        $products = new Product();
        $products = $products->where('active', 1);

        if ($search = $request->search) {
            $products = $products->where('name', 'LIKE', "%{$search}%")->orWhere('brand', 'LIKE', "%{$search}%");
        }

        $products = $products->where('limit_count', '>', 0)->where('active', 1)->paginate(20);

        return view('marketing.products')->with([
            'products' => $products,
        ]);
    }

    public function categories()
    {
        $categories = new Category();
        $categories = $categories->where('parent_id', 0)->where('active', 1)->get();

//        ->whereHas('products', function ($q) {
//        $q->where('limit_count', '>', 0)->where('active', 1);
//    })

        return view('marketing.categories')->with([
            'categories' => $categories
        ]);
    }

    public function subCategories($categorySlug)
    {
        $categories = new Category();
        $category = $categories->where('slug', $categorySlug)->first();

        $subCategories = $categories->where('parent_id',
            $category->id)->with(['products' => function ($q) {
            $q->where('active', 1);
        }, 'products.categories', 'products.images'
        ])->whereHas('products', function ($q) {
            $q->where('active', 1)->where('approved', 1);
        })->get();

        return view('marketing.subCategories')->with([
            'subCategories' => $subCategories,
        ]);
    }

    public function allProducts($slug)
    {
        $category = new Category();
        $category = $category->where('slug', $slug)->first();
        $array = $category->children->pluck('id')->toArray();

        $array[] = $category->id;

        $products = new Product();
        $products = $products->where('approved', 1)
            ->where('limit_count', '>', 0)->where('active', 1)->whereHas('categories', function ($q) use ($array) {
                $q->whereIn('id', $array);
            })->latest()->paginate(20);

        return view('marketing.products')->with([
            'products' => $products,
        ]);
    }
}
