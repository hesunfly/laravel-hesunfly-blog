@component('admin.component.head')
@endcomponent

<body data-type="widgets">
<script src="/assets/admin/js/theme.js"></script>
<div class="am-g tpl-g">
    <!-- 头部 -->
@component('admin/component/header')
@endcomponent
<!-- 风格切换 -->
@component('admin/component/skin')
@endcomponent
<!-- 侧边导航栏 -->
@component('admin/component/sidebar')
@endcomponent



<!-- 内容区域 -->
    <div class="tpl-content-wrapper">


        <div class="row-content am-cf">
            <div class="widget am-cf">
                <div class="widget-body">
                    <div class="tpl-page-state">
                        <div class="tpl-page-state-title am-text-center tpl-error-title">404</div>
                        <div class="tpl-error-title-info">Page Not Found</div>
                        <div class="tpl-page-state-content tpl-error-content">

                            <p>对不起,没有找到您所需要的页面,可能是URL不确定,或者页面已被移除。</p>
{{--                            <button type="button" class="am-btn am-btn-secondary am-radius tpl-error-btn">Back Home--}}
{{--                            </button>--}}
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@component('admin/component/foot')
@endcomponent

</body>

</html>