$(function(){
    $.fn.swBanner=function(options){
        var defaults={
            animateTime:300,
            delayTime:5000
        }
        var setting=$.extend({},defaults,options);

        return this.each(function(){
            $obj=$(this);
            var o=setting.animateTime;
            var d=setting.delayTime;
            var $oban=$obj.find(".banList li");
            var _len=$oban.length;
            var $nav=$obj.find(".fomW a");
            var _index=0;
            var timer;
            //图片轮换
            function showImg(n){
                $oban.eq(n).addClass("active").siblings().removeClass("active");
                $nav.eq(n).addClass("current").siblings().removeClass("current");
            }
            //自动播放
            function player(){
                timer=setInterval(function(){
                    var _index=$obj.find(".fomW").find("a.current").index();
                    showImg((_index+1)%_len);
                },d)
            }
            $nav.click(function(){
                if(!($oban.is(":animated"))){
                    _index=$(this).index();
                    showImg(_index);
                }
            });
            $oban.hover(function(){clearInterval(timer);},function(){player();});
            player();
        });
    }

    $(".tag-bg .tab").click(function(){
        $(this).addClass("current").siblings().removeClass("current");
        var data_id = $(this).attr('data-id');
        $("#tab-img-"+data_id).show(500).siblings().hide(500);
    });

    $(".retrofit-info li").click(function(){
        $(this).children('a').addClass("curr").end().siblings().children('a').removeClass("curr");
        var index = $(this).index() - 1;
        $('.f-content').eq(index).fadeIn().siblings().hide();
    });

    footer_bottom();
    function footer_bottom(){
        var win_height = $(window).height();
        var footer_top = $('.footer').offset().top;
        var footer_height = $('.footer').height();
        if(footer_top + footer_height < win_height){
            $('.footer').addClass('footer-bottom');
        }else{
            if($('.footer').hasClass('footer-bottom')) $('.footer').removeClass('footer-bottom');
        }
    }

    window.onresize=function(){footer_bottom();}

    //监听到顶部点击事件
    $("#top").click(function(){
        $('html,body').animate({scrollTop: 0}, 500);
    })

    //监听滚动条滚动事件
    $(window).scroll(function(){
        if($(window).scrollTop() >$(window).height()/2){
            $("#top").show();
        }else{
            $("#top").hide();
        }
    });
});
