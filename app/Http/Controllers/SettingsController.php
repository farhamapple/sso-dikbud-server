<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\SettingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache as Redis;
class SettingsController extends Controller
{
    public function index()
    {
        Helpers::authPermission('General.Setting.View');
        $statusWa = Helpers::checkStatusWa();
        return view('content/pages/settings/index',
        [
            'menu'=>"settings",
            'title'=>"Setting Aplikasi",
            'subtitle'=>"Setting Aplikasi",
            'title'=>SettingsModel::getData('site.title'),
            'client_name'=>SettingsModel::getData('site.company'),
            'about'=>SettingsModel::getData('site.about'),
            'sumberapi'=>SettingsModel::getData('endpoint.pegawai'),
            'statusWa'=>$statusWa,
            'message'=>"test meesage"
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Helpers::authPermission('General.Setting.View');
        // hapus cache
        $cache_key = "settingCache";
        Redis::delete($cache_key);
        DB::table('settings')->where('name', '=', 'site.title')->update(['value' => $request->sitetitle]);
        DB::table('settings')->where('name', '=', 'endpoint.pegawai')->update(['value' => $request->sumberapi]);
        return response()->json([
            'success' => true,
            'message' => 'Update Berhasil'
        ]);
    }
    public function updateemail(Request $request)
    {
        Helpers::authPermission('General.Setting.View');
        // hapus cache
        $cache_key = "settingCache";
        Redis::delete($cache_key);
        DB::table('settings')->where('name', '=', 'sender_email')->update(['value' => $request->sender_email]);
        DB::table('settings')->where('name', '=', 'smtp_host')->update(['value' => $request->smtp_host]);
        DB::table('settings')->where('name', '=', 'smtp_user')->update(['value' => $request->smtp_user]);
        DB::table('settings')->where('name', '=', 'smtp_pass')->update(['value' => $request->smtp_pass]);
        DB::table('settings')->where('name', '=', 'smtp_port')->update(['value' => $request->smtp_port]);
        DB::table('settings')->where('name', '=', 'smtp_timeout')->update(['value' => $request->smtp_timeout]);
        DB::table('settings')->where('name', '=', 'mailpath')->update(['value' => $request->mailpath]);
        DB::table('settings')->where('name', '=', 'mailtype')->update(['value' => $request->mailtype]);
        DB::table('settings')->where('name', '=', 'protocol')->update(['value' => $request->protocol]);
        return response()->json([
            'success' => true,
            'message' => 'Update Berhasil'
        ]);
    }
    public function updateWa(Request $request)
    {
        Helpers::authPermission('General.Setting.View');
        // hapus cache
        $cache_key = "settingCache";
        Redis::delete($cache_key);
        DB::table('settings')->where('name', '=', 'wa.url')->update(['value' => $request->waurl]);
        DB::table('settings')->where('name', '=', 'wa.token')->update(['value' => $request->watoken]);
        DB::table('settings')->where('name', '=', 'wa.username')->update(['value' => $request->wausername]);
        DB::table('settings')->where('name', '=', 'wa.password')->update(['value' => $request->wapassword]);
        DB::table('settings')->where('name', '=', 'wa.number')->update(['value' => $request->wanumber]);
        DB::table('settings')->where('name', '=', 'wa.templatemessage')->update(['value' => $request->watemplate]);
        return response()->json([
            'success' => true,
            'message' => 'Update Berhasil'
        ]);
    }
    public function testKirim(Request $request){
        // send notif
        $isi_pesan = SettingsModel::getData('wa.templatewo');
        eval("\$isi_pesan = \"$isi_pesan\";");
        $sendWa = true;
        $nomorWa = SettingsModel::getData('wa.number');
        $sendEmail = false;
        $result = Helpers::sendNotif($sendWa,$sendEmail,$nomorWa,$isi_pesan);
        if(!$result){
            return response()->json([
                'success' => $result,
                'message' => 'Kirim gagal'
            ]);
        }
        sleep(1);
        return response()->json([
            'success' => $result,
            'message' => 'Kirim Berhasil'
        ]);
    }

}
