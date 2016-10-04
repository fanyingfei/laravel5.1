@extends('main')

@section('content')
    <div class="fitment-bg  crumb-bg"></div>
    <div class="retrofit-wrapper">
        <ul class="retrofit-tab tab-href">
            <li>服务项目：</li>
            <li><a @if ( $data['curr'] == 'wall') class="curr" @endif href="/wall">墙面翻新</a></li>
            <li><a @if ( $data['curr'] == 'part') class="curr" @endif href="/part">局部翻新</a></li>
            <li><a @if ( $data['curr'] == 'fitment') class="curr" @endif href="/fitment">整体翻新</a></li>
        </ul>
        @yield('retrofit-info')
        <div class="tab-content">
            @yield('tab-content')
            <div class="f-content fitment-list retrofit-list">
                @foreach ($data['list'] as $key=>$row)
                    <div class="fitment-one @if ( ($key + 1)%3== 0) f-three @endif">
                        <a class="fitment-img"><img src="{{ $row['img_url'] }}" /><div></div></a>
                        <p>{{ $row['title'] }}</p>
                    </div>
                @endforeach
                {!! $data['pagination'] !!}
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
    $('.fitment-img').click(function(){
        var cur_index = $(this).parent().index();
        var html = '<div class="modal-container"><p class="close">×</p>';
	    html += '<div id="slider1_container"><div u="loading" class="f-loading">';
	    html += '<div class="f-loading-one"></div><div class="f-loading-two"></div></div>';
	    html += '<div u="slides" class="sildes-container">';
        $('.fitment-img img').each(function(k,v){
             html += '<div><img u="image" src="'+$(v).attr('src')+'" /><img u="thumb" src="'+$(v).attr('src')+'" /></div>';
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
	    $('.slide-'+cur_index+' .w img').trigger('click');
	})

	change_tab();
});

function change_tab(){
    var url = window.location.href;
    if(url.indexOf("#")<0) return false;
    var tab = url.substr(-1);
    $('.retrofit-info li').eq(tab).children('a').addClass("curr");
    $('.retrofit-info li').eq(tab).siblings().children('a').removeClass("curr");
    $('.f-content').eq(tab-1).fadeIn().siblings().hide();
}

function ajax_page(p){
    var curr = $('.tab-href .curr').attr('href');
    $.get('page'+curr+'/'+p, {}, function(result) { change_case(result); }, "json" );
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