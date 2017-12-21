<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestNotif;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function notif(){
        $notif = TestNotif::where('read','=',0);
        $data = $notif->get();

        // $notif->update(['read'=>1]);

        return response()->json($data);

    }
}
