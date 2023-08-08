<?php

namespace App\Http\Controllers\pages;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\OauthClientModel;
use App\Services\OauthClientServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OauthClientPage extends Controller
{
  //
  private $oauthClientService;
  public function __construct()
  {
    $this->oauthClientService = new OauthClientServices();
  }
  public function index()
  {
    Helpers::authPermission('Masters.OauthClient.View');
    try {
      //code...
      $oauthClientData = $this->oauthClientService->getAll();
    } catch (Exception $e) {
      //throw $th;
    }
    // dd($oauthClientData);
    return view('content.pages.oauth-client.pages-oauth-client', compact('oauthClientData'));
  }

  public function store(Request $request)
  {
    Helpers::authPermission('Masters.OauthClient.Create');
    // dd($request->all());
    $validator = Validator::make($request->all(), [
      //
      'name' => 'required',
      'redirect' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();
      return back()->with('notifikasi-error', $error);
    }

    try {
      $newData = $this->oauthClientService->saveData($request);

      return back()->with('notifikasi-success', 'Data Berhasil ditambahkan');
    } catch (Exception $e) {
      return back()->with('notifikasi-error-try-catch', $e->getMessage());
    }
  }

  public function edit(Request $request)
  {
    $validator = Validator::make($request->all(), [
      //
      'id' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();

      return response()->json(['success' => false, 'data' => '', 'message' => $error]);
    }

    try {
      //code...
      $dataOauthClientDetail = $this->oauthClientService->getOauthClientById($request->id);

      return response()->json([
        'success' => true,
        'data' => $dataOauthClientDetail,
        'message' => 'Berhasil Mengambil data Oauth Client',
      ]);
    } catch (Exception $e) {
      //throw $th;
      return response()->json(['success' => false, 'data' => '', 'message' => $e]);
    }
  }

  public function update(Request $request)
  {
    //dd($request->all());
    $validator = Validator::make($request->all(), [
      //
      'id' => 'required',
      'name' => 'required',
      'redirect' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();
      return back()->with('notifikasi-error', $error);
    }

    try {
      $newData = $this->oauthClientService->update($request, $request->id);

      return back()->with('notifikasi-success', 'Data Berhasil diUbah');
    } catch (Exception $e) {
      return back()->with('notifikasi-error-try-catch', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    $validator = Validator::make($request->all(), [
      //
      'id' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();

      return response()->json(['success' => false, 'data' => '', 'message' => $error]);
    }

    try {
      $deleteData = $this->oauthClientService->delete($request->id);

      return response()->json(['success' => true, 'data' => $deleteData, 'message' => 'Berhasil Delete Oauth Client']);
    } catch (Exception $e) {
      return response()->json(['success' => false, 'data' => '', 'message' => $e->getMessage()]);
    }
  }
}
