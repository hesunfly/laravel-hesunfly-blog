@component('component.head', ['title' => env('APP_NAME')])
@endcomponent

@component('component.header')
@endcomponent

<div class="container mx-auto px-5 lg:max-w-screen-sm">
    @foreach( $articles as $item)
        <a class="no-underline transition block border border-lighter w-full mb-10 p-5 rounded post-card"
           href="{{ url('article/' . $item['slug'])}}">
            @if (!empty($item['cover_img']))
                <div class="block h-post-card-image bg-cover bg-center bg-no-repeat w-full h-48 mb-5"
                     style="background-image: url({{ $item['cover_img'] }})">
                </div>
            @endif
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
                    <span class="ml-2">{{ $item['view_count'] }}</span>
                    <span class="ml-auto">{{ $item['publish_at'] }}</span>
                </div>
            </div>
        </a>
    @endforeach

    <div class="uppercase flex items-center justify-center flex-1 py-5 font-sans">

        <a href="https://blog.laravel.com/?page=2" rel="next"
           class="block no-underline text-light hover:text-black px-5">Check More Articles</a>
    </div>

</div>

@component('component.footer')
@endcomponent



