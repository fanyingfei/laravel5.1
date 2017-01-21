@extends('mobile')

@section('content')
    <div class="f-content index-wrapper">
        <h4>我们的服务</h4>
        <div class="cat-list">
            <div>
                <div class="cat-img"><img src="http://ww1.sinaimg.cn/mw690/ce768b7ajw1f8g81f827fj20u80mptaz.jpg" /></div>
                <div class="cat-content">墙面刷新</div>
            </div>
            <div>
                <div class="cat-img"><img src="http://ww4.sinaimg.cn/mw690/be457d08jw1f8a6pwl9qxj20go09lwf0.jpg" /></div>
                <div class="cat-content">厨卫翻新</div>
            </div>
            <div>
                <div class="cat-img"><img src="http://ww4.sinaimg.cn/mw690/ce768b7agw1f8agfknylwj20xc0jnwhj.jpg" /></div>
                <div class="cat-content">整体翻新</div>
            </div>
            <div>
                <div class="cat-img"><img src="http://ww1.sinaimg.cn/mw690/ce768b7ajw1f8puub3ltlj20c008pwft.jpg" /></div>
                <div class="cat-content">木质地板</div>
            </div>
        </div>
        <h4>效果图展示</h4>
    </div>
    <div class="fitment-wrapper">
         <div class="fitment-list">
              @foreach ($data['case_list'] as $key=>$row)
                    <div class="fitment-one @if ( ($key + 1)%3== 0) f-three @endif">
                        <a class="fitment-img" data-id="{{ $row['rec_id'] }}"><img src="{{ $row['img_url'] }}" /><div></div></a>
                        <p class="case-name">{{ $row['name'] }}</p>
                    </div>
              @endforeach
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