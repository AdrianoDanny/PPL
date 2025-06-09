<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function dashboard()
    {
        return view('pemasok.dashboard');
    }
}
