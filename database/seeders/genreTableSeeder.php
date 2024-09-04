<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genre')->insert([
            [
                'genre' => 'Horor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre' => 'Kisah Cinta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre' => 'Perang dunia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genre' => 'Perang XXi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data genre lainnya jika diperlukan
        ]);
    }
}
