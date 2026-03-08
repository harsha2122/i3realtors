<?php
namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
class PropertyController extends Controller
{
    public function index() { return view('website.projects'); }
    public function show(string $slug) { return view('website.project-details', compact('slug')); }
}
