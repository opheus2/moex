<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ReferralController extends Controller
{
    public function index($username)
    {
        $user = User::where('name', $username)->first();
        if (!is_null($user)) {
            session(['referrer_id' => $user->id]);
        }

        return redirect('/register');
    }
}
