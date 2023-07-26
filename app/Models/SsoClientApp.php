<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SsoClientApp extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'sso_client_apps';

  protected $fillable = [];
}
