<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserDataGenerate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'nama_terang'           => 'Hardiyanto Setyawan, S.H., M.Kom.',
            'password'              => bcrypt('hardiyanto123'),
            'email'                 => 'hardiyanto@supedes.co.id',
            'email_verified_at'     => date('Y-m-d H:i:s'),
            'jabatan'               => 'lurah',
            'status'                => 'active',
            // 'foto_profil'           => 'upload/avataaars.png',
        ]);
        User::firstOrCreate([
            'nama_terang'           => 'Rudi Kurniawan Saputra, S.H., M.Hum.',
            'password'              => bcrypt('rudi123'),
            'email'                 => 'rudi@supedes.co.id',
            'email_verified_at'     => date('Y-m-d H:i:s'),
            'jabatan'               => 'lurah',
            'status'                => 'active',
            // 'foto_profil'           => 'upload/avataaras.png',
        ]);
        User::firstOrCreate([
            'nama_terang'           => 'Yulia Putri Nur Anggraeni, S.Kom., M.H.',
            'password'              => bcrypt('yulia123'),
            'email'                 => 'yulia@supedes.co.id',
            'email_verified_at'     => date('Y-m-d H:i:s'),
            'jabatan'               => 'ketua_rt',
            'status'                => 'active',
            // 'foto_profil'           => 'upload/avataaars-1.png',
        ]);
    }
}
