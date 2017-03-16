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

    $(".tab-menu li").click(function(){
        $(this).children('a').addClass("curr").end().siblings().children('a').removeClass("curr");
        var index = $(this).index() - 1;
        $('.f-content').eq(index).fadeIn().siblings().hide();
    });

    //监听到顶部点击事件
    $("#top").click(function(){$('html,body').animate({scrollTop: 0}, 500);})

    $('body').on('click', '.close', function(){$('.modal-bg').hide();})

    $('body').on('click', '.modal-bg', function(){$('.modal-bg').hide();})

    $('body').on('click', '.modal-bg > div', function(){return false;})

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
            data:{'mobile':mobile,'name':name,'address':address,'remark':remark,'t':'bespeak'},
            type:'post',
            dataType:'json',
            headers:{'X-CSRF-TOKEN':token},
            success:function(obj){
                if(obj.status == 'success'){
                    alert('预约成功');
                    $('.modal-bg').hide();
                }else{
                    alert(obj.msg);
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

function change_tab(){
    var url = window.location.href;
    if(url.indexOf("#")<0) return false;
    var tab = url.substr(-1);
    $('.tab-menu li').eq(tab).children('a').addClass("curr");
    $('.tab-menu li').eq(tab).siblings().children('a').removeClass("curr");
    $('.f-content').eq(tab-1).fadeIn().siblings().hide();
}

function query_bsk(){
    window.location.href="/about/bsk";
}

function bespeak(){
    var html = '';
    html += '<div class="bespeak-info"><p class="close">×</p>';
    html += '<div class="bespeak-row"><div>姓名</div><div><input class="b-name" type="text" maxlength="30" ></div></div>';
    html += '<div class="bespeak-row"><div>手机</div><div><input class="b-mobile" type="text" maxlength="11" ></div></div>';
    html += '<div class="bespeak-row"><div>地址</div><div><input class="b-address" type="text" ></div></div>';
    html += '<div class="bespeak-row"><div>留言</div><div><textarea class="b-remark" type="text" ></textarea></div></div>';
    html += '<div class="bespeak-row"><div></div><div><div class="bespeak-submit">马上预约</div></div><a onclick="query_bsk()" class="query-bespeak">已经预约？立即查询</a></div>';
    $('.modal-bg').html(html);
    $('.modal-bg').show();
}