<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\genre;
use App\Models\Kursi;
use App\Models\Detail;
use App\Models\Studio;
use App\Models\tanggal;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/DetailController.php

    public function index(request $request)
    {
        // Mengambil data dengan filter dan paginasi
        // $details = Detail::with('genres')->get();

        $genres = Genre::all(); // Jika perlu
        // Jika perlu

        // $searchQuery = $request->input('query');


        // Mengambil data detail sesuai query pencarian
        // $details = Detail::where('judul', 'like', "%{$searchQuery}%")
        //     ->orWhere('pemeran', 'like', "%{$searchQuery}%")
        //     ->orWhere('penulis', 'like', "%{$searchQuery}%")
        //     ->orWhere('sutradara', 'like', "%{$searchQuery}%")
        //     ->paginate(10); // Sesuaikan pagination jika perlu


        // $detail = Detail::with('genres')->get();
        $detail = Detail::latest()->filter(request(['search']))->with('time')->paginate(10)->withQueryString();

        $genres = genre::all();

        $timeCount = Time::all()->count();
        return view("details.detail", compact( "detail","timeCount"));
            }


    // public function search(Request $request)
    // {
    //     // Mendapatkan query pencarian dari request
    //     $searchQuery = $request->input('query', '');

    //     // Mengambil data detail sesuai query pencarian
    //     $details = Detail::where('judul', 'like', "%{$searchQuery}%")
    //         ->orWhere('pemeran', 'like', "%{$searchQuery}%")
    //         ->orWhere('penulis', 'like', "%{$searchQuery}%")
    //         ->orWhere('sutradara', 'like', "%{$searchQuery}%")
    //         ->paginate(10); // Sesuaikan pagination jika perlu

    //     return view('details.index', [
    //         'details' => $details,
    //         'searchQuery' => $searchQuery // Kirim query pencarian kembali ke view
    //     ]);
    // }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genre = Genre::all();
        $time = Time::all();
        $tanggal = tanggal::all();
        $studio = Studio::all();
        $detail = Detail::all();
        return view("details.createDetail", compact("genre", "time", "tanggal", "studio", "detail"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validateData = $request->validate([
        "judul" => "required|max:100",
        "pemeran" => "required|max:300|regex:/^[a-zA-Z\s\,]+$/",
        "tanggalRilis" => "required|date_format:Y-m-d",
        "penulis" => "required|max:200|regex:/^[a-zA-Z\s\,]+$/",
        "sutradara" => "required|max:100|regex:/^[a-zA-Z\s\,]+$/",
        "perusahaanProduksi" => "required|regex:/^[a-zA-Z\s\,]+$/|max:20",
        "foto" => "required|mimes:jpeg,jpg,png,gif|max:4096",
        "deskripsi" => "required|max:300",
        "harga" => "required|numeric|min:0",
        "genres" => "required|array", // Assuming 'genre' is an array of genre IDs
        "id_studio" => "required",
        "id_time" => "required|unique:detail,id_time",
        "id_tanggal" => "required",
    ], [

        "judul.required" => "Judul Harus diIsi",
        "judul.max" => "Judul Maksimal 100 karakter",
        "deskripsi.required" => "Deskripsi Harus diIsi",
        "deskripsi.max" => "Deskripsi Maksimal 300 karakter",
        "pemeran.required" => "Pemeran Harus diIsi",
        "pemeran.max" => "Pemeran Maksimal 300 karakter",
        "pemeran.regex" => "Pemeran Hanya Boleh Abjad",
        "tanggalRilis.required" => "Tanggal Rilis Harus diIsi",
        "tanggalRilis.date_format" => "Tanggal Rilis Y-m-d",
        "penulis.required" => "Penulis Harus diIsi",
        "penulis.max" => "Penulis Maksimal 200 Karakter",
        "penulis.regex" => "Penulis Hanya Boleh Abjad",
        "sutradara.required" => "Sutradara Harus diIsi",
        "sutradara.max" => "Sutradara Maksimal 100 Karakter",
        "sutradara.regex" => "Sutradara Hanya Boleh Abjad",
        "perusahaanProduksi.required" => "Perusahaan Harus diIsi",
        "perusahaanProduksi.regex" => "Perusahaan Produksi Hanya Boleh Abjad",
        "perusahaanProduksi.max" => "Perusahaan Produksi Maksimal 20 karakter",
        "foto.required" => "Foto Harus Diisi",
        "foto.mimes" => "Foto Harus Berupa jpeg,jpg,png,gif",
        "foto.max" => "Foto Maksimal 4MB",
        "harga.required" => "Harga Harus Diisi",
        "harga.numeric" => "Harga Harus Berupa Angka",
        "harga.min" => "Harga Minimal 0",
        "genres.required" => "Genre Harus Diisi",
        "id_studio.required" => "Studio harus diisi",
        "id_time.required" => "Jam Tayang Harus diisi",
        "id_tanggal.required" => "Tanggal Tayang Harus diisi",
       "id_time.unique"=> "Jam Tayang Sudah Terpakai",
    ]);

    // Initialize $imageName
    $imageName = null;

    // Upload and save the image
    if ($request->hasFile("foto")) {
        $image = $request->file("foto");
        $imageName = time() . "_" . $image->getClientOriginalName();
        $image->move(public_path("image"), $imageName);
    }

    // Create new Detail instance
    $detail = Detail::create([
        'judul' => $validateData['judul'],
        'pemeran' => $validateData['pemeran'],
        'tanggalRilis' => $validateData['tanggalRilis'],
        'penulis' => $validateData['penulis'],
        'sutradara' => $validateData['sutradara'],
        'perusahaanProduksi' => $validateData['perusahaanProduksi'],
        'foto' => $imageName, // Assign the uploaded image name
        'deskripsi' => $validateData['deskripsi'],
        'harga' => $validateData['harga'],
        'id_studio' => $validateData['id_studio'],
        'id_time' => $validateData['id_time'],
        'id_tanggal' => $validateData['id_tanggal'],
    ]);

    // Sync genres with the detail using 'sync'
    if ($request->has('genres')) {
        $genres = $request->input('genres');
        $detail->genres()->sync($genres);
    }

    // Redirect with success message
    return redirect()->route("detail")->with("success", "Berhasil Tambah Detail");
}


    /**
     * Display the specified re source.
     */
    public function show(Detail $detail)
    {
        $detail = Detail::latest()->filter(request(['search']))->with('time')->paginate(10)->withQueryString();
        $genres = genre::all();
        $timeCount = Time::all()->count();

        return view("details.film", compact("detail","timeCount"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detail = Detail::find($id);

        $genre = Genre::all();

        $tanggal = tanggal::all();
        $studio = Studio::all();
        $time = Time::all();
        return view("details.editDetail", compact("detail", "genre", "time", "tanggal", "studio"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Temukan detail berdasarkan ID atau lemparkan pengecualian jika tidak ditemukan
        $detail = Detail::findOrFail($id);

        // Validasi data dari request
        $validatedData = $request->validate([
            "judul" => "required|max:100",
            "pemeran" => "required|max:300|regex:/^[a-zA-Z\s\,]+$/",
            "tanggalRilis" => "required|date_format:Y-m-d",
            "penulis" => "required|max:200|regex:/^[a-zA-Z\s\,]+$/",
            "sutradara" => "required|max:100|regex:/^[a-zA-Z\s\,]+$/",
            "perusahaanProduksi" => "required|regex:/^[a-zA-Z\s\,]+$/|max:20",
            "foto" => "mimes:jpeg,jpg,png,gif|max:4096|nullable",
            "deskripsi" => "required|max:300",
            "harga" => "required|numeric|min:0",
            "genres" => "required|array", // Assuming 'genre' is an array of genre IDs
            "id_studio" => "required",
            "id_time" => "required",
            "id_tanggal" => "required",


        ],[
            "judul.required"=> "Judul Harus diIsi",
            "judul.max"=> "Judul Maksimal 100 karakter",
            "deskripsi.required"=> "Deskripsi Harus diIsi",
            "deskripsi.max"=> "Deskripsi Maksimal 200 karakter",
            "pemeran.required"=> "Pemeran Harus diIsi",
            "pemeran.max"=> "Pemeran Maksimal 300 karakter",
            "pemeran.regex"=> "Pemeran Hanya Boleh Abjad",
            "tanggalRilis.required"=> "Tanggal Rilis Harus diIsi",
            "tanggalRilis.date_format"=> "Tanggal Rilis Y-m-d",
            "penulis.required"=> "Penulis Harus diIsi",
            "penulis.max"=> "Penulis Maksimal 200 Karakter",
            "penulis.regex"=>"Penulis Hanya Boleh Abjad",
            "sutradara.required"=> "Sutradara Harus diIsi",
            "sutradara.max"=> "Sutradara Maksimal 100 Karakter",
            "sutradara.regex"=>"Sutradara Hanya Boleh Abjad",
            "perusahaanProduksi.required"=> "Perusahaan Harus diIsi",
            "perusahaanProduksi.regex"=>"Perusahaan Produksi Hanya Boleh Abjad",
            "perusahaanProduksi.max"=>"Perusahaan Produksi Maksimal 20",
            "id_studio.required" => "Studio harus diisi",
            "id_time.required" => "Jam Tayang Harus diisi",
            "id_tanggal.required" => "Tanggal Tayang Harus diisi",
            "foto.mimes"=>"Foto Harus Berupa jpeg,jpg,png,gif",
            "foto.max"=>"Foto Maksimal 4Mb",
            "harga.required"=> "Harga Harus Diisi",
            "harga.numeric"=> "Harga Harus Berupa Angka",
            "harga.min"=> "Harga Minimal 0",
            "genres.required"=> "Genre Harus Diisi",

        ]);

     
        if ($request->hasFile("foto")) {
            $image = $request->file("foto");
            $imageName = time() . "_" . $image->getClientOriginalName();
            $image->move(public_path("image"), $imageName);

            // Hapus foto lama jika ada dan perbarui nama foto baru
            if ($detail->foto) {
                $oldImagePath = public_path('image/') . $detail->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $detail->foto = $imageName;
        }

        // Update data detail
        $detail->update([
            'judul' => $validatedData['judul'],
            'pemeran' => $validatedData['pemeran'],
            'tanggalRilis' => $validatedData['tanggalRilis'],
            'penulis' => $validatedData['penulis'],
            'sutradara' => $validatedData['sutradara'],
            'perusahaanProduksi' => $validatedData['perusahaanProduksi'],
            'deskripsi' => $validatedData['deskripsi'],
            'harga' => $validatedData['harga'],
            'id_studio' => $validatedData['id_studio'],
            'id_time' => $validatedData['id_time'],
            'id_tanggal' => $validatedData['id_tanggal'],
        ]);

        // Sinkronisasi genres jika ada yang dipilih
        if ($request->has('genres')) {
            $genres = $request->input('genres');
            $detail->genres()->sync($genres);
        }

        // Redirect dengan pesan sukses setelah berhasil update
        return redirect()->route("detail")->with("success", "Berhasil Edit Detail Film");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detail = Detail::findOrFail($id);

        $detailCount = $detail->orders->count();

        if ($detailCount > 0) {
            return redirect()->route("detail")->with("delete", "Gagal Menghapus Film Karena Masih Berkaitan Dengan Order ");
        }

        if ($detail->foto) {
            $imagePath = public_path('image') . '/' . $detail->foto;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $detail->delete();

        return redirect()->route("detail")->with("success", "Berhasil Menghapus Detail");
    }
}
