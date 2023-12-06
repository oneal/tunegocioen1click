<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class Duplicate extends Controller
{
    public function index(Request $request)
    {
        dd("hola00");
        return view('duplicate.add');
    }
}
