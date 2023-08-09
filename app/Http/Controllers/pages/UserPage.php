<?php

namespace App\Http\Controllers\pages;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserServices;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Datatables;

class UserPage extends Controller
{
  //
  private $userServices;

  public function __construct()
  {
    $this->userServices = new UserServices();
  }

  public function index(Request $request)
  {
    Helpers::authPermission('Masters.User.View');
    return view('content.pages.users.pages-users-internal');
  }
  public function getDatatableUser(Request $request){
    Helpers::authPermission('Masters.User.View');
      $query  = User::orderBy('id', 'ASC');
      $inputs = request()->get('search');
      if (is_array($inputs)) {
        $query->where(function ($query) use ($inputs) {
            $keyword = $inputs['value'];
            $query->whereRaw('lower("name") like (?)',["%{$keyword}%"])->orWhereRaw('"nip" like (?)',["%{$keyword}%"]); 
        });
      }
      $query->orderBy('id', 'ASC');
      $dt = Datatables::of($query);
      $dt->addColumn('id', function ($row) {
        return $row->id;
      });
      $dt->addColumn('ref', function ($row) {
        return $row->ref;
      });
      $dt->addColumn('name', function ($row) {
        return $row->name;
      });
      $dt->addColumn('username', function ($row) {
        return $row->username;
      });
      $dt->addColumn('phone', function ($row) {
        return $row->phone;
      });
      $dt->addColumn('email', function ($row) {
        return $row->email;
      });
      $dt->addColumn('created_at', function ($row) {
        return $row->created_at;
      });
      $dt->addColumn('updated_at', function ($row) {
        return $row->updated_at;
      });
      return $dt->make(true);
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
