@component('component.head', ['title' => env('APP_NAME')])
@endcomponent

@component('component.header', ['pages' => \App\Services\CacheService::getPages()])
@endcomponent

<div class="container mx-auto px-5 lg:max-w-screen-sm" style="padding-bottom: 100px;">
    @foreach( $articles as $item)
        <a class="no-underline transition block border border-lighter w-full mb-10 p-5 rounded post-card"
           href="{{ url('articles/' . $item->slug)}}">
            <div class="flex flex-col justify-between flex-1">
                <div>
                    <h2 class="font-sans leading-normal block mb-6">
                        {{ $item->title }}
                    </h2>

                    <p class="leading-normal mb-6 font-serif leading-loose">
                        {{ $item->description }}
                    </p>
                </div>

                <div class="flex items-center text-sm text-light">
                    <span style="margin-left: 5px;"> <i class="fas fa-folder"></i> {{ $item->category->category_title }}</span>
                    &nbsp;&nbsp;
                    <span class="ml-2"> <i class="fas fa-eye"></i> {{ $item->view_count }} </span>
                    <span class="ml-auto">{{ $item->publish_at}}</span>
                </div>
            </div>
        </a>
    @endforeach

    <div class="uppercase flex items-center justify-center flex-1 py-5 font-sans" style="margin-bottom: 27px;">
        @if ($articles->currentPage() != 1)
            <a href="{{ $articles->previousPageUrl() }}" rel="next"
               class="block no-underline text-light hover:text-black px-5">上一页</a>
        @else
            <a href="javascript:;" rel="next"
               class="block no-underline text-light hover:text-black px-5"></a>
        @endif
        <span class="px-5">{{ $articles->currentPage() }}</span>
        @if ($articles->lastPage() != $articles->currentPage())
            <a href="{{ $articles->nextPageUrl() }}" rel="next"
               class="block no-underline text-light hover:text-black px-5">下一页</a>
        @else
            <a href="javascript:;" rel="next"
               class="block no-underline text-light hover:text-black px-5"></a>
        @endif
    </div>

</div>

@component('component.footer')
@endcomponent



