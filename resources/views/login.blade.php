<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>登录</title>
    <link rel="stylesheet" href="/assets/login/auth.css">
    <link href="/assets/fontawesome-free-5.11.2/css/all.css" rel="stylesheet">

</head>

<body>
<div class="lowin lowin-red">
    <div class="lowin-brand">
        <img src="/assets/images/Hesunfly-Blog-Logo.png" alt="logo">
    </div>
    <div class="lowin-wrapper">
        <div class="lowin-box lowin-login">
            <div class="lowin-box-inner">
                <form>
                    <p>登录</p>
                    <div class="lowin-group">
                        <label><i class="fas fa-user"></i> 用户名/邮箱 </label>
                        <input type="text" name="name" id="name" class="lowin-input">
                    </div>
                    <div class="lowin-group password-group">
                        <label><i class="fas fa-key"></i> 密码 <a href="#" class="forgot-link">忘记密码 ?</a></label>
                        <input type="password" name="password" id="password" class="lowin-input">
                    </div>
                    <button class="lowin-btn login-btn" id="submit" type="button">
                        登录
                    </button>

                    <div class="text-foot">
                        还没有账户? <a href="{{ url('/register') }}" class="register-link">注册一个吧！</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/assets/jquery.min.js"></script>
<script defer src="/assets/fontawesome-free-5.11.2/js/all.js"></script>
<script src="/assets/layer/layer.js"></script>
<script src="/assets/axios.min.js"></script>
<script>
    $(function () {
        $('#submit').click(function () {
            let name = $('#name').val();
            if (name.length === 0) {
                layer.msg('账户不能为空！', {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                    }
                );
                return false;
            }

            let password = $('#password').val();
            if (password.length < 6) {
                layer.msg('密码格式错误！', {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                    }
                );
                return false;
            }

            axios.post(
                "{{ url('/login') }}",
                {
                    'name': name,
                    'password': password
                }
            ).then(function (response) {
                window.location = "{{ url('/') }}";
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
            return  false;
        });
    });
</script>
</body>
</html>