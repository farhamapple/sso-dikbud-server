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
    Schema::table('oauth_clients', function (Blueprint $table) {
      $table->string('updated_by')->nullable();
      $table->timestamp('deleted_at')->nullable();
      $table->string('deleted_by')->nullable();
      $table->uuid('ref')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    //
    Schema::table('oauth_clients', function (Blueprint $table) {
      $table->dropColumn('deleted_at');
      $table->dropColumn('updated_by');
      $table->dropColumn('deleted_by');
      $table->dropColumn('ref');
    });
  }
};
