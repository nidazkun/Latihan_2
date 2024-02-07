<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PengarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengarang')->insert(
            [
                'nama'           => 'Kentaro Miura',
                'demografi'      => 'Seinen',
                'created_at'     => date("Y-m-d H:i:s")
            ]);
    }
}
