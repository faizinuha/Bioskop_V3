<?php

namespace App\Http\Controllers;

use App\Models\Kursi;
use App\Models\Order;
use App\Models\Detail;
use App\Models\Studio;
use App\Models\Time;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $detail = Detail::all();
        $studio = Studio::all();
        $kursi = Kursi::all();
        $order = Order::with('studio', 'detail', 'kursi')->get();
        // dd($order);

        $orders = Order::withTrashed()->get();

        return view("orders.order", compact("detail", "order", "studio", "kursi", 'orders'));
    }

    public function show()
    {
        $detail = Detail::all();
        $studio = Studio::all();
        $kursi = Kursi::all();
        $order = Order::with('studio', 'detail', 'kursi')->get();
        // dd($order);

        $orders = Order::withTrashed()->get();
        return view("histori", compact("detail", "order", "studio", "kursi", 'orders'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    public function order($id)
    {
        $detail = Detail::with('studio.kursi')->findOrFail($id);
        // Ambil ID studio dari detail
        $studioId = $detail->id_studio;

        // Ambil kursi yang sudah dipesan di studio yang sama
        // sebuh cek data yang uhd adad
        $bookedSeats = Order::whereHas('detail', function ($query) use ($studioId) {
            $query->where('id_studio', $studioId);
        })->whereHas('kursi', function ($query) use ($studioId) {
            $query->where('status', 'order');
        })

            ->with('kursi')->get()->pluck('kursi.*.id')->flatten()->toArray();

        return view('orders.createOrder', compact('detail', 'bookedSeats'));
    }



    // $studio = Studio::where('detail');
    // $kursi = Kursi::all();
    // $time = Time::all


    /**aaaa
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validateData = $request->validate([
            'jumlah_tiket' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'id_detail' => 'required',
            'kursis' => 'required|array',
            'kursis.*' => [
                function ($attribute, $value, $fail) use ($request) {
                    $detail = Detail::findOrFail($request->id_detail);
                    $studioId = $detail->id_studio;
                    // Cek apakah kursi sudah dipesan di studio yang sama
                    $alreadyBooked = Order::whereHas('detail', function ($query) use ($studioId) {
                        $query->where('id_studio', $studioId);
                    })->whereHas('kursi', function ($query) use ($value) {
                        $query->where('id_kursi', $value);
                    })->exists();

                    if ($alreadyBooked) {
                        $fail('Kursi yang dipilih sudah dipesan di studio ini.');
                    }
                }
            ],
        ], [
            'jumlah_tiket.required' => 'Jumlah Tiket Harus Diisi',
            'jumlah_tiket.min' => 'Jumlah Tiket Minimal 1',
            'total_harga.min' => 'Total Harga Minimal 0',
            'total_harga.required' => 'Total Harga Harus Diisi',
            'total_harga.numeric' => 'Total Harga Harus Angka',
            'id_detail.required' => 'Detail ID Harus Diisi',
            'kursis.required' => 'Kursi yang dipilih harus diisi',
        ]);

        // Simpan data ke dalam tabel 'orders'
        $order = Order::create([
            'jumlah_tiket' => $validateData['jumlah_tiket'],
            'total_harga' => $validateData['total_harga'],
            'id_detail' => $validateData['id_detail'],
        ]);


        // Sinkronkan kursi yang dipilih jika ada
        // if ($request->has('kursis')) {
        //     $kursis = $request->input('kursis');
        //     $order->kursi()->sync($kursis);
        // }
        if ($request->has('kursis')) {
            $kursis = $request->input('kursis');

            // Sync untuk menambahkan ID baru dan menghapus ID lama yang tidak ada
            $order->kursi()->sync($kursis);

            // Update pivot table jika ada kolom tambahan
            foreach ($kursis as $kursiId) {
                // Misalnya, kita ingin mengatur status menjadi 'active'
                $order->kursi()->updateExistingPivot($kursiId, [
                    'status' => 'order', // Update atau data tambahan lainnya
                ]);
            }
        }

        // foreach ($order->kursi as $kursi) {
        //     // Mengupdate status di tabel pivot untuk menunjukkan bahwa kursi tersedia
        //     $order->kursi()->updateExistingPivot($kursi->id, ['status' => 'order']);
        // }

        return redirect()->route("home")->with("success", "Berhasil Pesan Tiket");
    }
    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detail = Detail::find($id);
        $order = Order::find($id);

        return view("details.pembayaran", compact("order", "detail"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $order = Order::find($id);
        $validateData = $request->validate([

            'jumlah_tiket' => 'required|integer|min:1', // Contoh validasi jumlah_tiket
            'total_harga' => 'required|min:0|numeric',
            'id_detail' => '',
            'pembayaran' => 'required|numeric',

        ], [
            'pembayaran.required' => 'Pembauyaran Tidak Boleh Kosong',
            'pembayaran.numeric' => 'Pembauyaran Harus Angka',
            'jumlah_tiket.required' => 'Jumlah Tiket Harus Diisi',
            'jumlah_tiket.min' => 'Jumlah Tiket Minimal 1',
            'total_harga.min' => 'Jumlah Tiket Minimal 0',
            'total_harga.required' => 'Total Harga Harus Diisi',
            'total_harga.numeric' => 'Total Harga Harus Abjad',
        ]);

        if ($validateData['pembayaran'] >= $order->total_harga) {

            $kembalian = $validateData['pembayaran'] - $order->total_harga;

            $validateData['kembalian'] = $kembalian;

            $order->update($validateData);
            return redirect()->route("order.index")->with("success", "Berhasil Pesan Tiket");
        }
        return redirect()->route("pembayaran", $order->id)->with("gagal", "Pembayaran Tidak Boleh Kurang Dari Total Bayar");
        // if ($validateData['pembayaran'] > $order->total_harga) {

        //     $order->update($validateData);
        //     return redirect()->route("home")->with("success", "Berhasil Pesan Tiket");

        // }
    }

    // OrderController.php
    public function paid(string $id)
    {
        $order = Order::find($id);

        $order->update([
            'status' => 'paid'
        ]);


        return redirect()->route("pembayaran", $order->id);
    }

    // OrderController.php

    // OrderController.php

    public function cancel(string $id)
    {
        // Temukan pesanan berdasarkan ID
        $order = Order::find($id);


        $order->update([
            'status' => 'cancel'
        ]);

        if (!$order) {
            return redirect()->route("histori")->with('error', "Pesanan tidak ditemukan");
        }

        // Hapus hubungan antara pesanan dan kursi di tabel pivot
        foreach ($order->kursi as $kursi) {
            // Mengupdate status di tabel pivot untuk menunjukkan bahwa kursi tersedia
            $order->kursi()->updateExistingPivot($kursi->id, ['status' => 'Notorder']);
        }
        // $order->kursi()->detach();

        // Hapus pesanan itu sendiri
        $order->delete();

        return redirect()->route("order.index")->with('success', "Pesanan berhasil dibatalkan.");
    }


    private function getBadgeClass($status)
    {
        switch ($status) {
            case 'paid':
                return 'badge text-bg-success' + '<ion-icon name="checkmark-done-outline"></ion-icon>';
            case 'cancel':
                return 'badge text-bg-danger';
            default:
                return 'badge badge-bg-secondary';
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        $order->delete();
        // dd($id);
        return redirect()->route("order.index")->with("success", "Berhasil Menghapus Pesanan");
    }
}
