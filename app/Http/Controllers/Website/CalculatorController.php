<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('website.calculator');
    }
}
