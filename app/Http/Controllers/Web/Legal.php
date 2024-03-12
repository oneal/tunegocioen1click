<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class Legal extends Controller
{
    public function index()
    {
        return view('web.legal');
    }
}
