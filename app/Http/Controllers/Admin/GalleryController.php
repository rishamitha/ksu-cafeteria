<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::where('stall_id', Auth::id())->paginate(5);

        return view('admin.gallery.index')->with(compact('galleries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $gallery = new Gallery($request->only(['caption']));
        $gallery->stall_id = Auth::id();

        if ($request->hasFile('image')) {

            $ext  = $request->file('image')->getClientOriginalExtension();
            $name = Str::random(10) . '.' . $ext;

            $image = Image::make($request->file('image'));
            $image->fit(300, 300);
            $image->save(public_path(Gallery::IMAGE_FOLDER) . $name);

            $gallery->image = $name;
        }

        $gallery->save();

        $request->session()->flash('success', 'Gallery Saved');

        return response()->json(['message' => 'Gallery Saved', 'status' => 200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $gallery->fill($request->only(['caption']));
        $gallery->stall_id = Auth::id();

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                unlink(public_path(Gallery::IMAGE_FOLDER) . $gallery->image);
            }

            $ext  = $request->file('image')->getClientOriginalExtension();
            $name = Str::random(10) . '.' . $ext;

            $image = Image::make($request->file('image'));
            $image->fit(300, 300);
            $image->save(public_path(Gallery::IMAGE_FOLDER) . $name);

            $gallery->image = $name;
        }

        $gallery->save();

        $request->session()->flash('success', 'Gallery Updated');

        return response()->json(['message' => 'Gallery Updated', 'status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            unlink(public_path(Gallery::IMAGE_FOLDER) . $gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery Deleted');
    }
}
