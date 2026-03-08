<?php
namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
class BlogController extends Controller
{
    public function index() { return view('website.blog'); }
    public function show(string $slug) { return view('website.blog-details', compact('slug')); }
}
