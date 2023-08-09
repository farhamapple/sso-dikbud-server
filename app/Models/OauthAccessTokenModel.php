<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OauthAccessTokenModel extends Model
{
    use HasFactory;
    protected $table = 'oauth_access_tokens';
    protected $primaryKey = 'id';
    public function o_users()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
