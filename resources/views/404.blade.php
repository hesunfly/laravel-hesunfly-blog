@component('component.head', ['title' => env('APP_NAME')])
@endcomponent

@component('component.header', ['pages' => $pages])
@endcomponent

<div style="text-align: center !important; margin-top: 100px;box-sizing: border-box;">
    <div style="font-weight: bold;font-size: 177px;box-sizing: border-box;">404</div>
    <div style="font-size: 50px;box-sizing: border-box;">Page Not Found</div>
</div>


@component('component.footer')
@endcomponent
