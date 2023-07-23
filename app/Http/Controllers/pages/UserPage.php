<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserPage extends Controller
{
  //
  public function index($is_external_account)
  {
    $usersData = User::where('is_external_account', $is_external_account)
      ->where('is_active', '1')
      ->get();
    if ($is_external_account == '0') {
      $tipe_user = 'User Internal';
    } else {
      $tipe_user = 'User Eksternal';
    }

    return view('content.pages.users.pages-users', compact('usersData', 'tipe_user'));
  }

  public function user_inactive()
  {
    $usersData = User::where('is_active', '0')->get();
    $tipe_user = 'User Inactive';
    return view('content.pages.users.pages-users-inactive', compact('usersData', 'tipe_user'));
  }

  public function store(Request $request)
  {
    dd($request->all());

    try {
      // $file = $request->File('path_sk_pemenang') ? $request->File('path_sk_pemenang')->store("storage-file", "public") : null;
      // $request['path_sk_pemenang'] = $file;
      // $result = $this->eventJadwalService->saveEventJadwal($request);

      return redirect()
        ->route('admin.jadwal.index')
        ->with('notifikasi-success', 'Data berhasil dibuat');
    } catch (Exception $e) {
      return back()->with('notifikasi-error', $e->getMessage());
    }
  }
}
