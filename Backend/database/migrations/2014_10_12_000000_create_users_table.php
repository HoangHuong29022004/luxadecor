<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('role')->default(1)->comment('Vai trò của người dùng');
            $table->tinyInteger('status')->default(1)->comment('Trạng thái của người dùng');
            $table->string('password');
            $table->boolean('is_admin')->default(false)->comment('Người dùng là admin hay không');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes()->comment('Ngày xóa mềm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
