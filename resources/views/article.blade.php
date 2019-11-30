@component('component.head', ['title' => $article->title])
@endcomponent
@component('component.header', ['pages' => \App\Services\CacheService::getPages()])
@endcomponent
<script src="/assets/admin/js/highlight.min.js"></script>
<link rel="stylesheet" href="/assets/admin/css/github.min.css">
<div class="container mx-auto px-5 lg:max-w-screen-sm" style="padding-bottom: 100px;margin-bottom: 27px;">
    <h1 class="mb-5 font-sans">{{ $article->title }}</h1>

    <div class="flex items-center text-sm text-light">
        <span>{{ $article->publish_at }}</span>
        <span style="margin-left: 1rem"><i class="fas fa-folder"></i> {{ $article->category->category_title }}</span>
        <span style="margin-left: 1rem"><i class="fas fa-eye"></i> {{ $article->view_count }}</span>
        @if (\Illuminate\Support\Facades\Auth::guard('web')->id() == 1)
            <span style="margin-left: 2rem">
                <a href="{{ url('/admin/articles/edit/') . '/' . $article->id }}" target="_blank" style="text-decoration: none;">
                编辑文章
                </a>
            </span>
        @endif
    </div>


    <div class="mt-5 leading-loose flex flex-col justify-center items-center post-body font-serif">
        {!! $article->html_content !!}
    </div>
</div>

@component('component.footer')
@endcomponent