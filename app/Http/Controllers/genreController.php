<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\genre;
use App\Models\Detail;
use Illuminate\Http\Request;

class genreController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genre = genre::all();
        $detail = Detail::latest()->filter(request(['search']))->paginate(10)->withQueryString();
        return view("genres.genre", compact("genre"));
    }
    
    public function tampilan()
    {
        $genre = genre::all();
        return view("genres.index", compact("genre"));
    }
    /**
     * Show the form for creating a new resource.
     */
    
    public function create()
    {
        return view("genres.createGenre");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreRequest $request)
    {
        // $validateData = $request->validate([
        //     "genre" => "required|max:20|regex:/^[a-zA-Z\s]+$/|unique:genre,genre",
        // ],[
        //     "genre.required"=> "Genre Harus Diisi",
        //     "genre.max"=> "Genre Harus Diisi",
        //     "genre.regex"=> "Genre Hanya Boleh Abjad",
        //     "genre.unique"=> "Genre Tidak Boleh Sama",

        // ]);


        genre::create($request->validated());
        return redirect()->route("genre")->with("success", "Berhasil Tambah Genre");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genre = genre::find($id);
        return view("genres.editGenre", compact("genre"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $genre = genre::find($id);

        $validateData = $request;

        if ($validateData['genre'] !== $genre->genre) {
            $validateData = $request->validate([
                "genre" => "required|max:20|regex:/^[a-zA-Z\s]+$/|unique:genre,genre",
            ],[
                "genre.required"=> "Genre Harus Diisi",
                "genre.max"=> "Genre Harus Diisi",
                "genre.regex"=> "Genre Hanya Boleh Abjad",
                "genre.unique"=> "Genre Tidak Boleh Sama",

            ]);
            $genre->update($validateData);
            return redirect()->route("genre")->with("success", "Berhasil Edit Genre");
        } else {
            return redirect()->route("genre")->with("success", "Berhasil Edit Genre");
        }
    }

    /**
     * Remove the specified resource from storage.
     */


     
    public function destroy(string $id)
    {
        $genre = genre::find($id);

        $genreCount = $genre->details()->count();

        if ($genreCount > 0) {
            return redirect()->route("genre")->with('delete', 'Genre Tidak Dapat diHapus Karena Masih Berkaitan Dengan Film.');
        }

        $genre->delete();
        return redirect()->route("genre")->with('success', 'genre berhasil diHapus.');
    }
}
