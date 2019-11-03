@component('mail::message')
#    <center>感谢您访问并注册我的博客，这是您的验证码：</center>

@component('mail::panel')
    <center>{{ $verify_code }}</center>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
