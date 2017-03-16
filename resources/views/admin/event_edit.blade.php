@extends('admin.admin')

@section('content')
<div class="edit-body" xmlns="http://www.w3.org/1999/html">
            <div  class="form-group">
                <label>名称：</label>
                <input type="text" class="form-control" id="e_title" value="{{ $info['title'] }}">
            </div>
            <div  class="form-group">
                <label>别名：</label>
                <input type="text" class="form-control" id="e_alias_name" value="{{ $info['alias_name'] }}">
             </div>
            <div  class="form-group">
                <label>类型：</label>
                <select class="form-control" id="e_type">
                    <option @if ( $info['type'] == 0 ) selected @endif value="0">请选择</option>
                    <option @if ( $info['type'] == 1 ) selected @endif value="1">动态</option>
                    <option @if ( $info['type'] == 2 ) selected @endif value="2">咨讯</option>
                </select>
            </div>
            <div  class="form-group">
                <label>权重：</label>
                <input type="text" class="form-control" id="e_sort" value="{{ $info['sort'] }}">
            </div>
            <div  class="form-group">
                <label>关键词：</label>
                <input type="text" class="form-control" id="e_keywords" value="{{ $info['keywords'] }}">
            </div>
            <div  class="form-group">
                <label>描述：</label>
                <textarea class="form-control" id="e_description">{{ $info['description'] }}</textarea>
            </div>
            <div  class="form-group">
                <label>时间：</label>
                <input type="text" class="form-control" id="e_create_time" value="{{ $info['create_time'] }}">
            </div>
            <div  class="form-group">
                <label>图片：</label>
                <input type="text" class="form-control" id="e_title_img" value="{{ $info['title_img'] }}">
                @if ( $info['title_img'] )<div class="edit-img"><img src="{{ $info['title_img'] }}"></div>@endif
            </div>
            <div  class="form-group">
                <label>内容：</label>
                <textarea name="content" id="content">{{ $info['content'] }}</textarea>
            </div>
            <div  class="form-group">
                <input type="hidden" id="e_id" value="{{ $info['rec_id'] }}">
                <button class="submit">保存</button>
            </div>
    </div>
@stop

@section('script')
<script charset="utf-8" src="/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="/kindeditor/emoticons.js"></script>
<script charset="utf-8" src="/kindeditor/lang/zh_CN.js"></script>
<script>
$(function(){
    KindEditor.ready(function(K) {
        window.editor = K.create('#content', {
            newlineTag : "p" ,
            itemsName : true,
            //   items : [ 'image' , 'link' ,'emoticons']
            items : ['source','formatblock','fontname', 'fontsize', 'forecolor', 'hilitecolor', 'bold', 'image','emoticons']
        });
    });

    $('.submit').click(function(){
        var id = $('#e_id').val();
        var title = $('#e_title').val();
        var alias_name = $('#e_alias_name').val();
        var sort = $('#e_sort').val();
        var type = $('#e_type').val();
        var keywords = $('#e_keywords').val();
        var description = $('#e_description').val();
        var create_time = $('#e_create_time').val();
        var title_img = $('#e_title_img').val();
        var content = $(document.getElementById('myiframe').contentWindow.document.body).html();
        var token = $('#token').val();
        if(alias_name == '' || title == ''){
            alert('请填写完整信息');
            return false;
        }
        $.ajax({
            url:'/admin/save',
            data:{'title':title,'alias_name':alias_name,'type':type,'sort':sort,'keywords':keywords,'description':description,'create_time':create_time,'title_img':title_img,'content':content,'create_time':create_time,'id':id,'t':'event'},
            type:'post',
            dataType:'json',
            headers:{'X-CSRF-TOKEN':token},
            success:function(obj){
                alert(obj.msg);
                if(obj.status == 'success'){
                    window.location.href = '/admin/edit?t=event&id='+obj.data;
                }
            },
            error:function (){}
        })
    })
});
</script>
@stop