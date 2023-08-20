<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache as Redis;
class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

  const ROLE_GUEST = 'GUEST';
  const ROLE_ADMIN = 'ADMIN';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['name', 'email', 'password','username'];
  // protected $fillable = [];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = ['password', 'remember_token'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  //

  public function role(): BelongsTo
  {
    return $this->belongsTo(Role::class);
  }

  // public function oauth_access_tokens(): HasMany
  // {
  //   return $this->hasMany(HasApiTokens::class);
  // }
  // merubah supaya login dari username, bukan dari email
  // public function findForPassport(string $username): User
  // {
  //     return $this->where('username', $username)->first();
  // }
  // untuk login passport bisa dari username dan email
  public function findForPassport($identifier) {
      return $this->orWhere('email', $identifier)->orWhere('username', $identifier)->first();
  }
  public static function getPermissionsAttribute(){
      $cache_key = "CachePermissionUser_".Auth::user()->id;
      if (Redis::get($cache_key) != null) {
          return json_decode(Redis::get($cache_key));
      }
      $recpermission = PermissionModel::with(['roles'])->whereHas('roles.users',function ($query) {
          $query->where('id',Auth::user()->id);
      })->get();
      $apermissions = array();
      foreach($recpermission as $record){
          $apermissions[$record->name] = $record->name;
      }
      Redis::set($cache_key, json_encode($apermissions), 'EX', 60 * 60 * 24);
      return $apermissions;
  }
  public static function authPermission($permisison_name){
      
      $aPermission = (array)User::getPermissionsAttribute();
      if(!isset($aPermission[$permisison_name])){
          return abort(403);
      }
      return true;
  }
  public static function checkPermission($permisison_name){
      $aPermission = (array)User::getPermissionsAttribute();
      if(!isset($aPermission[$permisison_name])){
          return false;
      }
      return true;
  }
  public static function setDefaultRole($dataUser){
    $recordRolesUser = new UserRoleModel();
    $recordRolesUser->user_id = $dataUser->id;
    $recordRolesUser->role_id = 2;
    $recordRolesUser->save();
  }
}
