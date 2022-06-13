<?php

namespace App\Http\Controllers\Home;

use App\Province;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{

    public function getCities(Province $province)
    {
        return $province->cities;
    }
}
