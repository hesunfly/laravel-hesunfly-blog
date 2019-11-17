@component('admin.component.head')
@endcomponent

<body data-type="login">
<script src="/assets/admin/js/theme.js"></script>
<div class="am-g tpl-g">
    <!-- 风格切换 -->
    @component('admin.component.skin')
    @endcomponent
    <div class="tpl-login">
        <div class="tpl-login-content">
            {{--<div class="tpl-login-logo">
            </div>--}}
            <form class="am-form tpl-form-line-form">
                <div class="am-form-group">
                    <input type="text" class="tpl-form-input" id="user-email" name="email"  placeholder="请输入账号">
                </div>
                <div class="am-form-group">
                    <input type="password" class="tpl-form-input" id="user-password" name="password" placeholder="请输入密码">
                </div>
                {{--<div class="am-form-group tpl-login-remember-me">
                    <input id="remember-me" type="checkbox">
                    <label for="remember-me">
                        记住密码
                    </label>
                </div>--}}
                <div class="am-form-group">
                    <button type="button" id="submit"
                            class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">提交
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@component('admin.component.foot')
@endcomponent
<script src="/assets/layer/layer.js"></script>

<script>

    $(function () {
        let validate = validate.validate;
        let string = validate.string;
        let util = validate.util;

        let password = validate(util.isRequired, string.minLength(6), string.maxLength(20));
        let email = validate(util.isRequired, util.isEmail);
        $('#submit').click(function () {
            let user_email = $('#user-email').value();

            console.log(password(user_email));

            return;

            let user_password = $('#user-password').value();
        });

    });
</script>

</body>
</html>