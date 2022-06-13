<?php

namespace App\Http\Controllers\Panel;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'ticket_id' => 'required',
            'file' => 'nullable|mimes:jpg,gif,jpeg,png,txt,pdf,zip,rar'
        ]);

        $file = null;

        if ($request->hasFile('file'))
            $file = $this->uploadFile($request->file);

        auth()->user()->replies()->create([
            'message' => $request->message,
            'ticket_id' => $request->ticket_id,
            'file' => $file,
            'sellerView' => 1
        ]);

        alert()->success('اطلاعات با موفقیت ذخیره شد.');

        return redirect()->back();
    }

    public function uploadFile($file)
    {
        $year = Carbon::now()->year;
        $imagePath = "/upload/files/{$year}/";

        $filename = $file->getClientOriginalName();

        if (file_exists(public_path($imagePath) . $filename)) {
            $filename = now() . $filename;
        }

        $file->move(public_path($imagePath), $filename);
        return $imagePath . $filename;
    }
}
