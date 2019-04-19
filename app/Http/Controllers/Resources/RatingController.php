<?php

namespace App\Http\Controllers\Resources;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class RatingController extends Controller
{
    public function getAvgRating ($id) {
        $user = User::find($id);
        if ($user) {
            return $user->averageRating();
        }
    }

}
