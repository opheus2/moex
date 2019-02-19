<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Models\Kyc;



class KycController extends Controller
{
    //

    public function picture($image)
    {
        return Image::make(storage_path() . '/app/kyc/' . $image)->response();
    }

    public function index()
    {
        $kycs     = Kyc::all(); 

        return view('admin.kyc.index')
            ->with(compact('kycs', 'kycs'));
    }

    
}
