<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KelasSeeder::class);
        $this->call(BiayaDaftarUlangSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(TataTertibSeeder::class);
    }
}
