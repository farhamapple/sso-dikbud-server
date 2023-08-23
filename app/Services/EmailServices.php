<?php

namespace App\Services;

use App\Models\SettingsModel;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EmailServices
{
  public function __construct()
  {
  }

  public function getSettingByName($name)
  {
    try {
      //code...
      $data = SettingsModel::where('name', $name)->first();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Setting');
    }
  }

  public static function testMailer()
  {
    return 'smtp';
  }

  public static function MailMailer()
  {
    try {
      //code...
      $data = SettingsModel::where('name', 'MAIL_MAILER')->first();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Setting');
    }
  }

  public static function MailHost()
  {
    try {
      //code...
      $data = SettingsModel::where('name', 'MAIL_HOST')->first();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Setting');
    }
  }

  public static function MailPort()
  {
    try {
      //code...
      $data = SettingsModel::where('name', 'MAIL_PORT')->first();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Setting');
    }
  }

  public static function MailUsername()
  {
    try {
      //code...
      $data = SettingsModel::where('name', 'MAIL_USERNAME')->first();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Setting');
    }
  }

  public static function MailPassword()
  {
    try {
      //code...
      $data = SettingsModel::where('name', 'MAIL_PASSWORD')->first();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Setting');
    }
  }

  public static function MailEncryption()
  {
    try {
      //code...
      $data = SettingsModel::where('name', 'MAIL_ENCRYPTION')->first();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Setting');
    }
  }

  public static function MailFromAddress()
  {
    try {
      //code...
      $data = SettingsModel::where('name', 'MAIL_FROM_ADDRESS')->first();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Setting');
    }
  }

  public static function MailFromName()
  {
    try {
      //code...
      $data = SettingsModel::where('name', 'MAIL_FROM_NAME')->first();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Setting');
    }
  }

  public static function MailLogChannel()
  {
    try {
      //code...
      $data = SettingsModel::where('name', 'MAIL_LOG_CHANNEL')->first();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Setting');
    }
  }
}
