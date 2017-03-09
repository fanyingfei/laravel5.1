@extends('main.main')

@section('content')
    <div class="fitment-bg  crumb-bg"></div>
    <div class="retrofit-wrapper">
        @yield('retrofit-info')
        <div class="tab-content">
            @yield('tab-content')
            <div class="f-content">
                @if ( !empty($data['space_list']) )
                    <div class="fitment-filter part-filter">
                        <dl class="cf ts">
                            <dt>空间：</dt>
                            <dd>
                                <a class="curr" data-id="0">全部</a>
                                @foreach ($data['space_list'] as $key=>$row)
                                    <a data-id="{{ $row['sign_id'] }}">{{ $row['name'] }}</a>
                                @endforeach
                            </dd>
                        </dl>
                    </div>
                @endif
                <div class=" fitment-list retrofit-list">
                    @foreach ($data['list'] as $key=>$row)
                        <div class="fitment-one type-id-{{ $row['type'] }} @if ( ($key + 1)%3== 0) f-three @endif">
                            <a class="fitment-img"><img src="{{ $row['img_url'] }}" /></a>
                            <p>{{ $row['title'] }}</p>
                        </div>
                    @endforeach
                    <div class="f-page">{!! $data['pagination'] !!}</div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script type="text/javascript" src="/js/jssor.js"></script>
<script type="text/javascript" src="/js/jssor.slider.js"></script>
<script type="text/javascript" src="/js/jssor.example.js"></script>
<script>
$(function(){
    $('body').on('click', '.fitment-img', function(){
        var aft_html = '';
        var bef_html = '';
        var cur_index = $(this).parent().index();
        var html = '<div class="modal-container"><p class="close">×</p>';
	    html += '<div id="slider1_container"><div u="loading" class="f-loading">';
	    html += '<div class="f-loading-one"></div><div class="f-loading-two"></div></div>';
	    html += '<div u="slides" class="sildes-container">';
        $('.fitment-img img').each(function(k,v){
            if(k >= cur_index){
                aft_html += '<div><img u="image" src="'+$(v).attr('src')+'" /><img u="thumb" src="'+$(v).attr('src')+'" /></div>';
            }else{
                bef_html += '<div><img u="image" src="'+$(v).attr('src')+'" /><img u="thumb" src="'+$(v).attr('src')+'" /></div>';
            }
        })
        html += aft_html;
        html += bef_html;
	    html += '</div><span u="arrowleft" class="jssora05l"></span>';
	    html += '<span u="arrowright" class="jssora05r"></span>';
	    html += '<div u="thumbnavigator" class="jssort01">';
	    html += '<div u="slides" class="f-slides"><div u="prototype" class="p">';
        html += '<div class=w><div u="thumbnailtemplate"></div></div>';
        html += '<div class=c></div></div></div></div></div></div>';
        $('.modal-bg').html(html);
	    jssor_init();
	    $('.modal-bg').show();
	})

    $(".fitment-filter dd a").click(function(){
	    $(this).addClass("curr").siblings().removeClass("curr");
        var type_id = $(this).data('id');
        var curr = window.location.pathname;
        $.get('page'+curr+'?p=1&t='+type_id, {}, function(result) { change_case(result); }, "json" );
	})

	change_tab();
});

function ajax_page(p){
    var curr = window.location.pathname;
    var type_id = $('.part-filter dd a.curr').data('id');
    $.get('page'+curr+'?p='+p+'&t='+type_id, {}, function(result) { change_case(result); }, "json" );
}

function change_case(result){
    var list_html = '';
    $.each(result.list, function(k, v) {
        if((k+1)%3 == 0){
            list_html += '<div class="fitment-one f-three">';
        }else{
            list_html += '<div class="fitment-one">';
        }
        list_html += '<a class="fitment-img"><img src="'+v.img_url+'" /><div></div></a>';
        list_html += '<p>'+v.title+'</p></div>';
    })
    $('.retrofit-list').html(list_html+result.page);
}
</script>
@stop