<?php

namespace App\Services;

use App\Models\SsoClientApp;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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

  public function getDataByRef($ref)
  {
    try {
      //code...
      $data = SsoClientApp::where('ref', $ref)->first();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Detail Sso Client Apps');
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

  public function updateDataByRef($data, $ref)
  {
    try {
      //code...
      $oldData = SsoClientApp::where('ref', $ref)->first();
      $oldData->name = $data->name;
      $oldData->link_redirect = $data->link_redirect;
      $oldData->icon = $data->icon;
      $oldData->updated_by = Auth::user()->email;
      $oldData->updated_at = Carbon::now()->toDateTimeString();
      isset($data->is_active) ? ($is_active = '1') : ($is_active = '0');
      $oldData->is_active = $is_active;
      $oldData->save();

      return $oldData;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat Update Data');
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

  public function deleteByRef($ref)
  {
    try {
      $oldData = SsoClientApp::where('ref', $ref)->first();
      $oldData->deleted_by = Auth::user()->email;
      $oldData->save();
      $oldData->delete();

      return true;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat Delete Sso Client App');
    }
  }
}
