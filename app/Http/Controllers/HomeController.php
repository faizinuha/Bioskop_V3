<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\Berita;
use App\Models\Detail;
use App\Models\Studio;
use App\Models\tanggal;
use Illuminate\Http\Request;

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

    //  me

    public function index()
    {

        $detail = Detail::latest()->filter(request(['search']))->with('time')->paginate(10)->withQueryString();
        $berita = Berita::paginate(3);
        $time = Time::all();
        $tanggal = tanggal::all();
        $studio = Studio::all();

        return view('home', compact('detail', 'berita', 'time','tanggal','studio'));
        // return redirect()->route('home', compact('detail', 'berita'))->with('berhasil','Welcome');
    }
}
