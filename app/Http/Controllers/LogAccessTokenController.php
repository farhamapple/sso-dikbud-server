<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\OauthAccessTokenModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LogAccessTokenController extends Controller
{
    public function index(Request $request)
    {
        Helpers::authPermission('LogAccess.View');
        $action  = request()->get('action');
        if ($request->ajax()) {
            $query  = OauthAccessTokenModel::with(['o_users']);
            $inputs = request()->get('search');
            if (is_array($inputs)) {
                $query->where(function ($query) use ($inputs) {
                    $keyword = $inputs['value'];
                    $query->whereRaw('lower("name") like (?)',["%{$keyword}%"]); 
                });
            }
            $query->orderBy('id', 'ASC');
            $totalCount = $query->count();
            $dt = DataTables::of($query);
            $dt->addColumn('id', function ($row) {
                return $row->id;
            });
            $dt->addColumn('name', function ($row) {
                return $row->name;
            });
            $dt->addColumn('username', function ($row) {
                return $row->o_users ? $row->o_users->username : null;
            });
            $dt->addColumn('revoked', function ($row) {
                return $row->revoked;
            });
            $dt->addColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->isoFormat('D MMMM Y H:I:s');
            });
            $dt->addColumn('delete_url', function ($row){
                return route("sso-log-access.delete", $row->id);
            });
            return $dt->make(true);
        }
        return view('content.pages.oauth-client.log-access',['menu'=>"Log",'title'=>"Log Akses",'subtitle'=>"Log - Akses"]);
    }
    public function destroy($ref)
    {
        Helpers::authPermission('LogAccess.View');
        $record = OauthAccessTokenModel::where("id",$ref)->get()->first();
        $record->delete();
        $data['message'] = 'Role berhasil dihapus';
        $data['success'] = true;
        return response()->json($data, 200);
    }
}
