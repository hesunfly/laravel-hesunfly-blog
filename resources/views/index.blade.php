@component('component.head', ['title' => env('APP_NAME')])
@endcomponent

@component('component.header')
@endcomponent

<div class="container mx-auto px-5 lg:max-w-screen-sm">
    @foreach( $articles as $item)
        <a class="no-underline transition block border border-lighter w-full mb-10 p-5 rounded post-card"
           href="{{ url('article/' . $item['slug'])}}">
            <div class="flex flex-col justify-between flex-1">
                <div>
                    <h2 class="font-sans leading-normal block mb-6">
                        {{ $item['title'] }}
                    </h2>

                    <p class="leading-normal mb-6 font-serif leading-loose">
                        {{ $item['description'] }}
                    </p>
                </div>

                <div class="flex items-center text-sm text-light">
                    <span class="ml-2"> <i class="fas fa-eye"></i> {{ $item['view_count'] }} </span>
                    <span style="margin-left: 5px;">{{ $item->category->category_title }}</span>

                    <span class="ml-auto">{{ $item['publish_at'] }}</span>
                </div>
            </div>
        </a>
    @endforeach

    <div class="uppercase flex items-center justify-center flex-1 py-5 font-sans">
        <a href="{{ $articles->previousPageUrl() }}" rel="next"
           class="block no-underline text-light hover:text-black px-5">上一页</a>
        <span class="px-5">{{ $articles->currentPage() }}</span>
        <a href="{{ $articles->nextPageUrl() }}" rel="next"
           class="block no-underline text-light hover:text-black px-5">下一页</a>
    </div>

</div>

@component('component.footer')
@endcomponent



