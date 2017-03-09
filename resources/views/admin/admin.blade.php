<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>管理后台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-table.min.css">
    <link rel="stylesheet" href="/css/admin.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/admin.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap-table.js"></script>
</head>
<body>
    <div class="main-top"><span>管理后台</span><a target="_blank" href="/">返回首页</a></div>
    <div class="main-left">
        <p>菜单</p>
        <ul class="menu">
            <li @if ( $data['curr'] == 'base') class="cur-nav" @endif><a href="/admin/base">首页数据</a></li>
            <li @if ( $data['curr'] == 'fitment') class="cur-nav" @endif><a href="/admin/fitment">整体装修</a></li>
            <li @if ( $data['curr'] == 'retrofit') class="cur-nav" @endif><a href="/admin/retrofit">室内翻新</a></li>
            <li @if ( $data['curr'] == 'floor') class="cur-nav" @endif><a href="/admin/floor">木质地板</a></li>
            <li @if ( $data['curr'] == 'event') class="cur-nav" @endif><a href="/admin/event">动态咨询</a></li>
            <li @if ( $data['curr'] == 'bespeak') class="cur-nav" @endif><a href="/admin/bespeak">用户信息</a></li>
            <li @if ( $data['curr'] == 'access') class="cur-nav" @endif><a href="/admin/access">访问纪录</a></li>
        </ul>
    </div>
    <div class="main-right container">
        @yield('content')
    </div>
    <input id="token" type="hidden" value="{{ csrf_token() }}" >
</body>
@yield('script')
</html>