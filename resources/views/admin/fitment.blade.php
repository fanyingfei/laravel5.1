@extends('admin')

@section('content')
    <div class="table-toolbar">
        <button class="btn btn-op" id="remove" data-url="/admin/delete?t=fitment">Delete</button>
        <a href="/admin/edit?t=fitment"><button class="btn btn-op">Add</button></a>
    </div>
    <table id="table"
           data-toggle="table"
           data-url="/admin/list?t=fitment"
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
            <th data-sortable="true"  data-field="name">名称</th>
            <th data-sortable="true" data-field="style">风格</th>
            <th data-sortable="true" data-field="house">户型</th>
            <th data-sortable="true" data-field="area">面积</th>
            <th data-sortable="true" data-field="price">价格</th>
            <th data-field="create_time">时间</th>
            <th data-field="op">操作</th>
        </tr>
        </thead>
    </table>
@stop