<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
    	return view('admin.product.training');
    }
    public function imageZoom()
    {
    	return view('front.test.image.index');
    }
}
