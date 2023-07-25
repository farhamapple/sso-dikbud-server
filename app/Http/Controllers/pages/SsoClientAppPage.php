<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Services\SsoClientAppServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SsoClientAppPage extends Controller
{
  /**
   * Display a listing of the resource.
   */
  private $ssoClientApp;
  public function __construct()
  {
    $this->ssoClientApp = new SsoClientAppServices();
  }
  public function index()
  {
    //
    try {
      //code...
      $dataSsoClientApp = $this->ssoClientApp->getAll();
    } catch (\Throwable $th) {
      //throw $th;
    }

    return view('content.pages.sso-client-app.pages-sso-client-app', compact('dataSsoClientApp'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
    $validator = Validator::make($request->all(), [
      //
      'name' => 'required',
      'link_redirect' => 'required',
      'icon' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->messages();
      return back()->with('notifikasi-error', $error);
    }

    try {
      $newData = $this->ssoClientApp->saveData($request);

      return back()->with('notifikasi-success', 'Data Berhasil ditambahkan');
    } catch (Exception $e) {
      return back()->with('notifikasi-error-try-catch', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
