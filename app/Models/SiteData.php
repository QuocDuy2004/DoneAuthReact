<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteData extends Model
{
    use HasFactory;

    protected $table = 'site_data';

    // Định nghĩa các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'namesite',
        'logo',
        'landing',
        'effect',
        'logo_mini',
        'favicon',
        'title',
        'description',
        'keyword',
        'image_seo',
        'notice',
        'collaborator',
        'agency',
        'distributor',
        'code_tranfer',
        'facebook',
        'zalo',
        'youtube',
        'telegram',
        'phone',
        'email',
        'card_discount',
        'min_recharge',
        'recharge_promotion',
        'show_promotion',
        'start_promotion',
        'end_promotion',
        'partner_id',
        'partner_key',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'google_client_id',
        'google_client_secret',
        'google_redirect',
        'facebook_client_id',
        'facebook_client_secret',
        'facebook_redirect',
        'balance_telegram',
        'telegram_bot',
        'telegram_token',
        'telegram_chat_id',
        'telegram_callback',
        'notice_order',
        'notice_login',
        'script_header',
        'script_footer',
        'is_admin',
        'token_web',
        'username_web',
        'status',
        'domain',
        'nameadmin',
        'idpage',
        'site_key',
        'secret_key',
        'telegram_token_tb',
    ];

    // Định nghĩa các thuộc tính không thể gán hàng loạt (các cột không có trong $fillable)
    protected $guarded = [
        'id', // id thường được bảo vệ, không thể gán hàng loạt
        'created_at',
        'updated_at',
    ];

    // Định nghĩa kiểu dữ liệu của các thuộc tính (nếu cần thiết)
    protected $casts = [
        'collaborator' => 'integer',
        'agency' => 'integer',
        'distributor' => 'integer',
        'card_discount' => 'integer',
        'min_recharge' => 'integer',
        'recharge_promotion' => 'integer',
        'show_promotion' => 'string',
        'start_promotion' => 'string',
        'end_promotion' => 'string',
        'status' => 'string',
    ];

    // Định nghĩa thuộc tính kiểu ngày tháng
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Định nghĩa thuộc tính kiểu văn bản dài
    protected $attributes = [
        'title' => '',
        'description' => '',
        'keyword' => '',
        'image_seo' => '',
        'notice' => '',
        'script_header' => '',
        'script_footer' => '',
        'is_admin' => '',
        'token_web' => '',
        'username_web' => '',
        'site_key' => '',
        'secret_key' => '',
        'telegram_token_tb' => '',
        'nameadmin' => '',
    ];
}
