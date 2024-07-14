<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_surat')->insert([
            'nama_kategori' => 'Undangan',
            'keterangan' => 'Surat undangan'
        ]);
        DB::table('kategori_surat')->insert([
            'nama_kategori' => 'Pengumunan',
            'keterangan' => 'Surat-surat pengumuman'
        ]);
        DB::table('kategori_surat')->insert([
            'nama_kategori' => 'Nota Dinas',
            'keterangan' => 'Kumpulan nota dinas yang sudah terbit'
        ]);
        DB::table('kategori_surat')->insert([
            'nama_kategori' => 'Pemberitahuan',
            'keterangan' => 'Surat-surat pemberitahuan yang sudah disebarkan'
        ]);

    }
}
