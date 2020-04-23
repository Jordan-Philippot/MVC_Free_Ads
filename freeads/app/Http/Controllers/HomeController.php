<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $messages = DB::table('messages')->where('seller', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('home', compact('messages'));
    }
}
