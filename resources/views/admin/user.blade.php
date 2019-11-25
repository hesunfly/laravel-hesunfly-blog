@component('admin.component.head', ['title' => '用户编辑'])
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
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">编辑信息</div>
                        </div>
                        <div class="widget-body am-fr">

                            <form class="am-form tpl-form-line-form">
                                <div class="am-form-group">
                                    <label for="name" class="am-u-sm-3 am-form-label">用户名 <small><span
                                                    style="color: red;">*</span></small>
                                        <span
                                                class="tpl-form-line-small-title">Name</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" id="name"
                                               name="name" autofocus placeholder="请输入用户名"
                                               value="{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->name }}">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="email" class="am-u-sm-3 am-form-label">邮箱 <small><span
                                                    style="color: red;">*</span></small>
                                        <span
                                                class="tpl-form-line-small-title">Email</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="email" class="tpl-form-input" id="email"
                                               name="email" autofocus placeholder="请输入邮箱"
                                               value="{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->email }}">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="password" class="am-u-sm-3 am-form-label">密码 <small><span
                                                    style="color: red;">*</span></small> <span
                                                class="tpl-form-line-small-title">Password</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="password" class="tpl-form-input" id="password"
                                               name="password" autofocus placeholder="请输入密码"
                                               value="{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->password }}">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success "
                                                id="submit">提交
                                        </button>
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
@component('admin/component/foot')
@endcomponent


<script>

    $(function () {
        $('#submit').click(function () {
            let name = $('#name').val();
            if (name.length === 0) {
                layer.msg('Name 为必填项！', {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                    }
                );
                return;
            }

            let email = $('#email').val();
            if (email.length === 0) {
                layer.msg('Email 为必填项！', {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                    }
                );
                return;
            }

            let password = $('#password').val();
            if (name.length < 6) {
                layer.msg('Password 格式错误！', {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                    }
                );
                return;
            }

            axios.put(
                "{{ url('/admin/user')}}",
                {
                    'name': name,
                    'email': email,
                    'password': password,
                }
            ).then(function (response) {
                layer.msg('修改成功！', {
                        icon: 1,
                        time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                        window.location = "{{ url('/admin') }}";
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