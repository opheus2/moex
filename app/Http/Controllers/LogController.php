<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ManageLogs;

class LogController extends Controller
{
    use ManageLogs;
    function __construct ()
    {
        $this->middleware('auth');
    }

    public function updateFirstTime()
    {
        $this->updateFirstTimeLogin(auth()->user()->id);
    }
}
