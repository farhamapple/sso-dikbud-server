<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;
use App\Models\RolesModel;
use App\Models\UserRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Datatables;
class RolesController extends Controller
{
    public function index(Request $request)
    {
        Helpers::authPermission('Masters.Roles.View');
        $action  = request()->get('action');
        if ($request->ajax()) {
            $query  = RolesModel::with([]);
            $inputs = request()->get('search');
            if (is_array($inputs)) {
                $query->where(function ($query) use ($inputs) {
                    // $query->whereRaw("UPPER('nameQ') LIKE '". strtoupper($inputs['value'])."'"); 
                    $query->whereRaw("LOWER(name) like  '%" . strtolower($inputs['value']) . "%'");
                });
            }
            $query->orderBy('id', 'ASC');
            $totalCount = $query->count();
            $dt = Datatables::of($query);
            $dt->addColumn('id', function ($row) {
                return $row->id;
            });
            $dt->addColumn('name', function ($row) {
                return $row->name;
            });
            $dt->addColumn('description', function ($row) {
                return $row->description;
            });
            
            $dt->addColumn('edit_url', function ($row) {
                return route('roles.setting.edit',$row->ref);
            });
            $dt->addColumn('delete_url', function ($row) {
                return route("roles.setting.delete", $row->ref);
            });
            return $dt->make(true);
        }
        return view('content.pages.roles.index',['menu'=>"settings",'title'=>"Roles",'subtitle'=>"Setting - Daftar Role"]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Helpers::authPermission('Masters.Roles.Create');
        $record = RolesModel::where('ref', $request->ref)->get()->first();
        if(!$record){
            $rules = array(
                'name' => 'required',
            );
        }else{
            $rules = array(
                'name' => 'required',
                'asset_id' => 'required|unique:roles,id,'.$record->id
            );
        }
        $aksi = "Edit data";
        if(!$record){
            $record = new RolesModel();
            $record->ref = Uuid::uuid4()->toString();
            $aksi = "Tambah data";
        }
       
        $recordUser = "";
        $record->name = $request->name;
        $record->description = $request->description;
        
        $record->save();
        

        // end save log
        $data['message'] = 'sukses';
        $data['url'] = "";
        $data['data'] = $record;
        $data['success'] = true;
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Helpers::authPermission('Masters.Roles.Edit');
        //
        $record = RolesModel::with(['permission'])->where("role_id",$id)->get()->first();
        $Permissions           = PermissionModel::with([])->get();
        $arole_name = array();
        foreach($record->permission as $role){
            array_push($arole_name,$role->role_id);
        }
        // dd($arole_name);
        return view('roles/edit',
        [
            'menu'=>"settings",
            'title'=>"Edit Role",
            'subtitle'=>"Users - Edit Role",
            "Permissions"=>$Permissions,
            "record"=>$record
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($ref,Request $request)
    {
        Helpers::authPermission('Masters.Roles.View');
        $record = RolesModel::where("ref",$ref)->get()->first();
        $data['success'] = true;
        $data['data'] = $record;
        
        return response()->json($data, 200);
    }
    public function destroy($ref)
    {
        Helpers::authPermission('Masters.Roles.Delete');
        //
        $record = RolesModel::where("ref",$ref)->get()->first();
        $return = $record->delete();
        if($return){
            UserRoleModel::where('role_id', $record->id)->delete();
        }else{
            $data['message'] = 'Ada kesalahan';
            $data['success'] = false;
            return response()->json($data, 200);
        }
        $data['message'] = 'Role berhasil dihapus';
        $data['success'] = true;
        return response()->json($data, 200);
    }
    public function permissionList($role_id,Request $request)
    {
        $action  = request()->get('action');
        if ($action == 'datatable') {
            return $this->datatablePermisisons($role_id,$request);
        }
    }
    public function datatablePermisisons($role_id,$request)
    {
        $apermissions = $this->permissionRole($role_id);
        $query = PermissionModel::with(['roles']);
        $inputs = request()->post('form_search_values');
        if (is_array($inputs)) {
            foreach ($inputs as $input) {
                if ($input['name'] == 'search') {
                    $query->where(function ($query) use ($input) {
                        $query->where('name', 'ILIKE', '%' . $input['value'] . '%');
                    });
                }
            }
        }
        $query->orderBy('permissions_id', 'ASC');
        $totalCount = $query->count();
        $dt = Datatables::of($query);
        $dt->addColumn('id', function ($row) {
            return $row->permissions_id;
        });
        $dt->addColumn('name', function ($row) {
            return $row->name;
        });
        $dt->addColumn('description', function ($row) {
            return $row->description;
        });
        $dt->addColumn('status', function ($row) {
            return $row->status;
        });
        $dt->addColumn('role_id', function ($row) use ($role_id) {
            return $role_id;
        });
        $dt->addColumn('checklist', function ($row) use ($apermissions) {
            return isset($apermissions[$row->permissions_id]) ? true : false;
        });
        $dt->addColumn('add_url', function ($row) use ($role_id) {
            return route('roles.permissions.add',$role_id);
        });
        $dt->addColumn('delete_url', function ($row)  use ($role_id){
            return route("roles.permissions.delete", $role_id);
        });
        return $dt->make(true);
    }
    private function permissionRole($role_id){
        $result = RolePermissionModel::where("role_id",$role_id)->get();
        $apermisson = array();
        foreach($result as $record){
            $apermisson[$record->permissions_id] = $record->permissions_id;
        }
        return $apermisson;
    }
    public function permissionAdd($role_id,Request $request)
    {   
        $permissions_id  = request()->get('permissions_id');
        $record = RolePermissionModel::where("role_id",$role_id)->where("permissions_id",$permissions_id)->get()->first();
        if(!$record){
            $record = new RolePermissionModel();
        }
        $record->role_id = $role_id;
        $record->permissions_id = $permissions_id;
        $record->save();
        $data['message'] = 'berhasil';
        $data['success'] = true;
        return response()->json($data, 200);
    }
    public function permissionDelete($role_id)
    {
        $permissions_id  = request()->get('permissions_id');
        $record = RolePermissionModel::where("role_id",$role_id)->where("permissions_id",$permissions_id)->get()->first();
        $return = $record->delete();
        if(!$return){
            $data['message'] = 'Ada kesalahan';
            $data['success'] = false;
            return response()->json($data, 200);
        }
        $data['message'] = 'Role berhasil dihapus';
        $data['success'] = true;
        return response()->json($data, 200);
    }
}
