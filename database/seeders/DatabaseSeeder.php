<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call(RolesSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(PermissionSeeder::class);
    $this->call(RolePermissionSeeder::class);
    $this->call(SettingsSeeder::class);
    $this->call(RoleUsersSeeder::class);
    $this->call(PersonalAccessToken::class);
  }
}
