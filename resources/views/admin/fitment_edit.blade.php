@extends('admin.admin')

@section('content')
    <div class="edit-body">
        <div  class="form-group">
            <label>名称：</label>
            <input type="text" class="form-control" id="e_name" value="{{ $info['name'] }}">
        </div>
        <div  class="form-group">
            <label>风格：</label>
            <select class="form-control" id="e_style">
                <option @if ( $info['style'] == 0 ) selected @endif value="0">请选择</option>
                @foreach ($data['style_list'] as $key=>$row)
                    <option @if ( $info['style'] == $key ) selected @endif value="{{ $key }}">{{ $row }}</option>
                @endforeach
            </select>
        </div>
        <div  class="form-group">
            <label>户型：</label>
            <select class="form-control" id="e_house">
                <option @if ( $info['house'] == 0 ) selected @endif value="0">请选择</option>
                @foreach ($data['house_list'] as $key=>$row)
                    <option @if ( $info['house'] == $key ) selected @endif value="{{ $key }}">{{ $row }}</option>
                @endforeach
            </select>
        </div>
        <div  class="form-group">
            <label>面积：</label>
            <input type="text" class="form-control" id="e_area" value="{{ $info['area'] }}">
        </div>
        <div  class="form-group">
            <label>价格：</label>
            <input type="text" class="form-control" id="e_price" value="{{ $info['price'] }}">
        </div>
        <div  class="form-group">
            <label>图片：</label>
            <div class="fitment_img_list">
                @foreach ($info['img_list'] as $key=>$row)
                    <div class="fitment_img_row">
                        <div class="fitment_img"><img src="{{ $row['img_url'] }}" /></div>
                        <p><span>图片：</span><input type="text" class="form-control img_url" value="{{ $row['img_url'] }}"></p>
                        <p><span>权重：</span><input type="text" class="form-control sort" value="{{ $row['sort'] }}">
                                <button class="form-control del-img">删除</button></p>
                        <input class="img_id" type="hidden" value="{{ $row['img_id'] }}"/>
                    </div>
                @endforeach
            </div>
        </div>
        <div  class="form-group add_fitment">
            <button class="add-btn">[+]添加图片</button>
            <p><span>图片：</span><input type="text" class="form-control img_url" value=""></p>
            <p><span>权重：</span><input type="text" class="form-control sort" value=""></p>
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
        var id = $('#e_id').val();
        var name = $('#e_name').val();
        var style = $('#e_style').val();
        var house = $('#e_house').val();
        var area = $('#e_area').val();
        var price = $('#e_price').val();
        var token = $('#token').val();
        var row = [];
        var img_list = [];

        $(".fitment_img_row").each(function(k,v){
            row = [];
            row[0] = $(v).find('.img_id').val();
            row[1] = $(v).find('.img_url').val();
            row[2] = $(v).find('.sort').val();
            img_list[k] = row;
        });

        $.ajax({
            url:'/admin/save',
            data:{'name':name,'style':style,'house':house,'area':area,'price':price,'id':id,'img_list':img_list,'t':'fitment'},
            type:'post',
            dataType:'json',
            headers:{'X-CSRF-TOKEN':token},
            success:function(obj){
                alert(obj.msg);
                if(obj.status == 'success'){
                    window.location.href = '/admin/edit?t=fitment&id='+obj.data;
                }
            },
            error:function (){}
        })
    })

    $('button.add-btn').click(function(){
        var img_url = $(this).parent().find('.img_url').val();
        if(!img_url){
            alert('请输入图片URL');
            return false;
        }
        var sort = $(this).parent().find('.sort').val();
        if(!sort) sort = 0;
        var html = '<div class="fitment_img_row"><div class="fitment_img"><img src="'+img_url+'" /></div>';
        html += '<p><span>图片：</span><input type="text" class="form-control img_url" value="'+img_url+'"></p>';
        html += '<p><span>权重：</span><input type="text" class="form-control sort" value="'+sort+'">';
        html += '<button class="form-control del-img">删除</button></p>';
        html += '<input class="img_id" type="hidden" value="0"/></div>';
        $('.fitment_img_list').append(html);
       $(this).parent().find('.img_url').val('');
       $(this).parent().find('.sort').val('');
    })

    $('body').on('click', '.del-img', function(){
        $(this).parents('.fitment_img_row').remove();
    })
});
</script>
@stop