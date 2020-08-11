<?php

namespace App\Listeners;

use App\Events\ArticleUpdate;
use App\Mail\ArticleUpdateEmail;
use App\Models\Subscribe;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendArticleUpdateEmail implements ShouldQueue
{

    public function __construct()
    {

    }

    public function handle(ArticleUpdate $event)
    {
        $subscribe_user = Subscribe::where(['status' => 1])->get();
        Mail::to($subscribe_user)->send(new ArticleUpdateEmail($event->article));
        \Illuminate\Support\Facades\DB::table('subscribes')->where(['status' => 1])->increment('times');
    }
}
