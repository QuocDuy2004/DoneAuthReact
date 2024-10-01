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
        Schema::create('site_data', function (Blueprint $table) {
            $table->id();
            $table->string('namesite');
            $table->string('logo')->nullable();
            $table->string('landing')->default('0');
            $table->string('effect');
            $table->string('logo_mini')->nullable();
            $table->string('favicon')->nullable();
            $table->longText('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('keyword')->nullable();
            $table->longText('image_seo')->nullable();
            $table->longText('notice')->nullable();
            $table->integer('collaborator')->default(0);
            $table->integer('agency')->default(0);
            $table->integer('distributor')->default(0);
            $table->string('code_tranfer')->default('naptien');
            $table->string('facebook')->nullable();
            $table->string('zalo')->nullable();
            $table->string('youtube')->nullable();
            $table->string('telegram')->nullable();
            $table->string('phone')->nullable();
            $table->text('email')->nullable();
            $table->integer('card_discount')->default(0);
            $table->integer('min_recharge')->default(10000);
            $table->integer('recharge_promotion')->default(0);
            $table->string('show_promotion')->default('hide');
            $table->string('start_promotion')->nullable();
            $table->string('end_promotion')->nullable();
            $table->string('partner_id')->nullable();
            $table->string('partner_key')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('google_client_id')->nullable();
            $table->string('google_client_secret')->nullable();
            $table->string('google_redirect')->nullable();
            $table->string('facebook_client_id')->nullable();
            $table->string('facebook_client_secret')->nullable();
            $table->string('facebook_redirect')->nullable();
            $table->string('balance_telegram', 999)->nullable();
            $table->string('telegram_bot', 999)->nullable();
            $table->string('telegram_token', 999)->nullable();
            $table->string('telegram_chat_id', 999)->nullable();
            $table->string('telegram_callback', 999)->nullable();
            $table->string('notice_order')->default('off');
            $table->string('notice_login')->default('off');
            $table->longText('script_header')->nullable();
            $table->longText('script_footer')->nullable();
            $table->text('is_admin')->nullable();
            $table->longText('token_web')->nullable();
            $table->string('username_web')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
            $table->longText('content')->nullable();
            $table->text('site_key')->nullable();
            $table->text('secret_key')->nullable();
            $table->text('telegram_token_tb')->nullable();
            $table->text('nameadmin')->nullable();
            $table->string('idpage')->nullable();
            $table->string('domain');
            
            // Primary key
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
        Schema::dropIfExists('site_data');
    }
};
