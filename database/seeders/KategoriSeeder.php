<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = ['Teknologi', 'Pendidikan', 'Olahraga', 'Kesehatan', 'Ekonomi', 'Politik'];

        foreach ($kategoris as $nama) {
            DB::table('kategoris')->insert([
                'nama' => $nama,
                'slug' => Str::slug($nama),
            ]);
        }
    }
}
