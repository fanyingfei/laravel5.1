@extends('admin')

@section('content')
    <div class="table-toolbar">
        <button class="btn btn-op" id="remove" data-url="/admin/delete?t=event">Delete</button>
        <a href="/admin/edit?t=event"><button class="btn btn-op">Add</button></a>
    </div>
    <table id="table"
           data-toggle="table"
           data-url="/admin/list?t=event"
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
            <th data-field="title">标题</th>
            <th data-sortable="true" data-field="type">类型</th>
            <th data-field="keywords">关键词</th>
            <th data-field="description">描述</th>
            <th data-field="title_img">图片</th>
            <th data-field="create_time">时间</th>
            <th data-field="op">操作</th>
        </tr>
        </thead>
    </table>
@stop