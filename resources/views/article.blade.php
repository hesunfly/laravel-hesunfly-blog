@component('component.head', ['title' => $article->title])
@endcomponent

@component('component.header')
@endcomponent

<div class="container mx-auto px-5 lg:max-w-screen-sm mt-20">
    <h1 class="mb-5 font-sans">{{ $article->title }}</h1>

    <div class="flex items-center text-sm text-light">
        <span>{{ $article->publish_at }}</span>
        <a href="https://blog.laravel.com/releases" class="text-muted">#releases</a>
    </div>

    <div class="mt-5 leading-loose flex flex-col justify-center items-center post-body font-serif">
        {{--        <p>{{ $article->description }}</p>--}}

        {!! $article->html_content !!}

    </div>
</div>

@component('component.footer')
@endcomponent