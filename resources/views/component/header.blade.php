<style>
    .divCss{
        display: inline-block;
        margin-left: 1.8rem;
    }
    .pl-8{
        padding: 0;
    }

    @media screen and (max-width: 787px) {
        .divCss{
            display: block;
            margin-top: 30px;
            margin-left: 0;
            width: 90%;
        }
        .pl-8{
            padding: 0;
        }
    }
</style>
<header class="py-5 mb-10">
    <div class="container mx-auto px-5 lg:max-w-screen">
        <div class="flex items-center flex-col lg:flex-row">
            <a href="http://hesunfly.com" target="_blank" class="flex items-center no-underline text-brand">
                <img src="/assets/images/Hesunfly-Blog-Logo.png" class="w-16">
            </a>
            <div class="lg:ml-auto mt-10 lg:mt-0 flex items-center" style="font-size: 1.3rem;">
                <div style="">
                    <a href="{{ url('/') }}" class="no-underline hover:underline uppercase">文章</a>
                    @foreach($pages as $item)
                        <a href="{{ url('/pages') . '/' . $item->slug }}"
                           class="ml-5 no-underline hover:underline uppercase">{{ $item->title }}</a>
                    @endforeach
                    <div class="divCss" style="">
                        <div class="border-t-2 md:border-t-0 md:border-l-2 border-off-white bg-white flex items-center md:justify-end w-full md:w-auto"
                               style="border-bottom: 1px solid #f5f5f5; border-left: 0;border-top: 0; height: 2rem;padding: 20px 6px;background-color: #F5FFFA;">
                            <input id="keyword" type="text" placeholder="搜索" value="{{ $keyword }}" style="background-color: #F5FFFA;"
                                   class="placeholder-red flex-1 py-8 pl-8 md:py-6 focus:outline-none" >
                            <button type="button" id="search" class="block py-8 pr-8 md:py-6 lg:pr-0 focus:outline-none">
                                <svg class="block w-4 h-4 text-grey hover:text-red">
                                    <use xlink:href="#icon-search">
                                        <svg id="icon-search" fill="currentColor" viewBox="0 0 88 88">
                                            <path d="M86.8 81.2L64.1 58.5C69 52.3 72 44.5 72 36 72 16.1 55.9 0 36 0S0 16.1 0 36s16.1 36 36 36c8.5 0 16.3-2.9 22.5-7.9l22.7 22.7C82 87.6 83 88 84 88c1 0 2-.4 2.8-1.2 1.6-1.5 1.6-4.1 0-5.6zM36 64C20.5 64 8 51.5 8 36S20.5 8 36 8s28 12.5 28 28-12.5 28-28 28z"></path>
                                        </svg>
                                    </use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</header>

<script>
    let search = function () {
        let keyword = $('#keyword').val();
        window.location.href = "{{ url('/search/') }}" + '/' + keyword;
    };

    $('#search').click(function () {
        search();
    });

    $('#keyword').keyup(function (event) {
        if (event.which === 13) {
            search();
        }
    });
</script>