<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserServices
{
  public function __construct()
  {
  }

  public function getUserAll()
  {
    try {
      $data = User::get();

      return $data;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat mengambil Data User');
    }
  }

  public function getEksternalAccount()
  {
    try {
      $data = User::where('is_external_account', '1')
        ->where('is_active', '1')
        ->orderBy('updated_at', 'DESC')
        ->get();

      return $data;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat mengambil Data User');
    }
  }

  public function getInternalAccount()
  {
    try {
      $data = User::where('is_external_account', '0')
        ->where('is_active', '1')
        ->orderBy('updated_at', 'DESC')
        ->get();

      return $data;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat mengambil Data User');
    }
  }

  public function getUserActive()
  {
    try {
      $data = User::where('is_active', '1')->get();

      return $data;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat mengambil Data User');
    }
  }

  public function getUserInActive()
  {
    try {
      $data = User::where('is_active', '0')->get();

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
      $data = User::where('ref', $ref)->first();

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
      $newData->username = $data->username ? $data->username : $data->email;
      $newData->first_name = $data->first_name;
      $newData->last_name = $data->last_name;
      $newData->email_external = '-';
      $newData->address = '-';
      $newData->sex = '1';
      $newData->birth_date = '1990-01-01';
      $newData->identity_type = 'KTP';
      $newData->identity_number = '-';
      $newData->phone = '-';
      $newData->activation_code = Str::uuid();
      $newData->is_active = '0';
      $newData->is_external_account = '1';
      $newData->created_by = $newData->username;
      $newData->updated_by = $newData->email;
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
      $newData->username = $data->username ? $data->username : $data->email;
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
      // Cek Jika Keynya ada
      isset($data->is_active) ? ($is_active = '1') : ($is_active = '0');
      $newData->is_active = $is_active;
      isset($data->is_external_account) ? ($is_external_account = '1') : ($is_external_account = '0');
      $newData->is_external_account = $is_external_account;

      $newData->created_by = $newData->username;
      $newData->updated_by = $newData->username;
      if (isset($data->is_asn)) {
        $newData->is_asn = '1';
        $newData->nip = $data->nip;
        $newData->instansi = $data->instansi;
        $newData->jabatan = $data->jabatan;
      } else {
        $newData->is_asn = '0';
      }
      $newData->role_id = '1';
      $newData->ref = Str::uuid();
      $newData->save();

      return $newData;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat Menyimpan Data User');
    }
  }

  public function updateUser($ref, $data)
  {
    try {
      $oldData = User::where('ref', $ref)->first();
      $oldData->name = $data->first_name . ' ' . $data->last_name;
      $oldData->email = $data->email;
      $data->password ? ($oldData->password = bcrypt($data->password)) : '';
      // $oldData->password = bcrypt($data->password);
      $oldData->updated_at = Carbon::now()->toDateTimeString();
      $oldData->updated_by = Auth::user()->email;
      $oldData->username = $data->username ? $data->username : $data->email;
      $oldData->first_name = $data->first_name;
      $oldData->last_name = $data->last_name;
      $oldData->email_external = $data->email_external;
      $oldData->address = $data->address;
      $oldData->sex = $data->sex;
      $oldData->birth_date = $data->birth_date;
      $oldData->identity_type = $data->identity_type;
      $oldData->identity_number = $data->identity_number;
      $oldData->phone = $data->phone;

      isset($data->is_active) ? ($is_active = '1') : ($is_active = '0');
      $oldData->is_active = $is_active;
      isset($data->is_external_account) ? ($is_external_account = '1') : ($is_external_account = '0');
      $oldData->is_external_account = $is_external_account;

      if (isset($data->is_asn)) {
        $oldData->is_asn = '1';
        $oldData->nip = $data->nip;
        $oldData->instansi = $data->instansi;
        $oldData->jabatan = $data->jabatan;
      } else {
        $oldData->is_asn = '0';
      }
      $oldData->role_id = '1';
      $oldData->save();

      return $oldData;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat Update User');
    }
  }

  public function updateUserToInActive($ref)
  {
    try {
      $oldData = User::where('ref', $ref)->first();
      $oldData->is_active = '0';
      $oldData->updated_by = Auth::user()->email;
      $oldData->updated_at = Carbon::now()->toDateTimeString();
      $oldData->save();

      return $oldData;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat Non Aktiv User');
    }
  }

  public function updateUserToActive($ref)
  {
    try {
      $oldData = User::where('ref', $ref)->first();
      $oldData->is_active = '1';
      $oldData->updated_by = Auth::user()->email;
      $oldData->updated_at = Carbon::now()->toDateTimeString();
      $oldData->save();

      return $oldData;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat Aktif User');
    }
  }

  public function deleteUser($ref)
  {
    try {
      $oldData = User::where('ref', $ref)->first();
      $oldData->deleted_by = Auth::user()->email;
      $oldData->save();
      $oldData->delete();

      return true;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat Delete User');
    }
  }

  public function generateActivationCode($ref)
  {
    try {
      $oldData = User::where('ref', $ref)->first();
      $oldData->activation_code = Str::uuid();
      $oldData->updated_by = Auth::user()->email;
      $oldData->updated_at = Carbon::now()->toDateTimeString();
      $oldData->save();

      return $oldData->activation_code;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat Generated Activation Code');
    }
  }

  public function changePassword($password, $activation_code)
  {
    try {
      $userData = User::where('activation_code', $activation_code)->first();
      $userData->password = bcrypt($password);
      $userData->updated_at = Carbon::now()->toDateTimeString();
      $userData->updated_by = $userData->email;
      $userData->save();

      return $userData;
    } catch (Exception $e) {
      throw new Exception('Terjadi Kesalahan saat Generated Activation Code');
    }
  }
}
