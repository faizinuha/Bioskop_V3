@extends('layouts.app')

<style>
    /* Styles for the studio and seat selection */
    .studio-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .studio-card {
        background-color: #f5f5f5;
        border: 1px solid #dcdcdc;
        border-radius: 10px;
        padding: 20px;
        display: flex;
        align-items: center;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .studio-card:hover {
        background-color: #eaeaea;
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .studio-card input[type="radio"] {
        margin-right: 15px;
    }

    .studio-card label {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875rem;
    }

    .kursi-item {
    width: 85%; /* Membuat kursi memenuhi lebar kolom grid */
    height: 85%; /* Membuat kursi memenuhi tinggi baris grid */
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f0f0;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
    .kursi-item.selected {
        background-color: #76c7c0;
        color: white;
    }

    .kursi-item.status {
        background-color: #b0bec5;
        cursor: not-allowed;
    }

    .kursi-item::after {
        content: attr(title);
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: #fff;
        padding: 5px;
        border-radius: 3px;
        font-size: 0.75rem;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s;
        z-index: 10;
    }

    .kursi-item:hover::after {
        opacity: 1;
        visibility: visible;
    }

    .film-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .film-card {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        width: 100%;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .film-card:hover {
        background-color: #e0e0e0;
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .film-label {
        font-size: 1.3rem;
        font-weight: bold;
        color: #444;
    }

    .kursi-item input[type="checkbox"] {
        display: none;
    }

    .kursi-row {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* Membuat grid dengan 5 kolom */
    grid-auto-rows: 50px; /* Menentukan tinggi setiap baris */
    gap: 10px; /* Jarak antar kursi */
    justify-items: center; /* Menempatkan kursi di tengah setiap kolom */
}

    .modal-dialog {
        max-width: 80%;
    }
    .modal-title{

        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        background-color: #fff;
        padding: 15px;
        margin-bottom: 10px;
    }
</style>

@section('content')
    <div class="container mt-4">
        <div class="form-container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Film Detail -->
                    <div class="card film-card">
                        <img src="{{ asset('image/' . $detail->foto) }}" class="img-fluid" alt="{{ $detail->judul }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $detail->judul }}</h5>
                            <h5 class="card-categori">Genres:</h5>
                                @foreach ($detail->genres as $genre)
                                    <p class="badge text-bg-info" style="list-style:none;">{{ $genre->genre }}</p>
                                @endforeach
                            <h6><strong>Studio:</strong></h6>
                            <p class="badge text-bg-secondary badge-genre text-light">{{ $detail->studio->studio }}</p>
                            <div class="">
                                <h6><strong>Tayang pada </strong></h6>
                            </div>
                            <div class="">
                                <p class="badge text-bg-warning badge-genre text-muted text-muted">{{ strftime('%d, %B, %Y', strtotime($detail->tanggal->tanggal_mulai)) }}</p>
                                <p class="badge text-bg-warning badge-genre text-muted text-muted"> {{ $detail->time->jam_mulai }} - {{ $detail->time->jam_selesai }}</p>
                            </div>

                            <h6>Harga Tiket Film :</h6>
                            <h6 class="badge text-bg-secondary badge-genre text-light">Rp. {{ number_format($detail->harga) }}</h6>
                            <h6>Deskripsi :</h6>
                            <p class="card-text text-muted ">{{ $detail->deskripsi }}</p>
                        </div>

                    </div>

                </div>
                <div class="col-md-8">
                    <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                        @csrf
                        <input type="hidden" name="id_detail" value="{{ $detail->id }}">
                        <div class="mb-3">
                            <div class="col-md-6">
                                <input type="hidden" class="form-control @error('jumlah_tiket') is-invalid @enderror"
                                    id="jumlah_tiket_input" name="jumlah_tiket" readonly>
                                @error('jumlah_tiket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" class="form-control @error('total_harga') is-invalid @enderror"
                                    id="total_harga_input" name="total_harga" readonly>
                                @error('total_harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Studio and Seat Selection -->
                        {{-- data ada di query --}}
                        <h6>Pilih Kursi:</h6>
                        {{--  {{ dd($bookedSeats) }}  --}}
                        <div class="modal-title mb-3 kursi-row">
                            @foreach ($detail->studio->kursi as $kursi)
                            <div class="kursi-item {{ in_array($kursi->id, $bookedSeats) ? 'status' : '' }}"
                                data-seat-id="{{ $kursi->id }}"
                                data-seat-number="{{ $kursi->kursi }}"
                                title="{{ in_array($kursi->id, $bookedSeats) ? 'Kursi sudah dipesan' : '' }}">
                                <input class="form-check-input @error('kursis') is-invalid @enderror"
                                    type="checkbox" name="kursis[]" value="{{ $kursi->id }}"
                                    {{ in_array($kursi->id, $bookedSeats) ? 'disabled' : '' }}>
                                <strong>{{ $kursi->kursi }}</strong>
                            </div>
                        @endforeach

                        </div>
                        <div class="card film-card">
                            <div class="card-body">
                                <div class="summary-card mt-4">
                                    <h6 class="mb-2">Ringkasan:</h6>
                                    <p id="jumlah_tiket_summary">Jumlah Tiket: 0</p>
                                    <p id="total_harga_summary">Total Harga: Rp. 0</p>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary mt-3 col-md-2" type="submit" name="submit">Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hargaPerKursi = {{ $detail->harga }};

            // Ambil data kursi dari elemen HTML
            const seats = Array.from(document.querySelectorAll('.kursi-item')).map(item => ({
                id: parseInt(item.dataset.seatId),
                status: item.classList.contains('status') ? 'order' : 'Notorder',
                element: item // Simpan referensi elemen HTML kursi
            }));

            // Fungsi untuk memperbarui total harga
            function updateTotalHarga() {
                const selectedSeats = seats.filter(seat => seat.status === 'selected').length;
                const totalHarga = selectedSeats * hargaPerKursi;

                // Update summary
                document.getElementById('jumlah_tiket_summary').textContent = `Jumlah Tiket: ${selectedSeats}`;
                document.getElementById('total_harga_summary').textContent = `Total Harga: Rp. ${totalHarga.toLocaleString()}`;

                // Update form inputs
                document.getElementById('jumlah_tiket_input').value = selectedSeats;
                document.getElementById('total_harga_input').value = totalHarga; // Just the number, not formatted
            }

            // Fungsi untuk menggambar kursi di halaman
            function drawSeats() {
                seats.forEach(seat => {
                    const seatElement = seat.element;
                    seatElement.classList.remove('selected');
                    seatElement.classList.add(seat.status);

                    const checkbox = seatElement.querySelector('input[type="checkbox"]');
                    checkbox.disabled = seat.status === 'order'; // Disable checkbox if the seat is ordered
                });

                updateTotalHarga(); // Update total harga setiap kali kursi digambar
            }

            // Fungsi untuk memilih kursi
            function selectSeat(seatId) {
                const seat = seats.find(seat => seat.id === seatId);
                const seatElement = seat.element;
                const checkbox = seatElement.querySelector('input[type="checkbox"]');

                if (seat.status === 'order') {
                    alert('Kursi ini sudah dipesan dan tidak bisa dipesan.');
                    return;
                }

                // Toggle between 'notorder' and 'selected'
                if (seat.status === 'Notorder') {
                    seat.status = 'selected';
                    seatElement.classList.add('selected');
                    checkbox.checked = true;
                } else if (seat.status === 'selected') {
                    seat.status = 'Notorder';
                    seatElement.classList.remove('selected');
                    checkbox.checked = false;
                }

                updateTotalHarga(); // Update total harga setelah status kursi diubah
            }

            // Pasang event listener untuk setiap kursi
            seats.forEach(seat => {
                seat.element.addEventListener('click', () => selectSeat(seat.id));
            });

            // Gambar kursi saat halaman dimuat
            drawSeats();
        });


    </script>
@endsection
