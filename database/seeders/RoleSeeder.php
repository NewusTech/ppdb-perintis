<?php

namespace Database\Seeders;

use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // define role
        $superadmin = Role::create(['name' => 'super admin']);
        $pimpinan = Role::create(['name' => 'pimpinan']);
        $adminPendaftaranAwal = Role::create(['name' => 'admin pendaftaran awal']);
        $adminWawancara = Role::create(['name' => 'admin wawancara']);
        $adminDaftarUlang = Role::create(['name' => 'admin daftar ulang']);
        $adminVerifikasi = Role::create(['name' => 'admin verifikasi']);
        $siswa = Role::create(['name' => 'siswa']);

        $user = User::create([
            'name' => 'Superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($superadmin);

        $user = User::create([
            'name' => 'Pimpinan',
            'username' => 'pimpinan',
            'email' => 'pimpinan@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($pimpinan);

        $user = User::create([
            'name' => 'Admin Pendaftaran Awal',
            'username' => 'admin-pendaftaran-awal',
            'email' => 'admin1@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($adminPendaftaranAwal);

        $user = User::create([
            'name' => 'Admin Wawancara',
            'username' => 'admin-wawancara',
            'email' => 'admin2@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($adminWawancara);

        $user = User::create([
            'name' => 'Admin Daftar Ulang',
            'username' => 'admin-daftar-ulang',
            'email' => 'admin3@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($adminDaftarUlang);

        $user = User::create([
            'name' => 'Admin Verifikasi',
            'username' => 'admin-verifikasi',
            'email' => 'admin4@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($adminVerifikasi);

        // $user = User::create([
        //     'name' => 'Siswa Pertama',
        //     'username' => '1',
        //     'token' => 'AAAAA',
        //     'password' => bcrypt('AAAAA'),
        // ]);
        // $user->assignRole($siswa);
        // Pendaftaran::create([
        //     'user_id' => $user->id,
        //     'kelas_id' => 1,
        //     'no_pendaftaran' => 1,
        // ]);

        // $user = User::create([
        //     'name' => 'Siswa Kedua',
        //     'username' => '2',
        //     'token' => 'AAAAA',
        //     'password' => bcrypt('AAAAA'),
        // ]);
        // $user->assignRole($siswa);
        // Pendaftaran::create([
        //     'user_id' => $user->id,
        //     'kelas_id' => 2,
        //     'no_pendaftaran' => 1,
        // ]);

        // $user = User::create([
        //     'name' => 'Siswa Ketiga',
        //     'username' => '3',
        //     'token' => 'AAAAA',
        //     'password' => bcrypt('AAAAA'),
        // ]);
        // $user->assignRole($siswa);
        // Pendaftaran::create([
        //     'user_id' => $user->id,
        //     'kelas_id' => 3,
        //     'no_pendaftaran' => 1,
        // ]);
    }
}
