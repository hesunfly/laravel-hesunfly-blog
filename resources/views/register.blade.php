<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>注册</title>
    <link rel="stylesheet" href="/assets/css/auth.css">
    <link href="/assets/fontawesome-free-5.11.2/css/all.css" rel="stylesheet">
</head>

<body>
<div class="lowin lowin-red">
    <div class="lowin-brand">
        <img src="/assets/images/Hesunfly-Blog-Logo.png" alt="logo">
    </div>
    <div class="lowin-wrapper">
        <div class="lowin-box lowin-register">
            <div class="lowin-box-inner">
                <form>
                    <p>注册用户</p>
                    <div class="lowin-group">
                        <label><i class="fas fa-user"></i> 用户名 </label>
                        <input type="text" name="name" id="name" class="lowin-input">
                    </div>
                    <div class="lowin-group">
                        <label><i class="fas fa-envelope"></i> 邮箱 </label>
                        <input type="email" name="email" id="email" class="lowin-input">
                    </div>
                    <div class="lowin-group">
                        <label><i class="fas fa-key"></i> 密码 </label>
                        <input type="password" name="password" id="password" class="lowin-input">
                    </div>
                    <div class="lowin-group">
                        <label><i class="fas fa-shield-alt"></i> 验证码 <a href="javascript:;" class="forgot-link"
                                                                        id="send_verify_code">发送验证码</a></label>
                        <input type="text" name="verify_code" id="verify_code" class="lowin-input">
                    </div>
                    <button class="lowin-btn" id="submit" type="button">
                        注册
                    </button>

                    <div class="text-foot">
                        已有账号 <a href="{{ url('/login') }}" class="login-link">立即登录</a>
                    </div>
                    <input type="hidden" name="key" id="key" value="">
                    <input type="hidden" name="expired_at" id="expired_at" value="">

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

        $('#send_verify_code').click(function () {
            let email = $('#email').val();
            if (email.length === 0) {
                layer.msg('邮箱不能为空！', {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                    }
                );
                return false;
            }

            axios.get(
                "{{ url('/email_verify_code') }}" + '/' + email
            ).then(function (response) {
                let data = response.data;
                $('#key').val(data.key);
                $('#expired_at').val(data.expired_at);

                layer.msg('验证码发送成功！10分钟内有效！', {
                        icon: 1,
                        time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                        return false;
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
            });
            return false;
        });

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

            let email = $('#email').val();
            if (email.length === 0) {
                layer.msg('邮箱不能为空！', {
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

            let verify_code = $('#verify_code').val();
            if (verify_code.length !== 6) {
                layer.msg('验证码错误！', {
                        icon: 2,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                    }
                );
                return false;
            }

            let key = $('#key').val();

            axios.post(
                "{{ url('/register') }}",
                {
                    'name': name,
                    'email': email,
                    'password': password,
                    'verify_code': verify_code,
                    'key': key
                }
            ).then(function (response) {
                layer.msg('注册成功！', {
                        icon: 1,
                        time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                        return false;
                    }
                );
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
            return false;
        });
    });
</script>
</body>
</html>