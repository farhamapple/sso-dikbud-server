<?php

namespace App\Services;

use App\Models\SsoClientApp;
use Exception;

class SsoClientAppServices
{
  public function __construct()
  {
  }

  public function getAll()
  {
    try {
      //code...
      $data = SsoClientApp::get();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Sso Client Apps');
    }
  }
}
