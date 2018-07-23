<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShareController extends Controller
{
    public function shareProductDetailOnFacebook()
    {
        return view('front.share.facebook.product_detail');
    }
}
