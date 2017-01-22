<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="all" />
    <title>{{ $data['title'] }}</title>
    <meta name="keywords" content="{{ $data['keywords'] }}" />
    <meta name="description" content="{{ $data['description'] }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="baidu-site-verification" content="Pg0lDPlzCA" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" href="/css/common.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
</head>
<body class="{{ $data['body'] }}">
    <div class="nav">
        <div class="w1200 mc">
            <ul class="menu">
                <li class="logo"><a href="/"><img title="上海洵直装饰" src="/img/icon/logo.png"/></a></li>
                <li @if ( $data['body'] == 'home') class="cur-nav" @endif><a href="/">官网首页</a></li>
                <li @if ( $data['body'] == 'wall') class="cur-nav" @endif><a href="/wall">墙面刷新</a></li>
                <li @if ( $data['body'] == 'part') class="cur-nav" @endif><a href="/part">局部翻新</a></li>
                <li @if ( $data['body'] == 'fitment') class="cur-nav" @endif><a href="/fitment">整体翻新</a></li>
                <li @if ( $data['body'] == 'floor') class="cur-nav" @endif><a href="/floor">木质地板</a></li>
                <li @if ( $data['body'] == 'events') class="cur-nav" @endif><a href="/events">动态资讯</a></li>
                <li class="last"><a href="javascript:bespeak()">在线预约</a></li>
                <li class="contact"><p>免费预约电话</p><p>13052057882</p></li>
            </ul>
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <div class="footer">
        <p>
            <span>免费服务热线：13052057882</span>
            <span>客服QQ：<a rel="external nofollow" target="_blank" href="http://wpa.qq.com/msgrd?uin=605022496&site=qq&menu=yes">605022496</a></span>
            <span>服务邮箱：605022496@qq.com</span>
            <span>工作时间：周一至周日 09:00-22:00</span>
        </p>
        <p>
            <a href="/events">动态</a> |
            <a href="/information">资讯</a> |
            <a href="/about">关于我们</a> |
            <a href="/about/bsk">预约查询</a> |
            <a href="/about/qua">质保查询</a> |
            <a href="/about/faq">常见问题</a>
        </p>
        <p>
            <span>Copyright2012-2016 www.shuaxin.co,All Rights Reserved</span>
            <span>ICP备案：<a rel="nofollow" target="_blank" href="http://www.miitbeian.gov.cn">粤ICP备15072739号-1</a><span id="touch">&nbsp;&nbsp;| 手机版</span></span>
        </p>
        <input id="token" type="hidden" value="{{ csrf_token() }}" >
    </div>
    <div id="online"><a rel="external nofollow" href="http://wpa.qq.com/msgrd?uin=605022496&site=qq&menu=yes" target="_blank">在线咨询</a></div>
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