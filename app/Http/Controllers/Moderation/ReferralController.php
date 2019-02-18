<?php

namespace App\Http\Controllers\Moderation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Referral;

class ReferralController extends Controller
{
    public function index ()
    {
        $data ['referrals'] = $referrals = Referral::all()->load('user', 'referrer');
        // dd($referrals);
        return view('moderation.referrals.index', $data);
    }
}