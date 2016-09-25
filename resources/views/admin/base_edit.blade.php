@extends('admin')

@section('content')
    <div class="edit-body">
        <div  class="form-group">
            <label>名称：</label>
            <input type="text" class="form-control" id="e_name" value="{{ $info['name'] }}">
        </div>
        <div  class="form-group">
            <label>权重：</label>
            <input type="text" class="form-control" id="e_sort" value="{{ $info['sort'] }}">
        </div>
        @if ( $info['type'] == 0 || $info['type'] == 1 )
            <div  class="form-group">
                <label>图片：</label>
                <input type="text" class="form-control" id="e_img_url" value="{{ $info['img_url'] }}">
                @if ( $info['img_url'] )<div class="edit-img"><img src="{{ $info['img_url'] }}"></div>@endif
            </div>
        @endif
        @if ( $info['type'] == 0 )
            <div  class="form-group">
                <label>路转链接：</label>
                <input type="text" class="form-control" id="e_url" value="{{ $info['url'] }}" placeholder="http://">
            </div>
        @endif
        <div  class="form-group">
            <input type="hidden" id="e_id" value="{{ $info['rec_id'] }}">
            <button class="submit">保存</button>
        </div>
    </div>
@stop

@section('script')
<script>
$(function(){
    $('.submit').click(function(){
        var name = $('#e_name').val();
        var id = $('#e_id').val();
        var sort = $('#e_sort').val();
        var url = $('#e_url').val();
        var img_url = $('#e_img_url').val();
        var token = $('#token').val();
        $.ajax({
            url:'/admin/save',
            data:{'name':name,'sort':sort,'img_url':img_url,'url':url,'id':id,'t':'base'},
            type:'post',
            dataType:'json',
            headers:{'X-CSRF-TOKEN':token},
            success:function(obj){
                alert(obj.msg);
                if(obj.status == 'success'){
                    window.location.href = window.location.href;
                }
            },
            error:function (){}
        })
    })
});
</script>
@stop