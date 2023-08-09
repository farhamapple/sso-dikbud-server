<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermissionModel extends Model
{
    protected $table = 'role_permissions';
    protected $primaryKey = 'role_permissions_id';
    public $timestamps = false;
    public function permission()
    {
        return $this->belongsTo(PermissionModel::class,'permissions_id','permissions_id');
    }
    public function roles()
    {
        return $this->belongsTo(RolesModel::class,'role_id','role_id');
    }
    use HasFactory;
}
