@extends('admin')

@section('content')
    <div class="edit-body">
        <div  class="form-group">
            <label>名称：</label>
            <input type="text" class="form-control" id="e_title" value="{{ $info['title'] }}">
        </div>
        <div  class="form-group">
            <label>类型：</label>
            <select class="form-control" id="e_type">
                @foreach ($data['type_list'] as $key=>$row)
                    <option @if ( $info['type'] == $key ) selected @endif value="{{ $key }}">{{ $row }}</option>
                @endforeach
            </select>
        </div>
        <div  class="form-group">
            <label>图片：</label>
            <input type="text" class="form-control" id="e_img_url" value="{{ $info['img_url'] }}">
            @if ( $info['img_url'] )<div class="edit-img"><img src="{{ $info['img_url'] }}"></div>@endif
        </div>
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
        var title = $('#e_title').val();
        var id = $('#e_id').val();
        var type = $('#e_type').val();
        var img_url = $('#e_img_url').val();
        var token = $('#token').val();
        $.ajax({
            url:'/admin/save',
            data:{'title':title,'type':type,'img_url':img_url,'id':id,'t':'retrofit'},
            type:'post',
            dataType:'json',
            headers:{'X-CSRF-TOKEN':token},
            success:function(obj){
                alert(obj.msg);
                if(obj.status == 'success'){
                    window.location.href = '/admin/edit?t=retrofit&id='+obj.data;
                }
            },
            error:function (){}
        })
    })
});
</script>
@stop