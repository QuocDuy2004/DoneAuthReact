<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Tạo cột `id` với kiểu `bigint` và tự động tăng
            $table->string('name')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('email')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('username')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('password')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('balance')->nullable();
            $table->string('type_balance');
            $table->longText('total_recharge')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->longText('total_deduct')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('level')->default('1')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('api_token', 999)->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('ip')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('lang')->default('vn');
            $table->string('avatar', 999)->default('/asset/images/logo.png');
            $table->timestamps(); // Tạo cột `created_at` và `updated_at`
            $table->string('domain')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('telegram_chat_id', 100)->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->longText('facebook')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('status')->default('active')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('email_verified')->default('no')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('telegram_verified')->default('no')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('telegram_notice')->default('no')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('remember_token', 100)->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('referral_link')->nullable();
            $table->string('referral_code')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->longText('referral_money')->nullable();
            $table->string('ref_id')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->timestamp('last_login')->nullable();
            $table->string('position')->default('member')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');

            // Đặt khóa chính
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
