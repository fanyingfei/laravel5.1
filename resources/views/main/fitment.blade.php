@extends('main.main')

@section('content')
    <div class="fitment-bg  crumb-bg"></div>
    <div class="fitment-filter">
        <dl class="cf ts">
            <dt>风格：</dt>
            <dd>
                @foreach ($data['fitment_list'] as $key=>$row)
                    <a @if ( $data['fitment_curr'] == $row['sign_id']) class="curr" @endif data-id="{{ $row['sign_id'] }}">{{ $row['name'] }}</a>
                @endforeach
            </dd>
        </dl>
        <dl class="cf hs">
            <dt class="hx">户型：</dt>
            <dd>
                @foreach ($data['house_list'] as $key=>$row)
                    <a @if ( $data['house_curr'] == $row['sign_id']) class="curr" @endif data-id="{{ $row['sign_id'] }}">{{ $row['name'] }}</a>
                @endforeach
            </dd>
        </dl>
      </div>

    <div class="fitment-wrapper">
         <div class="fitment-list">
              @foreach ($data['list'] as $key=>$row)
                    <div class="fitment-one @if ( ($key + 1)%3== 0) f-three @endif">
                        <a class="fitment-img" data-id="{{ $row['rec_id'] }}"><img src="{{ $row['img_url'] }}" /><div></div></a>
                        <p>{{ $row['name'] }}{{ $row['style'] }}{{ $row['house'] }}<span class="m8"> <i>{{ $row['img_num'] }}</i>张</span></p>
                    </div>
              @endforeach
         </div>
         {!! $data['pagination'] !!}
    </div>
@stop

@section('script')
<script type="text/javascript" src="/js/jssor.js"></script>
<script type="text/javascript" src="/js/jssor.slider.js"></script>
<script type="text/javascript" src="/js/jssor.example.js"></script>
<script>
$(function(){
	$(".fitment-filter dd a").click(function(){
	    $(this).addClass("curr").siblings().removeClass("curr");
        var ts = $(".ts a.curr").attr('data-id');
        var hs = $(".hs a.curr").attr('data-id');
        if(ts == 0 && hs == 0){
            window.location.href='/fitment';
        }else if(ts > 0 && hs == 0){
            window.location.href='/fitment/ts/'+ts;
        }else if(ts == 0 && hs > 0){
            window.location.href='/fitment/hs/'+hs;
        }else{
            window.location.href='/fitment/ts/'+ts+'/hs/'+hs;
        }
	})

	$('.fitment-img').click(function(){
	    var rec_id = $(this).data('id');
	    $.get('/fitment/img/'+rec_id, {}, function(result) {show_images(result)}, "json" );
	})

	function show_images(result){
	    var html = '<div class="modal-container"><p class="close">×</p>';
	    html += '<div id="slider1_container"><div u="loading" class="f-loading">';
	    html += '<div class="f-loading-one"></div><div class="f-loading-two"></div></div>';
	    html += '<div u="slides" class="sildes-container">';
        $.each(result, function(k, v) {
             html += '<div><img u="image" src="'+v.img_url+'" /><img u="thumb" src="'+v.img_url+'" /></div>';
        })
	    html += '</div><span u="arrowleft" class="jssora05l"></span>';
	    html += '<span u="arrowright" class="jssora05r"></span>';
	    html += '<div u="thumbnavigator" class="jssort01">';
	    html += '<div u="slides" class="f-slides"><div u="prototype" class="p">';
        html += '<div class=w><div u="thumbnailtemplate"></div></div>';
        html += '<div class=c></div></div></div></div></div></div>';
        $('.modal-bg').html(html);
        jssor_init();
        $('.modal-bg').show();
	}
});
</script>
@stop