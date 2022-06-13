<?php

namespace App\Http\Controllers\Admin;

use App\Library;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LibraryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libraries = new Library();
        $libraries = $libraries->orderBy('id', 'desc')->paginate(10);

        return view('admin.libraries.index')->with([
            'libraries' => $libraries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(\request()->route()->getName());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'writer' => 'required',
            'book_url' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $image = $this->uploadImage($request->file('image'), 'book');

        $library = new Library();
        $library->name = $request->name;
        $library->title = $request->title;
        $library->writer = $request->writer;
        $library->date = $request->date;
        $library->country = $request->country;
        $library->publisher = $request->publisher;
        $library->book_url = $request->book_url;
        $library->voice_url = $request->voice_url;
        $library->image = $image;
        $library->save();

        alert()->success('با موفقیت ثبت شد');

        return redirect()->route('admin.libraries.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Library $library
     * @return \Illuminate\Http\Response
     */
    public function show(Library $library)
    {
        return view('homePages.libraries.single')->with([
            'library' => $library
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Library $library
     * @return \Illuminate\Http\Response
     */
    public function edit(Library $library)
    {
        return view(\request()->route()->getName())->with([
            'library' => $library
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Library $library
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Library $library)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'writer' => 'required',
            'book_url' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        if ($request->hasFile('image')) {
            if (file_exists(public_path($library->image)))
                unlink(public_path($library->image));
            $image = $this->uploadImage($request->file('image'), 'book');
        }


        $library->name = $request->name;
        $library->title = $request->title;
        $library->writer = $request->writer;
        $library->date = $request->date;
        $library->country = $request->country;
        $library->publisher = $request->publisher;
        $library->book_url = $request->book_url;
        $library->voice_url = $request->voice_url;
        $library->image = $image;
        $library->save();

        alert()->success('با موفقیت ویرایش شد');

        return redirect()->route('admin.libraries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Library $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        try {
            $library->delete();
        } catch (\Exception $e) {
        }

        alert()->success('با موفقیت ثبت شد');

        return redirect()->back();
    }
}
