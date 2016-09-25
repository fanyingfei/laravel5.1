$(function(){
    $('.table-toolbar #remove').click(function(){
        var ids = get_selected();
        var token = $('#token').val();
        var del_url = $(this).attr('data-url');
        if(ids == ''){
            alert('请选择操作项');
            return false;
        }
        $.ajax({
            url:del_url,
            data:{"ids":ids},
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

    function get_selected(){
        var str = '';
        $("input[name='btSelectItem']:checkbox").each(function(){
            if($(this).attr("checked")){
                str += $(this).parent().next("td").text()+","
            }
        })
        str = str.substring(0,str.length-1);
        return str;
    }
});
