<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;
class Notfoundcontroller extends Controller
{
    //
    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            // Pastikan model Detail sudah sesuai dengan tabel `detail`
            $films = Detail::where('judul', 'like', "%{$query}%")->get();
            // Debug: Print the films data
            // dd($films);
        } else {
            $films = collect();
            return view('errors.notfound');
        }

        return view('search.results', compact('films', 'query'));
    }
}
