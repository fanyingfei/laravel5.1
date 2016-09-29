@extends('main')

@section('content')
    <div class="events-bg crumb-bg">
        <p>动态/资讯</p>
    </div>
    <div class="events-wrapper">
        <ul class="events-side">
            <li><a @if ( $data['curr'] == 'ev') class="curr" @endif href="/events">动态<i></i></a></li>
            <li><a @if ( $data['curr'] == 'in') class="curr" @endif href="/events/in">资讯<i></i></a></li>
        </ul>
        <div class="events-list">
            <div class="events-one events-detail">
                @if ($info['title_img']) <a><img src="{{ $info['title_img'] }}" /></a> @endif
                <div class="events-info">
                    <p class="title"><a>{{ $info['title'] }}</a></p>
                    <p class="events-more"><span>{{ $info['create_time'] }}</span></p>
                    <div class="content">{!! $info['content'] !!}</div>
                </div>
            </div>
        </div>
    </div>
@stop