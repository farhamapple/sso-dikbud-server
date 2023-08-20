<?php

namespace App\Services;

use App\Models\SettingsModel;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingServices
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
}
