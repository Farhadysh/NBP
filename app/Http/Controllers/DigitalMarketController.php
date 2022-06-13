<?php

namespace App\Http\Controllers;

use App\Library;
use Illuminate\Http\Request;

class DigitalMarketController extends Controller
{
    public function library()
    {
        $libraries = new Library();
        $libraries = $libraries->where('status', 1)->paginate(12);


        return view('digital-marketing.libraries.index')->with([
            'libraries' => $libraries,
            'title' => 'کتابخانه مجازی'
        ]);
    }

    public function showBook($id)
    {
        $library = new Library();
        $library = $library->where('id', $id)->first();

        return view('digital-marketing.libraries.single')->with([
            'library' => $library,
            'title' => 'کتابخانه مجازی'
        ]);
    }
}
