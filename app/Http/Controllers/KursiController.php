<?php

namespace App\Http\Controllers;

use App\Models\Kursi;
use App\Models\Studio;
use Illuminate\Http\Request;

class KursiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kursi = Kursi::all();


        // dd($kursi, $studio); // Cek data yang dikirim ke view
        return view("chairs.kursi", compact("kursi"));
    }


    // public function getKursiByStudio($id)
    // {
    //     $kursi = Kursi::where('id_studio', $id)->pluck('kursi');
    //     return response()->json(['kursi' => $kursi]);
    // }


    // app/Http/Controllers/KursiController.php




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("chairs.kursiCreate");
    }

    /**
     * Store a newly created resource in storage.
     */
   
    public function store(Request $request)
    {
        $vakidateData = $request->validate([
            "kursi" => "required",
        ]);

        Kursi::create($vakidateData);
        return redirect()->route("kursi.index")->with("success", "Berhasil Tambah Data");
    }

    public function show(kursi $kursi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $kursi = Kursi::find($id);

        return view("chairs.kursiEdit", compact("kursi"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $kursi = Kursi::find($id);

        $vakidateData = $request->validate([
            "kursi"=> "required",

        ]);

        $kursi->update($vakidateData);
        return redirect()->route("kursi.index")->with("success", "Berhasil Edit Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kursi = Kursi::find($id);

        // Periksa apakah kursi terkait dengan order
        if ($kursi->order()->count() > 0) {
            return redirect()->route("kursi.index")->with("gagal", "Gagal Menghapus Karena Masih Berkaitan Dengan Order");
        }

        // Hapus kursi
        $kursi->delete();

        return redirect()->route("kursi.index")->with("success", "Berhasil Menghapus");
    }
}
