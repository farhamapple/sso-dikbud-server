<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class RolesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $tables = 'roles';
    $data = [
      'id' => 1,
      'name' => 'administrator',
      'login_destination' => 'home',
      'description' => 'Role super admin',
      'created_at' => Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon::now()->toDateTimeString(),
      'ref' => Str::uuid(),
    ];
    DB::table($tables)->insert($data);
    $data = [
      'id' => 2,
      'name' => 'pegawai',
      'login_destination' => 'home',
      'description' => 'Role pegawai biasa',
      'created_at' => Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon::now()->toDateTimeString(),
      'ref' => Str::uuid(),
    ];
    DB::table($tables)->insert($data);
  }
}
