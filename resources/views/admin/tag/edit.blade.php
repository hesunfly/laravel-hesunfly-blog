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
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">

                    <div class="row">

                        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                            <div class="widget am-cf">
                                <div class="widget-head am-cf">
                                    <div class="widget-title am-fl">编辑标签</div>
                                </div>
                                <div class="widget-body am-fr">

                                    <form class="am-form tpl-form-line-form">
                                        <div class="am-form-group">
                                            <label for="user-name" class="am-u-sm-3 am-form-label">标签名称 <span class="tpl-form-line-small-title">Tag Title</span></label>
                                            <div class="am-u-sm-9">
                                                <input type="text" class="tpl-form-input" id="tag_title" placeholder="请输入标签名称" value="{{ $tag_title }}">
                                                <small><span style="color: red;">*</span></small>
                                            </div>
                                        </div>

                                        <div class="am-form-group">
                                            <div class="am-u-sm-9 am-u-sm-push-3">
                                                <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success " id="submit">提交</button>
                                            </div>
                                        </div>
                                    </form>
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
            $('#submit').click(function () {
                let tag_title = $('#tag_title').val();
                if (tag_title.length === 0) {
                    layer.msg('Tag Title 为必填项！', {
                            icon: 2,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                        }
                    );
                    return;
                }

                axios.put(
                    "{{ url('/admin/tags/save/') . '/' . $id }}",
                    {
                        'title': tag_title
                    }
                ).then(function (response) {
                    layer.msg('编辑成功！', {
                            icon: 1,
                            time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                            window.location = "{{ url('/admin/tags') }}";
                        }
                    );
                }).catch(function (error) {
                    layer.msg('error！', {
                            icon: 2,
                            time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                            return false;
                        }
                    );
                    if (error.request.status === 422) {
                        let msg = JSON.parse(error.request.responseText);
                        let errors = msg.errors;
                        let length = errors.length;
                        // if (errors.email[0]);
                    }
                });
            });
        });

    </script>

</body>

</html>