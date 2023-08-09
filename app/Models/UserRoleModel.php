<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleModel extends Model
{
    protected $table = 'roles_users';
    protected $primaryKey = 'role_user_id';
    public $timestamps = false;
    use HasFactory;
    public function users()
    {
        return $this->belongsTo(User::class,'id');
    }
    public function roles()
    {
        return $this->belongsTo(RolesModel::class,'role_id');
    }
}
