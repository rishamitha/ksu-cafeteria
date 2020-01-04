<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StallRequest;
use App\Models\Stall;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class StallController extends Controller
{
    public function update(StallRequest $request, Stall $stall)
    {
        $stall->fill($request->only(['name', 'description']));

        if($request->hasFile('image')) {

            if ($stall->image) {
                unlink(public_path(Stall::IMAGE_FOLDER) . $stall->image);
            }

            $ext  = $request->file('image')->getClientOriginalExtension();
            $name = Str::random(10) . '.' . $ext;

            $image = Image::make($request->file('image'));
            $image->fit(300, 300);
            $image->save(public_path(Stall::IMAGE_FOLDER) . $name);

            $stall->image = $name;
        }

        $stall->save();

        return redirect()->route('admin.home')->with('success', 'Profile Updated');
    }
}
