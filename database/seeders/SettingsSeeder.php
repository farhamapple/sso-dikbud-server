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
    $data = [
      'name' => 'site.title',
      'module' => 'core',
      'value' => 'SSO Kemendikbud',
    ];
    DB::table('settings')->insert($data);
    //  SMTP
    /*
    $data = [
      'name' => 'smtp_pass',
      'module' => 'email',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'smtp_port',
      'module' => 'email',
      'value' => '443',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'smtp_timeout',
      'module' => 'email',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'sender_email',
      'module' => 'email',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'mailpath',
      'module' => 'email',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'mailtype',
      'module' => 'email',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'protocol',
      'module' => 'email',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'smtp_host',
      'module' => 'email',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'smtp_user',
      'module' => 'email',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    */
    // MAIL SETTING

    $data = [
      'name' => 'MAIL_MAILER',
      'module' => 'email',
      'value' => 'smtp',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'MAIL_HOST',
      'module' => 'email',
      'value' => 'sandbox.smtp.mailtrap.io',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'MAIL_PORT',
      'module' => 'email',
      'value' => '2525',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'MAIL_USERNAME',
      'module' => 'email',
      'value' => '3221f49a62005f',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'MAIL_PASSWORD',
      'module' => 'email',
      'value' => 'e1cc0ff77f8f89',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'MAIL_ENCRYPTION',
      'module' => 'email',
      'value' => 'tls',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'MAIL_FROM_ADDRESS',
      'module' => 'email',
      'value' => 'no-reply@kemendikbudristek.com',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'MAIL_FROM_NAME',
      'module' => 'email',
      'value' => '[ Notifkiasi from SSO Kemendikbudristek ]',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'MAIL_LOG_CHANNEL',
      'module' => 'email',
      'value' => null,
    ];
    DB::table('settings')->insert($data);

    // WA
    $data = [
      'name' => 'wa.url',
      'module' => 'wa',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'wa.username',
      'module' => 'wa',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'wa.token',
      'module' => 'wa',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'wa.password',
      'module' => 'wa',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'wa.number',
      'module' => 'wa',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'wa.templatemessage',
      'module' => 'wa',
      'value' => '-',
    ];
    DB::table('settings')->insert($data);
    $data = [
      'name' => 'endpoint.pegawai',
      'module' => 'core',
      'value' => '1',
    ];
    // 1 = dikbudhr
    // 2 = siasn
    DB::table('settings')->insert($data);
  }
}
