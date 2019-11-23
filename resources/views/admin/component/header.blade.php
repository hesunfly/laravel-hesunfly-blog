<header>
    <!-- logo -->
    <div class="am-fl tpl-header-logo">
        <a href="{{ url('admin/') }}"><img src="/assets/images/Hesunfly-Blog-Logo.png" alt="" style="height: 55px;width: auto;"></a>
    </div>
    <!-- 右侧内容 -->
    <div class="tpl-header-fluid">
        <!-- 侧边切换 -->
        <div class="am-fl tpl-header-switch-button am-icon-list">
                    <span>
                </span>
        </div>
        <!-- 搜索 -->
        <div class="am-fl tpl-header-search">
            <form class="tpl-header-search-form" action="javascript:;">
                <button class="tpl-header-search-btn am-icon-search"></button>
                <input class="tpl-header-search-box" type="text" placeholder="搜索内容...">
            </form>
        </div>
        <!-- 其它功能-->
        <div class="am-fr tpl-header-navbar">
            <ul>
                <li class="am-text-sm">
                    <div class="tpl-user-panel-profile-picture">
                        <img src="/assets/images/avatar.jpg" alt="" class="am-img-bdrs" >
                    </div>
                </li>
                <li class="am-text-sm">
                    <a href="javascript:;" onclick="" style="padding: 0 5px;">
                        <span style="color: #0C0C0C">{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->name }}</span>
                    </a>
                </li>
                <!-- 退出 -->
                <li class="am-text-sm">
                    <a href="javascript:;" onclick="logout()">
                        <span class="am-icon-sign-out"></span> 退出
                    </a>
                </li>
            </ul>
        </div>
    </div>

</header>

<script>
    function logout() {
        axios.delete("{{ url('/admin/logout') }}").then(function (response) {
            layer.msg('注销成功', {
                    icon: 1,
                    time: 1000 //2秒关闭（如果不配置，默认是3秒）
                }, function () {
                    window.location = "{{ url('/admin/login') }}";
                }
            );
        }).catch(function (error) {
            layer.msg('error！', {
                    icon: 2,
                    time: 1000 //2秒关闭（如果不配置，默认是3秒）
                }
            );
        });
    }
</script>