@extends('main')

@section('content')
    <div class="events-bg crumb-bg">
        <p>动态/资讯</p>
    </div>
    <div class="events-wrapper">
        <ul class="events-side">
            <li><a @if ( $data['curr'] == 'ev') class="curr" @endif href="/events">动态<i></i></a></li>
            <li><a @if ( $data['curr'] == 'in') class="curr" @endif href="/information">资讯<i></i></a></li>
        </ul>
        <div class="events-list">
            @foreach ($data['events_list'] as $key=>$row)
                <div class="events-one">
                    @if ($row['title_img']) <a href="/show/{{ $row['id'] }}"><img src="{{ $row['title_img'] }}" /></a> @endif
                        <div class="events-info">
                            <p class="title"><a href="/show/{{ $row['id'] }}">{{ $row['title'] }}</a></p>
                            <p class="events-more"><span>{{ $row['create_time'] }}</span><a href="/show/{{ $row['id'] }}">阅读详情>></a></p>
                        </div>
                </div>
            @endforeach
            {!! $data['pagination'] !!}
        </div>
    </div>
@stop

@section('script')
<script>
$(function(){
    fixed_left();
	window.onscroll = function(){
        fixed_left();
    }
	function fixed_left(){
	    var scroll_height = $(window).scrollTop();
	    var top_height = $('.events-list').offset().top;
        if(scroll_height >top_height){
            $('.events-side').addClass('events-fixed');
        }else{
            $('.events-side').removeClass('events-fixed');
        }
	}
});
</script>
@stop