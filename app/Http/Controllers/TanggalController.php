<?php

namespace App\Http\Controllers;

use App\Http\Requests\TanggalRequest;
use App\Models\tanggal;
use Illuminate\Http\Request;

class TanggalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanggal = Tanggal::all();
        return view("dates.tanggal", compact("tanggal"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dates.tanggalCreate");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TanggalRequest $request)
    {
        // $overlap = Tanggal::where(function ($query) use ($request) {
        //     $query->where('tanggal_mulai', '<', $request->tanggal_selesai)
        //          ->where('tanggal_selesai', '>', $request->tanggal_mulai);
        // })->exists();

        // if($overlap){
        //     return back()->with('eror', 'Tanggal Tayang Yang Anda Masukkan Sudah Terisi');
        // }

        tanggal::create($request->validated());
        return redirect()->route("tanggal.index")->with('success', 'Berhasil Tambah Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(tanggal $tanggal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tanggal = Tanggal::findOrFail($id);
        return view('dates.tanggalEdit', compact('tanggal'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TanggalRequest $request, Tanggal $tanggal)
    {

        // $overlap = Tanggal::where(function ($query) use ($request) {
        //     $query->where('tanggal_mulai', '<', $request->tanggal_selesai)
        //          ->where('tanggal_selesai', '>', $request->tanggal_mulai);
        // })->exists();

        // if($overlap){
        //     return back()->with('eror', 'Tanggal Tayang Yang Anda Masukkan Sudah Terisi');
        // }
        // Update record menggunakan data dari request yang telah divalidasi
        $tanggal->update([
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            // 'tanggal_selesai' => $request->input('tanggal_selesai'),
        ]);

        // Redirect ke daftar tanggal dengan pesan sukses
        return redirect()->route('tanggal.index')->with('success', 'Tanggal Tayang Berhasil Di Update');
    }


    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(TanggalRequest $tanggal)
    // {
    //     $tanggal = Tanggal::find($tanggal);

    //

    //     $tanggal->delete();
    //         return redirect()->route('tanggal.index')->with('success', 'Tanggal Tayang updated successfully');


    // }

    public function destroy($id)
    {

        $tanggal = Tanggal::findOrFail($id);
        
        $tanggalCount = $tanggal->details()->count();

        if ($tanggalCount > 0) {
            return redirect()->route("tanggal.index")->with('gagal', 'Tanggal Tidak Dapat diHapus Karena Masih Berkaitan Dengan Film.');
        }
        
        $tanggal->delete();

        return redirect()->route('tanggal.index')->with('success', 'Tanggal berhasil dihapus');
    }
}
