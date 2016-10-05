@extends('main')

@section('content')
    <div class="about-bg crumb-bg" id="MyMap"></div>
    <div class="about-wrapper">

    </div>
    <div class="faq-wrapper quality">
        <div>
            爱佳家

        </div>
        <p><input class="q-mobile" type="text" maxlength="11" placeholder="手机号码"><span class="q-sub">查询</span></p>
        <div class="card-list">
            <div class="quality-card">
                <p>质保卡</p>
                <p>质保期：<span class="time-val">*******</span></p>
            </div>
        </div>
    </div>
@stop

@section('script')
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
<script>
$(function(){

    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
    }

    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("MyMap");//在百度地图容器中创建一个地图
        var point = new BMap.Point(121.24,31.40);//定义一个中心点坐标
        map.centerAndZoom(point,15);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }

    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
     //   map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }

    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_RIGHT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
	var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:0});
	map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_TOP_RIGHT});
	map.addControl(ctrl_sca);
    }

    //标注点数组
    var markerArr = [{title:"范家大少",content:"1号楼305室",point:"121.24|31.40",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
		 ];
    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
			var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
			var iw = createInfoWindow(i);
			var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
			marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                        borderColor:"#808080",
                        color:"#000",
                        cursor:"pointer"
            });

			(function(){
				var index = i;
				var _iw = createInfoWindow(i);
				var _marker = marker;
				_marker.addEventListener("click",function(){
				    this.openInfoWindow(_iw);
			    });
			    _iw.addEventListener("open",function(){
				    _marker.getLabel().hide();
			    })
			    _iw.addEventListener("close",function(){
				    _marker.getLabel().show();
			    })
				label.addEventListener("click",function(){
				    _marker.openInfoWindow(_iw);
			    })
				if(!!json.isOpen){
					label.hide();
					_marker.openInfoWindow(_iw);
				}
			})()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }

    initMap();//创建和初始化地图

    $(".q-sub").click(function(){
            var mobile = $('.q-mobile').val();
            var token = $('#token').val();
            if( !mobile){
                alert('请输入手机号');
                return false;
            }

            if(!/^1[34578]\d{9}$/.test(mobile)){
                alert('请输入正确手机号');
                return false;
            }

            $.ajax({
                url:'/quality/query',
                data:{'mobile':mobile},
                type:'post',
                dataType:'json',
                headers:{'X-CSRF-TOKEN':token},
                success:function(obj){
                    if(obj.status == 'success'){
                        var html = '';
                        $.each(obj.data, function(k, v) {
                            $('.quality-card').eq(0).find('.time-val').html(v.keep_time);
                            html += '<div class="quality-card">'+$('.quality-card').eq(0).html()+'</div>';
                        })
                        $('.card-list').html(html);
                    }else{
                        alert(obj.msg);
                    }
                },
                error:function (){}
            })
        })
});
</script>
@stop