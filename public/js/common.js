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
    $("#top").click(function(){$('html,body').animate({scrollTop: 0}, 500);})

    $('body').on('click', '.close', function(){$('.modal-bg').hide(); })

    $('body').on('click', '.bespeak-submit', function(){
        var name = $('.b-name').val();
        var mobile = $('.b-mobile').val();
        var address = $('.b-address').val();
        var remark = $('.b-remark').val();
        var token = $('#token').val();
        if(!name || !mobile || !address){
            alert('请填写完整信息');
            return false;
        }

        if(!/^1[34578]\d{9}$/.test(mobile)){
            alert('请输入正确手机号');
            return false;
        }

        $.ajax({
            url:'/bespeak/save',
            data:{'mobile':mobile,'name':name,'address':address,'remark':remark},
            type:'post',
            dataType:'json',
            headers:{'X-CSRF-TOKEN':token},
            success:function(obj){
                alert(obj.msg);
                if(obj.status == 'success'){
                    $('.modal-bg').hide();
                }
            },
            error:function (){}
        })
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
