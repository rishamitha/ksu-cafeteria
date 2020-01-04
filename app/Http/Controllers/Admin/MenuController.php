<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::where('stall_id', Auth::id())->paginate(5);

        return view('admin.menu.index')->with(compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $menu = new Menu($request->only(['name', 'description', 'price']));
        $menu->stall_id = Auth::id();

        if($request->hasFile('image')) {
            $ext  = $request->file('image')->getClientOriginalExtension();
            $name = Str::random(10) . '.' . $ext;

            $image = Image::make($request->file('image'));
            $image->fit(300, 300);
            $image->save(public_path(Menu::IMAGE_FOLDER) . $name);

            $menu->image = $name;
        }

        if ($request->has('recommended')) {
            $menu->is_recommended = true;
        }
        
        $menu->save();

        return redirect()->back()->with('success', 'Menu Saved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu.form')->with(compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Menu $menu, MenuRequest $request)
    {
        $menu->fill($request->only(['name', 'description', 'price']));

        if($request->hasFile('image')) {

            if ($menu->image) {
                unlink(public_path(Menu::IMAGE_FOLDER) . $menu->image);
            }

            $ext  = $request->file('image')->getClientOriginalExtension();
            $name = Str::random(10) . '.' . $ext;

            $image = Image::make($request->file('image'));
            $image->fit(300, 300);
            $image->save(public_path(Menu::IMAGE_FOLDER) . $name);

            $menu->image = $name;

        }

        $menu->is_recommended = false;

        if ($request->has('recommended')) {
            $menu->is_recommended = true;
        }
        
        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            unlink(public_path(Menu::IMAGE_FOLDER) . $menu->image);
        }

        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu Deleted');
    }
}
