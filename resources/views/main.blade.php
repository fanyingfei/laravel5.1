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
                <li class="logo"><a href="/"><img src="/img/icon/logo.png"/></a></li>
                <li @if ( $data['body'] == 'home') class="cur-nav" @endif><a href="/">官网首页</a></li>
                <li @if ( $data['body'] == 'retrofit') class="cur-nav" @endif><a href="/retrofit">室内翻新</a></li>
                <li @if ( $data['body'] == 'fitment') class="cur-nav" @endif><a href="/fitment">整体装修</a></li>
                <li @if ( $data['body'] == 'floor') class="cur-nav" @endif><a href="/floor">木质地板</a></li>
                <li @if ( $data['body'] == 'faq') class="cur-nav" @endif><a href="/faq">常见问题</a></li>
                <li @if ( $data['body'] == 'events') class="cur-nav" @endif><a href="/events">动态资讯</a></li>
                <li class="last @if ( $data['body'] == 'about')cur-nav @endif "><a href="/about">关于我们</a></li>
                <li class="contact"><p>免费预约电话</p><p>13524112936</p></li>
            </ul>
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <div class="footer">
        <input id="token" type="hidden" value="{{ csrf_token() }}" >
    </div>
    <div id="bespeak" onclick="bespeak()">免费预约</div>
    <div id="online"><a href="http://wpa.qq.com/msgrd?uin=605022496&site=qq&menu=yes" target="_blank">在线咨询</a></div>
    <div id="top"></div>
    <div class="modal-bg"></div>
</body>
<script>
function bespeak(){
    var html = '';
    html += '<div class="bespeak-info"><p class="close">×</p>';
    html += '<div class="bespeak-row"><div>姓名</div><div><input class="b-name" type="text" maxlength="30" ></div></div>';
    html += '<div class="bespeak-row"><div>手机</div><div><input class="b-mobile" type="text" maxlength="11" ></div></div>';
    html += '<div class="bespeak-row"><div>地址</div><div><input class="b-address" type="text" ></div></div>';
    html += '<div class="bespeak-row"><div>留言</div><div><textarea class="b-remark" type="text" ></textarea></div></div>';
    html += '<div class="bespeak-row"><div></div><div><div class="bespeak-submit">马上预约</div></div></div></div>';
    $('.modal-bg').html(html);
    $('.modal-bg').show();
}
</script>
@yield('script')
</html>