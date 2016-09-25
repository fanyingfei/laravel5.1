@extends('admin')

@section('content')
    <div class="table-toolbar">
        <!--<button class="btn btn-op" id="remove" data-url="/admin/delete?t=base">Delete</button>
        <button class="btn btn-op">Add</button>-->
    </div>
    <table id="table"
           data-toggle="table"
           data-url="/admin/list?t=base"
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
            <th data-sortable="true"  data-field="type">类型</th>
            <th data-sortable="true" data-field="sort">权重</th>
            <th data-field="name">名称</th>
            <th data-field="sign_id">标识ID</th>
            <th data-field="img_url">图片</th>
            <th data-field="url">跳转链接</th>
            <th data-field="create_time">时间</th>
            <th data-field="op">操作</th>
        </tr>
        </thead>
    </table>
@stop