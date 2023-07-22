<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Faker\Factory as Faker;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create('id_ID');

    DB::table('users')->insert([
      'name' => 'Admin',
      'email' => 'admin@email.com',
      'password' => bcrypt('admin123'),
      'username' => 'admin',
      'first_name' => $faker->firstName(),
      'last_name' => $faker->lastName(),
      'email_external' => $faker->email(),
      'address' => $faker->address(),
      'sex' => 'Man',
      'identity_number' => '99999',
      'phone' => '77777',
      'is_active' => '1',
      'is_external_account' => '0',
      'created_at' => Carbon::now()->toDateTimeString(),
      'updated_at' => Carbon::now()->toDateTimeString(),
      'role_id' => 0,
      'ref' => Str::uuid(),
    ]);

    for ($i = 1; $i <= 5; $i++) {
      DB::table('users')->insert([
        'name' => $faker->firstName(),
        'email' => $faker->email(),
        'password' => bcrypt('password'),
        'username' => $faker->email(),
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email_external' => $faker->email(),
        'address' => $faker->address(),
        'sex' => 'Man',
        'identity_number' => $faker->phoneNumber(),
        'phone' => $faker->phoneNumber(),
        'is_active' => '1',
        'is_external_account' => '1',
        'created_at' => Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon::now()->toDateTimeString(),
        'role_id' => 1,
        'ref' => Str::uuid(),
      ]);
    }
  }
}
