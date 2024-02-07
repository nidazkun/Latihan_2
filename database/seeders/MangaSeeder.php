<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MangaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('manga')->insert([
            [
                'nama_manga'     => 'Berserk',
                'jumlah_manga'   => 3,
                'pengarang_id'   => 1,
                'created_at'     => date("Y-m-d H:i:s")
            ],
            [
                'nama_manga'     => 'Miuranger',
                'jumlah_manga'   => 1,
                'pengarang_id'   => 1,
                'created_at'     => date("Y-m-d H:i:s")
            ],
            [
                'nama_manga'     => 'Ken e no michi',
                'jumlah_manga'   => 1,
                'pengarang_id'   => 1,
                'created_at'     => date("Y-m-d H:i:s")
            ]
        ]

        );
    }
}
