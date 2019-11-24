<header class="py-5 mb-10">
    <div class="container mx-auto px-5 lg:max-w-screen">
        <div class="flex items-center flex-col lg:flex-row">
            <a href="http://hesunfly.com" target="_blank" class="flex items-center no-underline text-brand">
                <img src="/assets/images/Hesunfly-Blog-Logo.png" class="w-16">
            </a>
            <div class="lg:ml-auto mt-10 lg:mt-0 flex items-center" style="font-size: 1.3rem">
                <div>
                    <a href="{{ url('/') }}" class="no-underline hover:underline uppercase">文章</a>
                    @foreach($pages as $item)
                        <a href="{{ url('/pages') . '/' . $item->slug }}"
                           class="ml-5 no-underline hover:underline uppercase">{{ $item->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>
