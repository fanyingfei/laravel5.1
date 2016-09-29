<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="all" />
    <title>{{ $data['title'] }}</title>
    <meta name="keywords" content="{{ $data['keywords'] }}" />
    <meta name="description" content="{{ $data['description'] }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" href="/css/common.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
</head>
<body class="{{ $data['body'] }}">
    <div class="nav">
        <div class="w1200 mc">
            <ul class="menu">
                <li class="logo"><a href="/"><img src="/img/icon/logo.png" width="125" height="65"  /></a></li>
                <li @if ( $data['body'] == 'home') class="cur-nav" @endif><a href="/">官网首页<span>home</span></a></li>
                <li @if ( $data['body'] == 'retrofit') class="cur-nav" @endif><a href="/retrofit">室内翻新<span>retrofit</span></a></li>
                <li @if ( $data['body'] == 'fitment') class="cur-nav" @endif><a href="/fitment">整体装修<span>fitment</span></a></li>
                <li @if ( $data['body'] == 'faq') class="cur-nav" @endif><a href="/faq">常见问题<span>answer</span></a></li>
                <li @if ( $data['body'] == 'bespeak') class="cur-nav" @endif><a href="/bespeak">预约留言<span>bespeak</span></a></li>
                <li @if ( $data['body'] == 'events') class="cur-nav" @endif><a href="/events">动态资讯<span>events</span></a></li>
                <li @if ( $data['body'] == 'about') class="cur-nav" @endif><a href="/about">关于我们<span>about us</span></a></li>
            </ul>
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <div class="footer">
        <div id="top"></div>
    </div>
</body>
@yield('script')
</html>