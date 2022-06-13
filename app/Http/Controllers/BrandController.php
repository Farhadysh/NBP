<?php

namespace App\Http\Controllers;

use App\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('brands',compact('brands'));
    }
}