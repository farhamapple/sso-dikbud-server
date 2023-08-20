<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array('name' => 'Masters.User.View','description' => 'Akses untuk melihat menu user');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.User.Create','description' => 'Akses untuk membuat User');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.User.Edit','description' => 'Akses untuk mengedit user');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.User.Delete','description' => 'Akses untuk menghapus user');	DB::table("permissions")->insert($data);

        $data = array('name' => 'Masters.OauthClient.View','description' => 'Akses View Oauth Client');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.OauthClient.Create','description' => 'Akses untuk Create Oauth Client');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.OauthClient.Edit','description' => 'Akses untuk Edit Oauth Client');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.OauthClient.Delete','description' => 'Akses untuk menghapus Oauth Client');	DB::table("permissions")->insert($data);

        $data = array('name' => 'Masters.ClientApp.View','description' => 'Akses View Client App');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.ClientApp.Create','description' => 'Akses Create Client App');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.ClientApp.Edit','description' => 'Akses View Client App');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.ClientApp.Delete','description' => 'Akses View Client App');	DB::table("permissions")->insert($data);

        $data = array('name' => 'Menu.Master.View','description' => 'Akses View main Menu Masterdata');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Menu.AllUser.View','description' => 'Akses View main Menu User');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Dashboard.View','description' => 'Akses View dashboard');	DB::table("permissions")->insert($data);
        $data = array('name' => 'LogAccess.View','description' => 'Akses View Log akses');	DB::table("permissions")->insert($data);

        $data = array('name' => 'Masters.Roles.View','description' => 'akses untuk melihat data roles');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.Roles.Create','description' => 'akses untuk membuat roles');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.Roles.Edit','description' => 'akses untuk mengedit roles');	DB::table("permissions")->insert($data);
        $data = array('name' => 'Masters.Roles.Delete','description' => 'akses untuk menghapus roles');	DB::table("permissions")->insert($data);
        // setting
        $data = array('name' => 'General.Setting.View','description' => 'Merubah setting aplikasi');	DB::table("permissions")->insert($data);
    }
}
