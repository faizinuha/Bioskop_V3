Berikut adalah README untuk proyek "Bioskop Premini" yang sudah dirapikan:

---

# Bioskop Premini

Bioskop Premini adalah aplikasi web yang memungkinkan pengguna untuk melihat daftar tayangan film, mengelola jadwal tayang, dan melakukan berbagai fungsi CRUD untuk data film.

## Fitur

- **CRUD Time**: Menambahkan, mengedit, dan menghapus waktu tayang film.
- **CRUD Film**: Menambahkan, mengedit, dan menghapus informasi film.
- **Upload Gambar**: Mengunggah dan menampilkan gambar terkait film.
- **Notifikasi Toast**: Menampilkan notifikasi untuk operasi berhasil atau gagal.
- **Validasi Formulir**: Memastikan data yang diinput oleh pengguna valid.

## Instalasi

1. Clone repositori ini:

    ```bash
    git clone https://github.com/mann7866/bioskop.git
    ```

2. Masuk ke direktori proyek:

    ```bash
    cd bioskop
    ```

3. Install dependencies menggunakan Composer:

    ```bash
    composer install
    ```

4. Copy file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:

    ```bash
    cp .env.example .env
    ```

5. Generate application key:

    ```bash
    php artisan key:generate
    ```

6. Migrasi database:

    ```bash
    php artisan migrate
    ```

7. Jalankan aplikasi:

    ```bash
    php artisan serve
    ```

    Aplikasi sekarang berjalan di `http://localhost:8000`.

## Struktur Proyek

- `app/Http/Controllers`: Berisi controller untuk mengelola logika aplikasi.
- `app/Models`: Berisi model untuk interaksi dengan database.
- `resources/views`: Berisi template Blade untuk tampilan antarmuka pengguna.
- `public/css`: Berisi file CSS untuk styling aplikasi.
- `public/js`: Berisi file JavaScript untuk interaktivitas aplikasi.

## Cara Penggunaan

### Menambah Time

1. Klik tombol "Tambah Time" di halaman daftar tayangan.
2. Isi formulir dengan waktu dan tanggal tayang.
3. Klik "Simpan" untuk menambah waktu tayang baru.

### Mengedit Time

1. Klik ikon pensil di sebelah time yang ingin diedit.
2. Ubah informasi yang diinginkan.
3. Klik "Simpan" untuk menyimpan perubahan.

### Menghapus Time

1. Klik ikon tong sampah di sebelah time yang ingin dihapus.
2. Konfirmasi penghapusan.

### Notifikasi

Setiap operasi CRUD akan menampilkan notifikasi toast di pojok kanan atas layar untuk memberikan umpan balik kepada pengguna.

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan fork repositori ini, buat branch baru untuk fitur atau perbaikan Anda, dan buat pull request. Kami sangat menghargai kontribusi Anda!

## Lisensi

Proyek ini dilisensikan di bawah lisensi MIT. Lihat file `LICENSE` untuk informasi lebih lanjut.

## Kontak

Untuk informasi lebih lanjut atau pertanyaan, silakan hubungi [rtxalham@example.com].

---

username `mann7866` dan `rtxalham@example.com` 
