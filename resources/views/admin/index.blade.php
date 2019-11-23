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

                            <span class="widget-statistic-icon am-icon-credit-card-alt"></span>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                    <div class="widget widget-primary am-cf">
                        <div class="widget-statistic-header" style="font-size: 27px;">
                            浏览量
                        </div>
                        <div class="widget-statistic-body">
                            <div class="widget-statistic-value">
                                {{ $article_count }}
                            </div>

                            <span class="widget-statistic-icon am-icon-credit-card-alt"></span>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                    <div class="widget widget-primary am-cf">
                        <div class="widget-statistic-header" style="font-size: 27px;">
                            用户数
                        </div>
                        <div class="widget-statistic-body">
                            <div class="widget-statistic-value">
                                {{ $article_count }}
                            </div>

                            <span class="widget-statistic-icon am-icon-credit-card-alt"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row am-cf">
                <div class="am-u-sm-12 am-u-md-8">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">月度财务收支计划</div>
                            <div class="widget-function am-fr">
                                <a href="javascript:;" class="am-icon-cog"></a>
                            </div>
                        </div>
                        <div class="widget-body-md widget-body tpl-amendment-echarts am-fr" id="tpl-echarts">

                        </div>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-4">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">专用服务器负载</div>
                            <div class="widget-function am-fr">
                                <a href="javascript:;" class="am-icon-cog"></a>
                            </div>
                        </div>
                        <div class="widget-body widget-body-md am-fr">

                            <div class="am-progress-title">CPU Load <span class="am-fr am-progress-title-more">28% / 100%</span>
                            </div>
                            <div class="am-progress">
                                <div class="am-progress-bar" style="width: 15%"></div>
                            </div>
                            <div class="am-progress-title">CPU Load <span class="am-fr am-progress-title-more">28% / 100%</span>
                            </div>
                            <div class="am-progress">
                                <div class="am-progress-bar  am-progress-bar-warning" style="width: 75%"></div>
                            </div>
                            <div class="am-progress-title">CPU Load <span class="am-fr am-progress-title-more">28% / 100%</span>
                            </div>
                            <div class="am-progress">
                                <div class="am-progress-bar am-progress-bar-danger" style="width: 35%"></div>
                            </div>
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