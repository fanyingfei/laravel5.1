<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="all" />
    <title>{{ $data['title'] }}</title>
    <meta name="keywords" content="{{ $data['keywords'] }}" />
    <meta name="description" content="{{ $data['description'] }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" href="/css/mobile.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
</head>
<body class="{{ $data['body'] }}">
    <div class="nav">
        <div class="menu">
            <div class="logo"><a href="/"><img src="/img/icon/logo.png"></a></div>
            <div class="menu-icon"><img src="/img/mobile/menu.png"></div>
            <ul class="menu-ul">
                <li><a href="/">官网首页</a> l <a href="/wall">墙面刷新</a></li>
                <li><a href="/part">局部翻新</a> l <a href="/fitment">整体翻新</a></li>
                <li><a href="/floor">自热地板</a> l <a href="/floor/general">普通地板</a></li>
                <li><a href="/events">公司动态</a> l <a href="/information">资讯分享</a></li>
                <li><a href="/about/bsk">预约查询</a> l <a href="/about/qua">质保查询</a></li>
                <li><a href="/about/faq">常见问题</a> l <a href="/about">关于我们</a></li>
                <li class="contact">免费预约电话：<span>13052057882</span></li>
            </ul>
            <span class="menu-title">{{ $data['nav_title'] }}</span>
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <div class="footer">
        <p>粤ICP备15072739号-1<span id="pc">PC版</span></p>
        <input id="token" type="hidden" value="{{ csrf_token() }}" >
    </div>
    <div id="bespeak" onclick="bespeak()">在线预约</div>
    <div class="modal-bg"></div>
</body>
<script>
    $(".menu-icon").click(function(){
        if($('.menu-ul').is(":hidden")){
            $('.menu-ul').show();
            $('.container').addClass('bg');
            $('.footer').addClass('bg');
        }else{
            $('.menu-ul').hide();
            $('.container').removeClass('bg');
            $('.footer').removeClass('bg');
        }
    });

    $(".container").click(function(){
        if(!$('.menu-ul').is(":hidden")){
            $('.menu-ul').hide();
            $('.container').removeClass('bg');
            $('.footer').removeClass('bg');
        }
    });

    function bespeak(){
        var html = '';
        html += '<div class="bespeak-info"><p class="close">×</p>';
        html += '<div class="bespeak-row"><div><input placeholder="姓名" class="b-name" type="text" maxlength="30" ></div></div>';
        html += '<div class="bespeak-row"><div><input placeholder="手机" class="b-mobile" type="text" maxlength="11" ></div></div>';
        html += '<div class="bespeak-row"><div><input placeholder="地址" class="b-address" type="text" ></div></div>';
        html += '<div class="bespeak-row"><div><textarea placeholder="留言" class="b-remark" type="text" ></textarea></div></div>';
        html += '<div class="bespeak-row"><div><div class="bespeak-submit">马上预约</div></div></div></div>';
        $('.modal-bg').html(html);
        $('.modal-bg').show();
    }

</script>
@yield('script')
</html>