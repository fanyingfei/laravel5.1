@extends('main')

@section('content')
    <div class="banner">
    	<ul class="banList">
    	    @foreach ($data['banner_list'] as $key=>$row)
                <li @if ($key==0)class="active"@endif><a @if ($row['url']) href="{{ $row['url'] }}" @endif style="background-image:{{ $row['style'] }}"></a></li>
    		@endforeach
    	</ul>
    	<div class="fomW">
    		<div class="jsNav">
    		    @foreach ($data['banner_list'] as $key=>$row)
    			    <a href="javascript:void(0);" class="trigger @if ($key==0)current @endif "></a>
    			@endforeach
    		</div>
    	</div>
    </div>
    <div class="content_wrapper">
        <div class="index-case">
           <div class="indexdfl">
             <div class="dbt">案 例 分 享</div>
             <div class="more"><a href="/fitment">MORE >></a></div>
           </div>
           <div class="tab-wrapper">
                <div class="tag-bg">
                    @foreach ($data['case_list'] as $key=>$row)
                        <div data-id="{{ $key+1 }}" class="tab @if ($key==0)current @endif ">{{ $row['name'] }}</div>
                    @endforeach
                </div>
                <div class="tab-img-list">
                    @foreach ($data['case_list'] as $key=>$row)
                        <div id="tab-img-{{ $key+1 }}"><img src="{{ $row['img_url'] }}"></div>
                    @endforeach
                </div>
           </div>
        </div>
        <div class="index-events">
            <div class="indexdfl">
                 <div class="dbt">动 态 资 讯</div>
                 <div class="more"><a href="/events">MORE >></a></div>
            </div>
            <ul class="toplist">
                @foreach ($data['article_list'] as $key=>$row)
                    <li><a href="/show/{{ $row['id'] }}" title="{{ $row['title'] }}"><span>{{ $key+1 }}.</span>{{ $row['title'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@stop

@section('script')
<script>
$(function(){
	$(".banner").swBanner();
    $(".tag-bg .tab").click(function(){
        $(this).addClass("current").siblings().removeClass("current");
        var data_id = $(this).attr('data-id');
        $("#tab-img-"+data_id).show(500).siblings().hide(500);
    });
	$(window).resize(function(){$(".banner").height($(".banList li img").height());});
});
</script>
@stop