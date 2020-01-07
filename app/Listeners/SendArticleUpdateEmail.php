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
        Mail::to(Subscribe::where(['status' => 1])->get())->send(new ArticleUpdateEmail($event->article));
    }
}
