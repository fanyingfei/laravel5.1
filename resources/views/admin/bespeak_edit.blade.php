@extends('admin')

@section('content')
    <div class="edit-body">
        <div  class="form-group">
            <label>姓名：</label>
            <input type="text" class="form-control" id="e_name" value="{{ $info['name'] }}">
        </div>
        <div  class="form-group">
            <label>手机：</label>
            <input type="text" class="form-control" id="e_mobile" value="{{ $info['mobile'] }}">
        </div>
        <div  class="form-group">
            <label>类型：</label>
            <select class="form-control" id="e_type">
                @foreach ($data['bespeak_type'] as $key=>$row)
                    <option @if ( $info['type'] == $key ) selected @endif value="{{ $key }}">{{ $row }}</option>
                @endforeach
            </select>
        </div>
        <div  class="form-group">
            <label>质保：</label>
            <select class="form-control" id="e_year">
                <option @if ( $info['year'] == 0 ) selected @endif value="0">请选择</option>
                <option @if ( $info['year'] == 1 ) selected @endif value="1">1年</option>
                <option @if ( $info['year'] == 2 ) selected @endif value="2">2年</option>
                <option @if ( $info['year'] == 3 ) selected @endif value="3">3年</option>
                <option @if ( $info['year'] == 4 ) selected @endif value="4">4年</option>
                <option @if ( $info['year'] == 5 ) selected @endif value="5">5年</option>
            </select>
        </div>
        <div  class="form-group">
            <label>地址：</label>
            <input type="text" class="form-control" id="e_address" value="{{ $info['address'] }}">
        </div>
        <div  class="form-group">
            <label>留言：</label>
            <input type="text" class="form-control" id="e_remark" value="{{ $info['remark'] }}">
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
        var name = $('#e_name').val();
        var id = $('#e_id').val();
        var type = $('#e_type').val();
        var year = $('#e_year').val();
        var mobile = $('#e_mobile').val();
        var remark = $('#e_remark').val();
        var address = $('#e_address').val();
        var token = $('#token').val();
        $.ajax({
            url:'/admin/save',
            data:{'name':name,'type':type,'year':year,'mobile':mobile,'remark':remark,'address':address,'id':id,'t':'bespeak'},
            type:'post',
            dataType:'json',
            headers:{'X-CSRF-TOKEN':token},
            success:function(obj){
                alert(obj.msg);
                if(obj.status == 'success'){
                    window.location.href = '/admin/edit?t=bespeak&id='+obj.data;
                }
            },
            error:function (){}
        })
    })
});
</script>
@stop