@extends('admin.admin')

@section('content')
    <div class="table-toolbar">
        <button class="btn btn-op" id="remove" data-url="/admin/delete?t=access">Delete</button>
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
            <th data-sortable="true" data-field="create_time">时间</th>
        </tr>
        </thead>
    </table>
@stop