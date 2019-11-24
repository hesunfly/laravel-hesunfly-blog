<div class="left-sidebar" style="min-height: 82%;">
    <!-- 菜单 -->
    <ul class="sidebar-nav">
        <li class="sidebar-nav-heading">文章</li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/articles/write') }}" @if ($uri == '/admin/articles/write') class="active" @endif >
                <i class="am-icon-edit sidebar-nav-link-logo"></i> 写作
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/articles') }}" @if ( $uri != '/admin/articles/write' && mb_strstr($uri, '/admin/articles')) class="active" @endif >
                <i class="am-icon-file-text-o sidebar-nav-link-logo"></i> 文章
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/categories') }}" @if (mb_strstr($uri, '/admin/categories')) class="active" @endif>
                <i class="am-icon-folder-o sidebar-nav-link-logo"></i> 分类
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/pages') }}" @if (mb_strstr($uri, '/admin/pages')) class="active" @endif>
                <i class="am-icon-file-code-o sidebar-nav-link-logo"></i> 页面

            </a>
        </li>

        <li class="sidebar-nav-heading">资源</li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/images') }}">
                <i class="am-icon-file-image-o sidebar-nav-link-logo"></i> 图片
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ url('/admin/files') }}">
                <i class="am-icon-file-o sidebar-nav-link-logo"></i> 文件
            </a>
        </li>

    </ul>
</div>