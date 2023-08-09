<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = "roles";
        $data = array(
            'role_id' => 1,
            'role_name' => 'administrator',
            'login_destination' => 'home',
            'description' => 'Role super admin'
        );
        DB::table($tables)->insert($data);
        $data = array(
            'role_id' => 2,
            'role_name' => 'pegawai',
            'login_destination' => 'home',
            'description' => 'Role pegawai biasa'
        );
        DB::table($tables)->insert($data);
    }
}
