<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolePermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $data = ['role_id' => 1, 'permissions_id' => 1];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 2];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 3];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 4];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 5];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 6];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 7];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 8];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 9];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 10];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 11];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 12];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 13];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 14];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 15];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 16];
    DB::table('role_permissions')->insert($data);

    $data = ['role_id' => 1, 'permissions_id' => 17];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 18];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 19];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 20];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 2, 'permissions_id' => 15];
    DB::table('role_permissions')->insert($data);
    $data = ['role_id' => 1, 'permissions_id' => 21];
    DB::table('role_permissions')->insert($data);
  }
}
