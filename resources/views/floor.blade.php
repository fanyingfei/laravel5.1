@extends('main')

@section('content')
    <div class="floor-bg crumb-bg"></div>
    <div class="retrofit-wrapper">
        <ul class="retrofit-tab">
            <li>地板类型：</li>
            <li><a @if ( $data['curr'] == 'hot') class="curr" @endif href="/floor">自热地板</a></li>
            <li><a @if ( $data['curr'] == 'common') class="curr" @endif href="/floor/general">普通地板</a></li>
        </ul>
        @yield('floor-info')
        <div class="tab-content">
            @yield('floor-content')
        </div>
    </div>
@stop
