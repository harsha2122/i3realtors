<?php
namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ContactController extends Controller
{
    public function index() { return view('website.contact'); }
    public function submit(Request $request) {
        $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email'],
            'message' => ['required', 'min:10'],
        ]);
        return back()->with('success', 'Thank you! We will be in touch soon.');
    }
}
