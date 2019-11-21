<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>验证</title>
    <link rel="stylesheet" href="/assets/login/auth.css">
    <link href="/assets/fontawesome-free-5.11.2/css/all.css" rel="stylesheet">
    <script defer src="/assets/fontawesome-free-5.11.2/js/all.js"></script>
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
                        <label>账号 <i class="fas fa-user"></i></label>
                        <input type="text" name="name" id="name" class="lowin-input">
                    </div>
                    <div class="lowin-group password-group">
                        <label>密码 <i class="fas fa-key"></i> <a href="#" class="forgot-link">忘记密码 ?</a></label>
                        <input type="password" name="password" id="password" class="lowin-input">
                    </div>
                    <button class="lowin-btn login-btn" id="login">
                        验证
                    </button>

                    <div class="text-foot">
                        还没有账户? <a href="" class="register-link">注册一个吧！</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="lowin-box lowin-register">
            <div class="lowin-box-inner">
                <form>
                    <p>注册用户</p>
                    <div class="lowin-group">
                        <label>用户名 <i class="fas fa-user"></i></label>
                        <input type="text" name="name" autocomplete="name" class="lowin-input">
                    </div>
                    <div class="lowin-group">
                        <label>邮箱 <i class="fas fa-envelope"></i></label>
                        <input type="email" autocomplete="email" name="email" class="lowin-input">
                    </div>
                    <div class="lowin-group">
                        <label>密码 <i class="fas fa-key"></i></label>
                        <input type="password" name="password" autocomplete="current-password" class="lowin-input">
                    </div>
                    <div class="lowin-group">
                        <label>验证码 <i class="fas fa-key"></i> <a href="#" class="forgot-link">发送验证码</a></label>
                        <input type="password" name="password" autocomplete="current-password" class="lowin-input">
                    </div>
                    <button class="lowin-btn">
                        注册
                    </button>

                    <div class="text-foot">
                        已有账号 <a href="" class="login-link">立即登录</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="lowin-footer">

    </footer>
</div>

<script src="/assets/login/auth.js"></script>
<script src="/assets/jquery.min.js"></script>
<script>
    Auth.init({
        login_url: '#login',
        forgot_url: '#forgot'
    });
</script>
<script>
    $(function () {
        $('#login').click(function () {
            let name = $('#name').val();
            if (name.length === 0) {
                return;
            }
        });
    });
</script>
</body>
</html>