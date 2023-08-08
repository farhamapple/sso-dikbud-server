<?php

namespace App\Services;

use App\Models\OauthClientModel;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OauthClientServices
{
  public function __construct()
  {
  }

  public function getAll()
  {
    try {
      //code...
      $data = OauthClientModel::orderBy('updated_at', 'DESC')->get();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Oauth Client ');
    }
  }

  public function getOauthClientById($id)
  {
    try {
      $data = OauthClientModel::where('id', $id)->first();

      return $data;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat mengambil Data Oauth Client');
    }
  }

  public function getOauthClientByRef($ref)
  {
    try {
      $data = OauthClientModel::where('ref', $ref);

      return $data;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat mengambil Data Oauth Client');
    }
  }

  public function saveData($data)
  {
    try {
      //code...
      $newData = new OauthClientModel();
      $newData->id = Str::uuid();
      $newData->name = $data->name;
      $newData->provider = $data->provider;
      $newData->redirect = $data->redirect;

      $data->secret != null ? ($secret = $data->secret) : ($secret = Str::uuid());
      $newData->secret = $secret;

      isset($data->personal_access_client) ? ($personal_access_client = true) : ($personal_access_client = false);
      $newData->personal_access_client = $personal_access_client;

      isset($data->password_client) ? ($password_client = true) : ($password_client = false);
      $newData->password_client = $password_client;

      isset($data->revoked) ? ($revoked = true) : ($revoked = false);
      $newData->revoked = $revoked;

      $newData->created_at = Carbon::now()->toDateTimeString();
      $newData->updated_at = Carbon::now()->toDateTimeString();
      $newData->save();
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat Insert Data Oauth Client');
    }
  }

  public function update($data, $id)
  {
    try {
      $oldData = OauthClientModel::where('id', $id)->first();
      $oldData->name = $data->name;
      $oldData->provider = $data->provider;
      $oldData->redirect = $data->redirect;
      $oldData->secret = $data->secret;

      isset($data->personal_access_client) ? ($personal_access_client = true) : ($personal_access_client = false);
      $oldData->personal_access_client = $personal_access_client;

      isset($data->password_client) ? ($password_client = true) : ($password_client = false);
      $oldData->password_client = $password_client;

      isset($data->revoked) ? ($revoked = true) : ($revoked = false);
      $oldData->revoked = $revoked;

      $oldData->updated_by = Auth::user()->email;
      $oldData->updated_at = Carbon::now()->toDateTimeString();

      $oldData->save();

      return $oldData;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat Update Data Oauth Client = ' . $e->getMessage());
    }
  }

  public function delete($id)
  {
    try {
      $oldData = OauthClientModel::where('id', $id)->first();
      $oldData->deleted_by = Auth::user()->email;
      $oldData->save();
      $oldData->delete();

      return true;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat Delete Oauth Client');
    }
  }
}
