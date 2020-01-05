<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Stall;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stalls = Stall::paginate(6);

        return view('user.home.index')->with(compact('stalls'));
    }
}
