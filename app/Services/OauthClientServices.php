<?php

namespace App\Services;

use App\Models\OauthClientModel;
use Exception;

class OauthClientServices
{
  public function __construct()
  {
  }

  public function getAll()
  {
    try {
      //code...
      $data = OauthClientModel::get();

      return $data;
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data Oauth Client ');
    }
  }

  public function getOauthClientById($id)
  {
    try {
      $data = OauthClientModel::where('id', $id);

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
}
