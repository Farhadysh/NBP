<?php

namespace App\Http\Controllers\Home;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function ajaxCategories($id)
    {
        $categories = new Category();
        $categories = $categories->where('parent_id', $id)->get();

        return $categories;
    }
}
