@component('admin.component.head', ['title' => 'Hesunfly Blog'])
@endcomponent

<body data-type="index">
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
        <div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-dashboard page-header-heading-icon"></span> 仪表盘
                        <small>Dashboard</small></div>
                </div>
            </div>

        </div>

        <div class="row-content am-cf">
            <div class="row  am-cf">
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                    <div class="widget widget-primary am-cf">
                        <div class="widget-statistic-header" style="font-size: 27px;">
                            文章数量
                        </div>
                        <div class="widget-statistic-body">
                            <div class="widget-statistic-value">
                                {{ $article_count }}
                            </div>

                            <span class="widget-statistic-icon am-icon-file-text-o"></span>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                    <div class="widget widget-primary am-cf">
                        <div class="widget-statistic-header" style="font-size: 27px;">
                            图片数量
                        </div>
                        <div class="widget-statistic-body">
                            <div class="widget-statistic-value">
                                {{ \App\Models\Image::count() }}
                            </div>

                            <span class="widget-statistic-icon am-icon-file-image-o"></span>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                    <div class="widget widget-primary am-cf">
                        <div class="widget-statistic-header" style="font-size: 27px;">
                            浏览次数
                        </div>
                        <div class="widget-statistic-body">
                            <div class="widget-statistic-value">
                                {{ \App\Models\Ip::count() }}
                            </div>

                            <span class="widget-statistic-icon am-icon-eye"></span>
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