<?php

namespace App\Http\Controllers;

use App\Models\HomepageSetting;

class PageController extends Controller
{
    public function home()
    {
        $home = HomepageSetting::current();

        return view('pages.home', compact('home'));
    }
}