<?php

namespace App\Models;

use App\Http\Controllers\Web\Admin\SettingController;

class Setting extends \Illuminate\Database\Eloquent\Model
{

    protected $fillable = [];

    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];

    public static $setting_title = [
        'page_size' => [
            'title' => '首页分页数',
            'en_title' => 'Front Page Size',
            'default' => '15',
        ],
        'admin_page_size' => [
            'title' => '管理端分页数',
            'en_title' => 'Backend Page Size',
            'default' => '15',

        ],
        'icp_record' => [
            'title' => '备案号',
            'en_title' => 'ICP Info',
            'default' => '',

        ],
        'reward_code_img' => [
            'title' => '赞赏收款码',
            'en_title' => 'Reward Code Img',
            'default' => '/assets/images/reward_code_img.png',

        ],
        'email' => [
            'title' => '邮箱',
            'en_title' => 'Email',
            'default' => 'hesunfly_blog@163.com',

        ],
        'github' => [
            'title' => 'github地址',
            'en_title' => 'Github',
            'default' => 'https://github.com/hesunfly',

        ],
        'gitee' => [
            'title' => '码云地址',
            'en_title' => 'Gitee',
            'default' => 'https://gitee.com/hesunfly',

        ],
        'logo_img' => [
            'title' => '网站logo',
            'en_title' => 'Logo Img',
            'default' => '/assets/images/Hesunfly-Blog-Logo.png',
        ],
        'qr_img' => [
            'title' => '文章二维码水印图',
            'en_title' => 'Article Qr Img',
            'default' => '/assets/images/hesunfly-qr.png',
        ]
    ];


    public function __construct()
    {
        parent::__construct();
        $this->fillable = array_keys(self::$setting_title);
    }
}
