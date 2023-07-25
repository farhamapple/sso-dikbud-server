<?php

namespace App\Services;

use App\Models\SsoClientApp;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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

  public function saveData($data)
  {
    try {
      //code...
      $newData = new SsoClientApp();
      $newData->name = $data->name;
      $newData->link_redirect = $data->link_redirect;
      $newData->icon = $data->icon;
      $newData->created_at = Carbon::now()->toDateTimeString();
      $newData->updated_at = Carbon::now()->toDateTimeString();
      $newData->ref = Str::uuid();
      isset($data->is_active) ? ($is_active = '1') : ($is_active = '0');
      $newData->is_active = $is_active;
      $newData->save();
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat Insert Data');
    }
  }

  public function updateToInactive($ref)
  {
    try {
      //code...
      $data = SsoClientApp::where('ref', $ref)->first();
      $data->is_active = '0';
      $data->save();
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat InActive');
    }
  }

  public function updateToActive($ref)
  {
    try {
      //code...
      $data = SsoClientApp::where('ref', $ref)->first();
      $data->is_active = '1';
      $data->save();
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat To Active');
    }
  }
}
