<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            'name' => 'site.title',
            'module' => 'core',
            'value' => 'SSO Kemendikbud'
        );
        DB::table("settings")->insert($data);
        //  SMTP
        $data = array(
            'name' => 'smtp_pass',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'smtp_port',
            'module' => 'email',
            'value' => '443'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'smtp_timeout',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'sender_email',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'mailpath',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'mailtype',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'protocol',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'smtp_host',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'smtp_user',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        // WA
        $data = array(
            'name' => 'wa.url',
            'module' => 'wa',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'wa.username',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'wa.token',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'wa.password',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'wa.number',
            'module' => 'email',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'wa.templatemessage',
            'module' => 'waa',
            'value' => '-'
        );
        DB::table("settings")->insert($data);
        $data = array(
            'name' => 'endpoint.pegawai',
            'module' => 'core',
            'value' => '1'
        );
        // 1 = dikbudhr
        // 2 = siasn
        DB::table("settings")->insert($data);
    }
}
