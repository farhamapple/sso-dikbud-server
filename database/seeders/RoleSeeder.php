<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //
    DB::table('roles')->insert([
      'id' => 0,
      'name' => 'ADMIN',
      'created_at' => Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon::now()->toDateTimeString(),
      'ref' => Str::uuid(),
    ]);

    DB::table('roles')->insert([
      'id' => 1,
      'name' => 'GUEST',
      'created_at' => Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon::now()->toDateTimeString(),
      'ref' => Str::uuid(),
    ]);
  }
}
