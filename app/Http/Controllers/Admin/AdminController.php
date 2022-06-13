<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function uploadImage($file, $model)
    {
        return $file ? $this->upload($file, $model) : null;
    }

    public function upload($file, $model)
    {
        $fileName = time() . rand(1, 5000) . $file->getClientOriginalName();

        $file->move(public_path('/upload/' . $model), $fileName);

        return "/upload/" . $model . "/" . $fileName;
    }
}
