@component('admin.component.head', ['title' => '订阅列表'])
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
                            <div class="widget-title  am-cf">订阅用户</div>
                        </div>
                        <div class="widget-body  am-fr">
                            <div class="am-u-sm-12">
                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black "
                                       id="example-r">
                                    <thead>
                                    <tr>
                                        <th>邮箱</th>
                                        <th>状态</th>
                                        <th>次数</th>
                                        <th>时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($subscribes as $item)
                                        <tr class="gradeX">
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span style="color: green;font-weight: bold;">启用</span>
                                                @else
                                                    <span style="color: #8c8c8c;font-weight: bold;">关闭</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->times }}</td>
                                            <td>{{ $item->created_at->toDatetimeString() }}</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="{{ url('/articles/') . '/' . $item->slug}}" target="_blank"
                                                       style="border: 1px solid orange;color: orange;">
                                                        <i class="am-icon-eye"></i> 查看
                                                    </a>
                                                    <a href="{{ url('/admin/articles/edit') . '/' . $item->id }}">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" onclick="destroy({{ $item->id }})"
                                                       class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="am-u-lg-12 am-cf">

                                <div class="am-cf">
                                    <ul class="am-pagination am-pagination-centered">
                                        @if ($subscribes->currentPage() != 1)
                                            <li class=""><a href="{{ $subscribes->previousPageUrl() }}">«</a></li>
                                        @endif
                                        <li class="am-active"><a href="javascript:;">{{ $subscribes->currentPage() }}</a>
                                        </li>
                                        @if ($subscribes->lastPage() != $subscribes->currentPage())
                                            <li><a href="{{ $subscribes->nextPageUrl() }}" style="margin-left: 5px;">»</a>
                                            </li>
                                        @endif
                                        <li> 共 {{ $subscribes->lastPage() }} 页</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.is_publish').attr('disabled', true);

        $('#search').click(function () {
            search();
        });

        $('#category_select').change(function () {
            search();
        });
    });

    function destroy(id) {
        if (!id) {
            return false;
        }

        layer.confirm('确定删除吗？', {
            title: '⚠️',
            btn: ['删除', '取消'] //按钮
        }, function () {
            axios.delete("{{ url('/admin/articles/destroy') }}" + '/' + id)
                .then(function (response) {
                    layer.msg('删除成功！', {
                            time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                            window.location = "{{ url('/admin/articles/') }}";
                        }
                    );
                })
                .catch(function (error) {
                    layer.msg('error！', {
                            time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                            return false;
                        }
                    );
                });
        });
    }
</script>
@component('admin/component/foot')
@endcomponent


</body>
</html>
