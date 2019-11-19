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
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title  am-cf">分类列表</div>
                        </div>
                        <div class="widget-body  am-fr">

                            <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                <div class="am-form-group">
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <button type="button" class="am-btn am-btn-success am-round"
                                                    onclick="location.href='{{ url('/admin/categories/create') }}'">
                                                <span class="am-icon-plus"></span> 新增
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black "
                                       id="example-r">
                                    <thead>
                                    <tr>
                                        <th>名称</th>
                                        <th>文章数</th>
                                        <th>时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $item)
                                        <tr class="gradeX">
                                            <td>{{ $item->category_title }}</td>
                                            <td>{{ $item->articles_count }}</td>
                                            <td>{{ $item->updated_at }}</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{--                                            <tr class="even gradeC">--}}
                                    {{--                                                <td>有适配微信小程序的计划吗</td>--}}
                                    {{--                                                <td>天纵之人</td>--}}
                                    {{--                                                <td>2016-09-26</td>--}}
                                    {{--                                                <td>--}}
                                    {{--                                                    <div class="tpl-table-black-operation">--}}
                                    {{--                                                        <a href="javascript:;">--}}
                                    {{--                                                            <i class="am-icon-pencil"></i> 编辑--}}
                                    {{--                                                        </a>--}}
                                    {{--                                                        <a href="javascript:;" class="tpl-table-black-operation-del">--}}
                                    {{--                                                            <i class="am-icon-trash"></i> 删除--}}
                                    {{--                                                        </a>--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </td>--}}
                                    {{--                                            </tr>--}}

                                    <!-- more data -->
                                    </tbody>
                                </table>
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

<script>
    $(function () {
        // $('#create_button').click(function () {
        //     $('#create-category-modal').modal('open');
        // });

    });
</script>
</body>
</html>
