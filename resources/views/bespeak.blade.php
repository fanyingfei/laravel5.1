@extends('main')

@section('content')
    <div class="retrofit-bg crumb-bg"></div>
    <div class="bespeak-wrapper">
        手机<input id="mobile" type="text" value="">
        邮箱<input id="email" type="text" value="">
        内容<textarea id="content"></textarea>
        <input id="token" type="hidden" value="{{ csrf_token() }}" >
        <button id="submit">提交</button>
    </div>
@stop

@section('script')
<script>
$(function(){
    $('#submit').click(function(){
        var mobile = $('#mobile').val();
        var email = $('#email').val();
        var content = $('#content').val();
        var token = $('#token').val();
        $.ajax({
            url:'/bespeak/save',
            data:{"mobile":mobile,"email":email,'content':content},
            type:'post',
            dataType:'json',
            headers:{'X-CSRF-TOKEN':token},
            success:function(result){
                if(result) alert('预约成功');
            },
            error:function (){}
        })
    })
});
</script>
@stop