<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleUsersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //
    $tables = 'roles_users';
    $data = [
      'role_user_id' => 1,
      'role_id' => 1,
      'user_id' => 1,
    ];
    DB::table($tables)->insert($data);
  }
}
