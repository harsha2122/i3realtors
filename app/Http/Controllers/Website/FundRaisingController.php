<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\FundRaisingLogo;

class FundRaisingController extends Controller
{
    public function index()
    {
        $logos = FundRaisingLogo::active()->get();
        return view('website.fund-raising', compact('logos'));
    }
}
