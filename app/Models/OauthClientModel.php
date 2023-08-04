<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OauthClientModel extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'oauth_clients';
  protected $casts = [
    'id' => 'string', // or 'uuid'
    // other attributes
  ];
}
