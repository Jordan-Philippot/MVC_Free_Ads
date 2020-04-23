<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $messages = DB::table('messages')->where('seller', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5);
        // $messages = Message::where('seller', '=', Auth::user()->id)->get()->orderBy('created_at', 'DESC')->paginate(5);
        return view('home', compact('messages'));
    }
}
