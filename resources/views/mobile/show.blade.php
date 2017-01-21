@extends('mobile')

@section('content')
    <div class="events-wrapper">
        <div class="events-list">
            <div class="events-one events-detail">
                @if ($info['title_img']) <a><img src="{{ $info['title_img'] }}" /></a> @endif
                <div class="events-info">
                    <p class="title"><a>{{ $info['title'] }}</a></p>
                    <p class="events-more"><span>{{ $info['create_time'] }}</span></p>
                    <div class="content">{!! $info['content'] !!}</div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
@stop