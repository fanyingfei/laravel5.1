<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>管理后台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" href="/css/admin.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery.md5.js"></script>
</head>

<body class="login">
<div class="login_m">
    <div class="login_logo"><img src="/img/icon/logo.png" width="196"></div>
    <div class="login_boder">
        <div class="login_padding" id="login_model">
            <h2>USERNAME</h2>
            <label>
                <input type="text" id="username" class="txt_input txt_input2"  placeholder="Your name">
            </label>
            <h2>PASSWORD</h2>
            <label>
                <input type="password" name="textfield2" id="userpwd" class="txt_input" placeholder="Your password">
            </label>
            <p class="forgot"><a id="iforget" href="javascript:void(0);">Forgot your password?</a></p>
            <div class="rem_sub">
                <div class="rem_sub_l">
                    <input type="checkbox" name="checkbox" id="save_me">
                    <label for="checkbox">Remember me</label>
                </div>
                <label><div class="sub_button">SIGN-IN</div></label>
            </div>
            <input id="token" type="hidden" value="{{ csrf_token() }}" >
        </div>
    </div>
</div>
<script>
$(function(){
    $('.sub_button').click(function(){
        var username = $('#username').val();
        var password = $.md5($('#userpwd').val());
        var remember = $('#save_me').is(':checked');
        remember =  remember  ? 1 : 0;
        var token = $('#token').val();
        $.ajax({
            url:'/admin/sign_in',
            data:{'username':username,'password':password,'remember':remember},
            type:'post',
            dataType:'json',
            headers:{'X-CSRF-TOKEN':token},
            success:function(obj){
                if(obj.status == 'success'){
                    window.location.href = '/admin';
                }else{
                    alert(obj.msg);
                }
            },
            error:function (){}
        })
    })
});
</script>
</body>
</html>