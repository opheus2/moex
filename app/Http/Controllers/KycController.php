<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;


class KycController extends Controller
{
    //

    public function picture($image)
    {
        return Image::make(storage_path() . '/app/kyc/' . $image)->response();
    }
}
