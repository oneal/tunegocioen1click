<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class PrivacyPolicy extends Controller
{
    public function index()
    {
        return view('web.privacy-politic');
    }
}
