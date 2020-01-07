<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //文章更新
        'App\Events\ArticleUpdate' => [
            'App\Listeners\SendArticleUpdateEmail',
        ],
        //订阅成功
        'App\Events\EmailSubscribeSuccess' => [
            'App\Listeners\SendEmailSubscribeSuccessEmail',
        ],
        //订阅确认
        'App\Events\EmailSubscribeConfirm' => [
            'App\Listeners\SendEmailSubscribeConfirmEmail',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
