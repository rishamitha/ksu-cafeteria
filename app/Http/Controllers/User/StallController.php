<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stall;

class StallController extends Controller
{
    public function show(Stall $stall)
    {
        $stall->load('menus');
        $stall->load('galleries');

        return view('user.stall.index')->with(compact('stall'));
    }
}
