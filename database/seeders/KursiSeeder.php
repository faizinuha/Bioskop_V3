<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KursiSeeder extends Seeder
{
    public function run()
    {
        $seats = [];
        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        $columns = range(1, 8); // Kolom 1 sampai 8

        foreach ($rows as $row) {
            foreach ($columns as $column) {
                $seats[] = ['kursi' => $row . $column];
            }
        }

        // Insert all seats into the database
        DB::table('kursi')->insert($seats);
    }
}
