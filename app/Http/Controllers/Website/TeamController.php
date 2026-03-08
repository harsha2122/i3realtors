<?php
namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
class TeamController extends Controller
{
    public function index() { return view('website.team'); }
}
