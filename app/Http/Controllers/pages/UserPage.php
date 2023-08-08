<?php

namespace App\Http\Controllers\pages;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Services\UserServices;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserPage extends Controller
{
  //
  private $userServices;

  public function __construct()
  {
    $this->userServices = new UserServices();
  }

  public function index($is_external_account)
  {
    Helpers::authPermission('Masters.User.View');
    if ($is_external_account == '0') {
      $tipe_user = 'User Internal';
      $usersData = $this->userServices->getInternalAccount();
      return view('content.pages.users.pages-users-internal', compact('usersData', 'tipe_user'));
    } else {
      $tipe_user = 'User Eksternal';
      $usersData = $this->userServices->getEksternalAccount();
      return view('content.pages.users.pages-users-eksternal', compact('usersData', 'tipe_user'));
    }
  }

  public function show(Request $request)
  {
    Helpers::authPermission('Masters.User.View');
    $validator = Validator::make($request->all(), [
      //
      'ref' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();

      return response()->json(['success' => false, 'data' => '', 'message' => $error]);
    }

    try {
      //code...
      $dataUserDetail = $this->userServices->getUserByRef($request->ref);

      return response()->json([
        'success' => true,
        'data' => $dataUserDetail,
        'message' => 'Berhasil Mengambil data user',
      ]);
    } catch (Exception $e) {
      //throw $th;
      return response()->json(['success' => false, 'data' => '', 'message' => $e]);
    }
  }

  public function user_inactive()
  {
    $usersData = $this->userServices->getUserInActive();
    //dd($usersData);
    $tipe_user = 'User Inactive';
    return view('content.pages.users.pages-users-inactive', compact('usersData', 'tipe_user'));
  }

  public function store(Request $request)
  {
    Helpers::authPermission('Masters.User.Create');
    //dd($request->first_name);
    $validator = Validator::make($request->all(), [
      //
      'username' => 'required | unique:users,username',
      'first_name' => 'required',
      'email' => 'required | email | unique:users,email',
      'password' => 'required|min:6',
      'password_confirm' => 'required_with:password|same:password|min:6',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();
      return back()->with('notifikasi-error', $error);
    }

    try {
      $newData = $this->userServices->saveUser($request);

      return back()->with('notifikasi-success', 'User Berhasil ditambahkan');
    } catch (Exception $e) {
      return back()->with('notifikasi-error-try-catch', $e->getMessage());
    }
  }

  public function update(Request $request)
  {
    Helpers::authPermission('Masters.User.Edit');
    $validator = Validator::make($request->all(), [
      //
      'first_name' => 'required',
      'email' => ['required'],
      'ref' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();
      return back()->with('notifikasi-error', $error);
    }

    try {
      $newData = $this->userServices->updateUser($request->ref, $request);

      return back()->with('notifikasi-success', 'User Berhasil diUbah');
    } catch (Exception $e) {
      return back()->with('notifikasi-error-try-catch', $e->getMessage());
    }
  }

  public function goToInActiveUser(Request $request)
  {
    Helpers::authPermission('Masters.User.View');
    $validator = Validator::make($request->all(), [
      //
      'ref' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();

      return response()->json(['success' => false, 'data' => '', 'message' => $error]);
    }

    try {
      $newData = $this->userServices->updateUserToInActive($request->ref);

      return response()->json(['success' => true, 'data' => $newData, 'message' => 'Berhasil Non Aktif User']);
    } catch (Exception $e) {
      return response()->json(['success' => false, 'data' => '', 'message' => $e->getMessage()]);
    }
  }

  public function resendActivation(Request $request)
  {
    Helpers::authPermission('Masters.User.Edit');
    $validator = Validator::make($request->all(), [
      //
      'ref' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();

      return response()->json(['success' => false, 'data' => '', 'message' => $error]);
    }

    try {
      $newActivationcode = $this->userServices->generateActivationCode($request->ref);

      // Send Email

      return response()->json([
        'success' => true,
        'data' => $newActivationcode,
        'message' => 'Berhasil Resend Activation Code',
      ]);
    } catch (Exception $e) {
      return response()->json(['success' => false, 'data' => '', 'message' => $e->getMessage()]);
    }
  }

  public function goToActiveUser(Request $request)
  {
    Helpers::authPermission('Masters.User.Edit');
    $validator = Validator::make($request->all(), [
      //
      'ref' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();

      return response()->json(['success' => false, 'data' => '', 'message' => $error]);
    }

    try {
      $newData = $this->userServices->updateUserToActive($request->ref);

      return response()->json(['success' => true, 'data' => $newData, 'message' => 'Berhasil Aktif User']);
    } catch (Exception $e) {
      return response()->json(['success' => false, 'data' => '', 'message' => $e->getMessage()]);
    }
  }

  public function destroy(Request $request)
  {
    Helpers::authPermission('Masters.User.Delete');
    $validator = Validator::make($request->all(), [
      //
      'ref' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();

      return response()->json(['success' => false, 'data' => '', 'message' => $error]);
    }

    try {
      $deleteData = $this->userServices->deleteUser($request->ref);

      return response()->json(['success' => true, 'data' => $deleteData, 'message' => 'Berhasil Delete User']);
    } catch (Exception $e) {
      return response()->json(['success' => false, 'data' => '', 'message' => $e->getMessage()]);
    }
  }

  public function updatePassword(Request $request)
  {
    $validator = Validator::make($request->all(), [
      //
      'password' => 'required',
      'repeat_password' => ['required'],
      'ref' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();
      return back()->with('notifikasi-error', $error);
    }

    try {
      if ($request->password == $request->repeat_password) {
        $userData = User::where('ref', $request->ref)->first();
        $userData->password = bcrypt($request->password);
        $userData->updated_at = Carbon::now()->toDateTimeString();
        $userData->updated_by = Auth::user()->email;
        $userData->save();

        return back()->with('notifikasi-success', 'Password Berhasil diUbah');
      } else {
        return back()->with('notifikasi-error', 'Password Tidak Sama');
      }
    } catch (Exception $e) {
      return back()->with('notifikasi-error-try-catch', $e->getMessage());
    }
  }
}
