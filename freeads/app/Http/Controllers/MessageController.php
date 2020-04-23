<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MessageController extends Controller
{
    public function create()
    {
        return view('message');
    }
    public function home()
    {
        $buyer = DB::table('users')->where('name', $_GET['idSender']);
        return view('messagehome', compact('buyer'));
    }
    public function send(Request $request)
    {

        $validated = $request->validate([
            'content' => ['required', 'string', 'min:4', 'max:1000'],
        ]);

        $user = Auth::user();

        $message = new Message();

        $message->content = $validated['content'];
        $message->seller = $_POST['idSender'];
        $message->buyer = $user->id;
        $message->ad = $_POST['idAd'];

        $message->save();
        return redirect()->route('annonces')->with('status', 'Your message has been send');

        // $ads = DB::table('ads')->where('id', $_POST['id']);
    }
    public function sendhome(Request $request)
    {

        $validated = $request->validate([
            'content' => ['required', 'string', 'min:4', 'max:1000'],
        ]);

        $message = new Message();

        $message->content = $validated['content'];
        $message->seller = $_POST['idBuyer'];
        $message->buyer = $_POST['idSender'];
        $message->ad = $_POST['idAd'];

        $message->save();
        return redirect()->route('annonces')->with('status', 'Your message has been send');
    }
}
