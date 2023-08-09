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
    Schema::create('roles', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->uuid('ref')->nullable();
      $table->string('description')->nullable();
      $table->string('is_default')->nullable();
      $table->string('can_delete')->nullable();
      $table->string('login_destination')->nullable();
      $table->timestamps();
      $table->timestamp('deleted_at')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('roles');
  }
};
