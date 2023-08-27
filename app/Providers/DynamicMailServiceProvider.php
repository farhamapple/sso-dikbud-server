<?php

namespace App\Providers;

use App\Services\EmailServices;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class DynamicMailServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    $settingTable = DB::table('settings')
      ->where('module', 'email')
      ->get();

    foreach ($settingTable as $value) {
      # code...
      $arrMail[$value->name] = $value->value;
    }

    $config = [
      'driver' => $arrMail['MAIL_MAILER'],
      'host' => $arrMail['MAIL_HOST'],
      'port' => $arrMail['MAIL_PORT'],
      'from' => ['address' => $arrMail['MAIL_FROM_ADDRESS'], 'name' => $arrMail['MAIL_FROM_NAME']],
      'encryption' => $arrMail['MAIL_ENCRYPTION'],
      'username' => $arrMail['MAIL_USERNAME'],
      'password' => $arrMail['MAIL_PASSWORD'],
      'sendmail' => '/usr/sbin/sendmail -bs',
      'pretend' => false,
    ];
    Config::set('dynamic-mail', $config);
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    //
  }
}
