<div class="left-sidebar">
    <!-- 用户信息 -->
    <div class="tpl-sidebar-user-panel" style="padding-top: 80px;">
        <div class="tpl-user-panel-slide-toggleable">
            <div class="tpl-user-panel-profile-picture">
                <img src="/assets/images/avatar.jpg" alt="">
            </div>
            <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
              Hesunfly
          </span>
            <a href="javascript:;" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
        </div>
    </div>

    <!-- 菜单 -->
    <ul class="sidebar-nav">
        <li class="sidebar-nav-heading">文章</li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/write') }}" class="active">
                <i class="am-icon-home sidebar-nav-link-logo"></i> 写作
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/articles') }}">
                <i class="am-icon-table sidebar-nav-link-logo"></i> 文章
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/categories') }}">
                <i class="am-icon-calendar sidebar-nav-link-logo"></i> 分类
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/tags') }}">
                <i class="am-icon-wpforms sidebar-nav-link-logo"></i> 标签

            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/comments') }}">
                <i class="am-icon-bar-chart sidebar-nav-link-logo"></i> 评论

            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/pages') }}">
                <i class="am-icon-bar-chart sidebar-nav-link-logo"></i> 页面

            </a>
        </li>

        <li class="sidebar-nav-heading">资源</li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/members') }}">
                <i class="am-icon-key sidebar-nav-link-logo"></i> 用户
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/images') }}">
                <i class="am-icon-tv sidebar-nav-link-logo"></i> 图片
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/files') }}">
                <i class="am-icon-tv sidebar-nav-link-logo"></i> 文件
            </a>
        </li>

        <li class="sidebar-nav-heading">应用</li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/setting') }}">
                <i class="am-icon-key sidebar-nav-link-logo"></i> 配置
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/others') }}">
                <i class="am-icon-tv sidebar-nav-link-logo"></i> 其他
            </a>
        </li>

    </ul>
</div>