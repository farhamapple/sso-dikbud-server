<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'permissions_id';
    public $timestamps = false;
    use HasFactory;
    public function permission(){
        return $this->hasMany(RolePermissionModel::class,'role_id','role_id');
    }
    public function roles()
    {
        return $this->belongsToMany(RolesModel::class,RolePermissionModel::class,'permissions_id','role_id');
    }
}
