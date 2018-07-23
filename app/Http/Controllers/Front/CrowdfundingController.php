<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrowdfundingController extends Controller
{
    public function index()
    {
        \Debugbar::disable();
        return view('front.crowdfunding.index');
    }
}
