<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Carbon;

class UserService
{
  public function getUserAll()
  {
    try {
      $data = User::get();

      return $data;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat mengambil Data User');
    }
  }

  public function getUserById($id)
  {
    try {
      $data = User::where('id', $id);

      return $data;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat mengambil Data User');
    }
  }

  public function getUserByRef($ref)
  {
    try {
      $data = User::where('ref', $ref);

      return $data;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat mengambil Data User');
    }
  }

  public function saveUserOnlyMandatory($data)
  {
    try {
      //code...
      $newData = new User();
      $newData->name = $data->first_name . ' ' . $data->last_name;
      $newData->email = $data->email;
      $newData->password = bcrypt($data->password);
      $newData->created_at = Carbon::now()->toDateTimeString();
      $newData->updated_at = Carbon::now()->toDateTimeString();
      $newData->username = $data->email;
      $newData->first_name = $data->first_name;
      $newData->last_name = $data->last_name;
      $newData->email_external = '-';
      $newData->address = '-';
      $newData->sex = '1';
      $newData->birth_date = '1990-01-01';
      $newData->identity_type = '0';
      $newData->identity_number = '-';
      $newData->phone = '-';
      $newData->activation_code = Str::uuid();
      $newData->is_active = '0';
      $newData->is_external_account = '1';
      $newData->created_by = $data->email;
      $newData->updated_by = $data->email;
      $newData->is_asn = '0';
      $newData->nip = '-';
      $newData->instansi = '-';
      $newData->jabatan = '-';
      $newData->role_id = '1';
      $newData->ref = Str::uuid();
      $newData->save();
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat Menyimpan Data User');
    }
  }

  public function saveUser($data)
  {
    try {
      //code...
      $newData = new User();
      $newData->name = $data->first_name . ' ' . $data->last_name;
      $newData->email = $data->email;
      $newData->password = bcrypt($data->password);
      $newData->created_at = Carbon::now()->toDateTimeString();
      $newData->updated_at = Carbon::now()->toDateTimeString();
      $newData->username = $data->email;
      $newData->first_name = $data->first_name;
      $newData->last_name = $data->last_name;
      $newData->email_external = $data->email_external;
      $newData->address = $data->address;
      $newData->sex = $data->sex;
      $newData->birth_date = $data->birth_date;
      $newData->identity_type = $data->identity_type;
      $newData->identity_number = $data->identity_number;
      $newData->phone = $data->phone;
      $newData->activation_code = Str::uuid();
      $newData->is_active = $data->is_active;
      $newData->is_external_account = $data->is_external_account;
      $newData->created_by = $data->email;
      $newData->updated_by = $data->email;
      $newData->is_asn = $data->is_asn;
      if ($data->is_asn == '1') {
        $newData->nip = $data->nip;
        $newData->instansi = $data->instansi;
        $newData->jabatan = $data->jabatan;
      }
      $newData->role_id = '1';
      $newData->ref = Str::uuid();
      $newData->save();
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat Menyimpan Data User');
    }
  }
}
