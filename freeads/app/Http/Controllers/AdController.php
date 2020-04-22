<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AdController extends Controller
{

    public function index()
    {
        $ads = DB::table('ads')->orderBy('created_at', 'DESC')->paginate(5);
        return view('annonces', compact('ads'))->with('user', Auth::user());
    }

    public function create()
    {
        return view('createannonces')->with('user', Auth::user());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:2', 'max:255'],
            'content' => ['required', 'string', 'min:2'],
            'localisation' => ['required'],
            'picture' => ['required', 'max:2048'],
            'price' => ['required', 'integer'],
            'category' => ['required', 'string', 'min:2', 'max:255']
        ]);

        $ad = new Ad();
        $user = Auth::user();
        $ad->users = $user->id;

        $pictureName = $request->picture->getClientOriginalName();
        $request->picture->move(public_path('images'), $pictureName);
        $ad->picture = $pictureName;

        $ad->title = $validated['title'];
        $ad->content = $validated['content'];
        $ad->price = $validated['price'];
        $ad->localisation = $validated['localisation'];
        $ad->category = $validated['category'];

        $ad->save();

        // $ad->session()->flash('status', 'Your ad has been posted');
        return redirect()->route('annonces')->with('status', 'Your ad has been posted');
    }

    public function show()
    {
        $user = Auth::user();
        $id = $user->id;
        $ads = DB::table('ads')->where('users', $id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('yourannonces', compact('ads'))->with('user', Auth::user());
    }




    public function search(Request $request)
    {

        if ($request->ajax()) {
            $price = explode('-', $request->price);
            $created_at = $request->price;

            if (isset($request->created_at) && !empty($request->created_at)) {
                if (isset($request->category) && !empty($request->category) && isset($request->price) && !empty($request->price)) {
                    $data = DB::table('ads')->where('title', 'LIKE', $request->country . '%')->where('category', 'LIKE', '%' . $request->category . '%')->where('price', '>=', $price[0])->where('price', '<=', $price[1])->orderBy('created_at', 'DESC')->get();
                } elseif (isset($request->category) && !empty($request->category)) {
                    $data = DB::table('ads')->where('title', 'LIKE', $request->country . '%')->where('category', 'LIKE', '%' . $request->category . '%')->orderBy('created_at', 'DESC')->get();
                } elseif (isset($request->price) &&  !empty($request->price)) {
                    $data = DB::table('ads')->where('title', 'LIKE', $request->country . '%')->where('price', '>=', $price[0])->where('price', '<=', $price[1])->orderBy('created_at', 'DESC')->get();
                } else {
                    $data = DB::table('ads')->where('title', 'LIKE', $request->country . '%')->orderBy('created_at', 'DESC')->get();
                }
            } else {
                if (isset($request->category) && !empty($request->category) && isset($request->price) && !empty($request->price)) {
                    $data = DB::table('ads')->where('title', 'LIKE', $request->country . '%')->where('category', 'LIKE', '%' . $request->category . '%')->where('price', '>=', $price[0])->where('price', '<=', $price[1])->get();
                } elseif (isset($request->category) && !empty($request->category)) {
                    $data = DB::table('ads')->where('title', 'LIKE', $request->country . '%')->where('category', 'LIKE', '%' . $request->category . '%')->get();
                } elseif (isset($request->price) &&  !empty($request->price)) {
                    $data = DB::table('ads')->where('title', 'LIKE', $request->country . '%')->where('price', '>=', $price[0])->where('price', '<=', $price[1])->get();
                } else {
                    $data = DB::table('ads')->where('title', 'LIKE', $request->country . '%')->get();
                }
            }
            $output = '';

            if (count($data) > 0) {

                $output = '<div class="results" id="resultsa">';

                foreach ($data as $row) {
                    $picture = '/images/' . $row->picture;
                    $output .=  '<div class="row justify-content-center m-4 dataSearch">
                    <div class="card p-4" style="width: 18rem;">
                        <img class="card-img-top" src="' . $picture  . '" alt="Card image cap">
    
                        <div class="card-body">
                            <div class="col-sm-12 m-1">
                                <h5 class="card-title">' .   $row->title  . '</h5>
                            </div>
                            <div class="col-sm-12 m-1">
                                <p class="card-text"> ' . $row->content . ' </p>
                            </div>
                            <div class="col-sm-12 m-1">
                                <p class="card-text text-info">In ' . $row->localisation . ' </p>
                            </div>
                            <div class="col-sm-12 m-1">
                                <p class="card-text"> ' . $row->price . ' $ </p>
                            </div>
                            <div class="col-sm-12 m-1">
                            <p class="card-text">Category ' . $row->category . ' </p>
                        </div>
                            <form action="" method="get">
                                <button type="submit" class="btn btn-primary">Show ad</button>
                            </form>
                            <small><br>created at ' . Carbon::parse($row->created_at)->diffForHumans() . '</small>
                        </div>
                    </div>
                </div>';
                }

                $output .= '</div>';
            } else {

                $output .= '<div class="alert alert-danger">' . 'No results' . '</div>';
            }

            return $output;
            // return response()->json(['success' => true, 'output' => $output]);
        }
    }


    // public function search(Request $request)
    // {
    //     $contentAd = $request->contentAd;
    //     $ads = DB::table('ads')->where('title', 'like', "%$contentAd%")->orWhere('content', 'like', "%$contentAd%")->orderBy('created_at', 'DESC')->get();
    //     return response()->json(['success' => true, 'ads' => $ads]);
    // }





    public function edit()
    {
        $ads = DB::table('ads')->where('id', $_GET['id']);
        return view('editannonces', compact('ads'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:2', 'max:255'],
            'content' => ['required', 'string', 'min:2'],
            'localisation' => ['required'],
            'picture' => ['required', 'max:2048'],
            'price' => ['required', 'integer'],
            'category' => ['required', 'string', 'min:2', 'max:255']
        ]);

        $ad = new Ad();
        $user = Auth::user();
        $ad->users = $user->id;

        $pictureName = $request->picture->getClientOriginalName();
        $request->picture->move(public_path('images'), $pictureName);
        $ad->picture = $pictureName;

        $ad->title = $validated['title'];
        $ad->content = $validated['content'];
        $ad->price = $validated['price'];
        $ad->localisation = $validated['localisation'];
        $ad->category = $validated['category'];

        Ad::where('id', $_POST['id'])->update(array(
            'users' =>  $ad->users, 'title' => $ad->title,
            'picture' =>  $ad->picture, 'content' =>  $ad->content, 'price' =>  $ad->price,
            'localisation' =>  $ad->localisation, 'category' =>  $ad->category,
        ));

        return redirect()->route('yourannonces')->with('status', 'Your ad has been updated');
    }

    public function destroy()
    {
        $delete = Ad::where('id', $_GET['id'])->delete();
        return redirect()->route('home')->with('status', 'Ad has been deleted');
    }

    public function showcontact()
    {
    }
}
