<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    use HasFactory;
    
    public function o_permission(){
        return $this->hasMany(RolePermissionModel::class,'id','role_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class,UserRoleModel::class,'role_id','user_id');
    }
    public function permission()
    {
        return $this->belongsToMany(PermissionModel::class,RolePermissionModel::class,'permissions_id','permissions_id');
    }
}
