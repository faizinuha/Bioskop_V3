@extends('layouts.app')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    .container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .btn-submit {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #45a049;
    }

    .result {
        margin-top: 20px;
        font-size: 1.2em;
        color: green;
    }

    .toast-container {
        position: fixed;
        /* bottom: 2rem; */
        right: 2rem;
        z-index: 11;
        width: 300px;
        animation: slideUp 0.5s ease-in-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .toast-body svg {
        margin-right: 10px;
        vertical-align: middle;
    }

    .toast-body {
        display: flex;
        align-items: center;
    }
</style>
@section('content')
    @if (session('gagal'))
        <div class="toast-container">
            <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm3.707 9.707a1 1 0 0 1-1.414 0L8 9.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L6.586 8 4.293 5.707a1 1 0 0 1 1.414-1.414L8 6.586l2.293-2.293a1 1 0 0 1 1.414 1.414L9.414 8l2.293 2.293a1 1 0 0 1 0 1.414z"/>
                        </svg>
                        {{ session('gagal') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session('success'))
        <div class="toast-container">
            <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm3.97 4.97a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-2-2a.75.75 0 0 1 1.06-1.06L7.25 9.94l4.47-4.47a.75.75 0 0 1 1.06 0z"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <h2>Halaman Pembayaran</h2>
        <form action="{{ route('order.update', $order->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="jumlah_tiket">Total Tiket:</label>
                <input type="number" name="jumlah_tiket" value="{{ $order->jumlah_tiket }}" readonly>
            </div>
            <div class="form-group">
                <label for="total_harga">Total Bayar:</label>
                <input type="number" name="total_harga" value="{{ $order->total_harga }}" readonly>
            </div>
            <div class="form-group">
                <label for="pembayaran">Bayar: </label>
                <input type="number" id="pembayaran" name="pembayaran" required oninput="calculateChange()">
            </div>
            <div class="form-group">
                <label for="kembalian_display">Kembalian: </label>
                <input type="text" id="kembalian_display" name="kembalian_display" placeholder="Rp. 0" readonly>
            </div>
            <input type="hidden" id="hidden_kembalian" name="kembalian">
            <button type="submit" class="btn-submit">Bayar</button>
        </form>
    </div>

    <script>
        function formatRupiah(angka) {
            return "Rp. " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    // menghitung data2
        function calculateChange() {
            var totalBayar = parseFloat(document.querySelector('input[name="total_harga"]').value);
            var pembayaran = parseFloat(document.getElementById('pembayaran').value);
            var kembalian = pembayaran - totalBayar;
    // menghitung pembayaran
            if (pembayaran > 0) {
                if (kembalian >= 0) {
                    document.getElementById('kembalian_display').value = formatRupiah(kembalian);
                    document.getElementById('hidden_kembalian').value = kembalian;
                } else {
                    document.getElementById('kembalian_display').value = "Rp. 0";
                    document.getElementById('hidden_kembalian').value = 0;
                }
            } else {
                document.getElementById('kembalian_display').value = "";
                document.getElementById('hidden_kembalian').value = 0;
            }
        }
    </script>
@endsection
