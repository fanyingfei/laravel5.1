@extends('admin.admin')

@section('content')
    <div class="table-toolbar">
        <button class="btn btn-op" id="remove" data-url="/admin/delete?t=access">Delete</button>
        <input style="float:left;margin-right:10px;" id="laydate" placeholder="选择日期" class="form-control laydate-icon" onclick="laydate()">
        <button class="btn btn-op" id="sel_time">确定</button>
    </div>
    <table id="table"
           data-toggle="table"
           data-url="/admin/list?t=access"
           data-show-columns="true"
           data-search="false"
           data-show-refresh="true"
           data-show-toggle="false"
           data-pagination="true"
           data-side-pagination="server"
           data-height="600">
        <thead>
        <tr>
            <th data-field="state" data-checkbox="true"></th>
            <th data-sortable="true" data-field="rec_id">ID</th>
            <th data-field="url">URL</th>
            <th data-field="ip">IP</th>
            <th data-field="ip_address">IP地址</th>
            <th data-field="is_crawler">是否爬虫</th>
            <th data-sortable="true" data-field="create_time">时间</th>
        </tr>
        </thead>
    </table>
@stop
@section('script')
<script type="text/javascript" src="/laydate/laydate.js"></script>
<script>
$(function(){
    $("#sel_time").click(function(){
        var time = $("#laydate").val();
        if(time == ''){
            alert('请选择时间');
            return false;
        }
        $("#table").bootstrapTable('refresh', {url: '/admin/list?t=access&time='+time});
    });
});
</script>
@stop