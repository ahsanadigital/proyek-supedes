<?php

namespace Database\Seeders;

use App\Models\DataPenduduk;
use Illuminate\Database\Seeder;

class GenerateDataPenduduk extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataPenduduk::create([
            'nama_lengkap'      => 'Agus Setyo Nugraha',
            'nomor_nik'         => '352108310102009',
            'jenis_kelamin'     => 'l',
            'tempat_lahir'      => 'Klaten',
            'tgl_lahir'         => '2002-01-31',
            'kewarganegaraan'   => 'wni',
            'agama'             => 'Islam',
            'pend_terakhir'     => 'sma',
            'pekerjaan'         => 'Wirausaha',
            'alamat_jalan'      => 'Jl. Munggut - Sidorejo, Sidorejo',
            'RT'                => 3,
            'RW'                => 1,
        ]);
        DataPenduduk::create([
            'nama_lengkap'      => 'Hari Setyawan Nugroho',
            'nomor_nik'         => '352108310103009',
            'jenis_kelamin'     => 'l',
            'tempat_lahir'      => 'Ngawi',
            'tgl_lahir'         => '2001-01-31',
            'kewarganegaraan'   => 'wni',
            'agama'             => 'Islam',
            'pend_terakhir'     => 'sma',
            'pekerjaan'         => 'Wirausaha',
            'alamat_jalan'      => 'Jl. Munggut - Sidorejo, Sidorejo',
            'RT'                => 3,
            'RW'                => 1,
        ]);
        DataPenduduk::create([
            'nama_lengkap'      => 'Ahmad Sayyidul Arifin',
            'nomor_nik'         => '352108150476009',
            'jenis_kelamin'     => 'l',
            'tempat_lahir'      => 'Jakarta',
            'tgl_lahir'         => '1992-02-19',
            'kewarganegaraan'   => 'wni',
            'agama'             => 'Islam',
            'pend_terakhir'     => 'sarjana',
            'pekerjaan'         => 'Wirausaha',
            'alamat_jalan'      => 'Jl. Munggut - Sidorejo, Sidorejo',
            'RT'                => 3,
            'RW'                => 1,
        ]);
        DataPenduduk::create([
            'nama_lengkap'      => 'Yunia Agustin Lutihfiyah',
            'nomor_nik'         => '352108121291009',
            'jenis_kelamin'     => 'l',
            'tempat_lahir'      => 'Semarang',
            'tgl_lahir'         => '1991-12-12',
            'kewarganegaraan'   => 'wni',
            'agama'             => 'Islam',
            'pend_terakhir'     => 'sarjana',
            'pekerjaan'         => 'Wirausaha',
            'alamat_jalan'      => 'Jl. Munggut - Sidorejo, Sidorejo',
            'RT'                => 3,
            'RW'                => 1,
        ]);
        DataPenduduk::create([
            'nama_lengkap'      => 'Catherine Amelia Sugiarto',
            'nomor_nik'         => 'KTS12881213312',
            'jenis_kelamin'     => 'l',
            'tempat_lahir'      => 'Abu Dhabi',
            'tgl_lahir'         => '1993-12-12',
            'kewarganegaraan'   => 'wna',
            'agama'             => 'Islam',
            'pend_terakhir'     => 'sarjana',
            'pekerjaan'         => '',
            'alamat_jalan'      => 'Jl. Munggut - Sidorejo, Sidorejo',
            'RT'                => 3,
            'RW'                => 1,
        ]);
    }
}
