<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    //
    Schema::table('users', function (Blueprint $table) {
      $table->timestamp('deleted_at')->nullable();
      $table->string('created_by')->nullable();
      $table->string('updated_by')->nullable();
      $table->string('deleted_by')->nullable();
      $table->string('username')->nullable();
      $table->string('first_name')->nullable();
      $table->string('last_name')->nullable();
      $table->string('email_external')->nullable();
      $table->string('address')->nullable();
      $table->string('sex')->nullable();
      $table->dateTime('birth_date')->nullable();
      $table->string('identity_type')->default('1');
      $table->string('identity_number')->nullable();
      $table->string('phone')->nullable();
      $table->string('photo_url')->nullable();
      $table->string('avatar_url')->nullable();
      $table->string('activation_code')->nullable();
      $table->timestamp('verified_at')->nullable();
      $table->string('is_active')->default('0');
      $table->string('is_external_account')->default('1');
      $table->string('nip')->nullable();
      $table->string('simpeg_id')->nullable();
      $table
        ->unsignedBigInteger('role_id')
        ->index()
        ->default(1)
        ->nullable();
      $table->uuid('ref')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    //
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('deleted_at');
      $table->dropColumn('created_by');
      $table->dropColumn('updated_by');
      $table->dropColumn('deleted_by');
      $table->dropColumn('username');
      $table->dropColumn('first_name');
      $table->dropColumn('last_name');
      $table->dropColumn('email_external');
      $table->dropColumn('address');
      $table->dropColumn('sex');
      $table->dropColumn('birth_date');
      $table->dropColumn('identity_type');
      $table->dropColumn('identity_number');
      $table->dropColumn('phone');
      $table->dropColumn('photo_url');
      $table->dropColumn('avatar_url');
      $table->dropColumn('activation_code');
      $table->dropColumn('verified_at');
      $table->dropColumn('is_active');
      $table->dropColumn('activation_code');
      $table->dropColumn('is_external_account');
      $table->dropColumn('nip');
      $table->dropColumn('simpeg_id');
      $table->dropColumn('role_id');
      $table->dropColumn('ref');
    });
  }
};
