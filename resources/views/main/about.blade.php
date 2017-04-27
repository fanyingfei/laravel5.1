@extends('main.main')

@section('content')
    <div class="about-wrapper">
        <ul class="about-side tab-menu">
            <li @if ( $data['curr'] == '') class="curr" @endif ><a href="/about">关于我们</a></li>
            <li @if ( $data['curr'] == 'bsk') class="curr" @endif ><a href="/about/bsk">预约查询</a></li>
            <li @if ( $data['curr'] == 'qua') class="curr" @endif ><a href="/about/qua">质保查询</a></li>
            <li @if ( $data['curr'] == 'faq') class="curr" @endif ><a href="/about/faq">常见问题</a></li>
        </ul>
        <div class="about-list">
            @if ( $data['curr'] == '')
                <h2>关于我们</h2>
                <div class="about-us">
                    <p>上海洵直装饰有限公司成立于2013年6月，注册资金100万，是一家集装饰设计、工程施工、材料配送、管理与咨询的综合性的装饰公司。</p>
                    <p>洵直，寓"忠信正直"。公司成立之后，一直恪守洵直的理念，尽心为用户提供优质的服务，将品牌声誉视同生命，以质量为本，设计为先的服务理念；以客户为中心，想客户之所想，全心全意做好服务；公司以准确的经营定位，独特的经营模式，以人为本的管理理念，使公司品牌口碑深入人心！</p>
                    <p>洵直以"省时，省力，省心，省钱，环保，安全，品质，售后"七大模块为基础进行运营，确保在实际操作中能够落到实处。一直以来公司把成本降到最低，把一切好处回馈与信任的顾客。</p>
                    <p>自2014年起，洵直推出室内翻新服务，解决装饰遗留下来的各类问题，以墙面、地面为主的整体或局部出现的问题进行翻新服务。优秀的施工团队，专业的施工设备及流程，对技术不断的分析及研究，打造最完善的室内翻新服务！</p>
                    <p> 洵直室内翻新服务主要以住宅、公寓、办公、商业、酒店、学校、医院等场所的施工，历史成交量已达千户之多，受到大家的一致好评。
                    一套套用心的服务，装满一户户幸福的笑容，一次次专业的施工，绘成一张张行业的名片，洵直室内翻新服务凭其近几年的诚信服务一步一个脚印走向辉煌，获得大众的认可。
                    </p>
                    <p><strong>服务项目</strong></p>
                    <p>1、涂料粉刷、墙面翻新、高档楼盘外墙涂料<br>
                       2、二手房简装、厨卫翻新、水电安装<br>
                       3、制作加工各企业，隔断、中高低档吊顶、瓷砖、地板<br>
                       5、制作各类衣柜、办公桌、展示柜等木质家具<br>
                       5、装饰配套工程、免漆木质门套、水电、各类装饰<br>
                       6、居家装饰、别墅、店铺装修、办公房装饰、学校厂房、中西式餐饮等精装修
                    </p>
                </div>
            @elseif ( $data['curr'] == 'bsk')
                <h2>预约查询</h2>
                <div class="query">
                    <p><input class="q-mobile" type="text" maxlength="11" placeholder="手机号码"><span data-type="all" class="p-sub">查询</span></p>
                    <div class="result-list"><p><strong>例：</strong><span>姓名：王先生</span><span>预约日期：2016-10-05</span><span>地址：浦东新区张江***</span></p></div>
                </div>
            @elseif ( $data['curr'] == 'qua')
                <h2>质保查询</h2>
                <div class="query">
                    <p><input class="q-mobile" type="text" maxlength="11" placeholder="手机号码"><span data-type="2" class="p-sub">查询</span></p>
                    <div class="result-list"><p><strong>例：</strong><span>姓名：王先生</span><span>质保期：1年&nbsp;&nbsp;[&nbsp;2016.05.24-2017.05.24&nbsp;]</span><span>地址：浦东新区张江***</span></p></div>
                </div>
            @elseif ( $data['curr'] == 'faq')
                <h2>常见问题</h2>
                <div class="faq-list">
                    <div class="faq-row">
                        <p class="q">墙面刷新服务如何收费？<span>-</span></p>
                        <p class="a">刷新服务的费用主要由施工面积与施工内容而决定，服务全透明，服务价格明码标价在官网可查，签订合同后不会有二次费用产生。<br>预约后，我们将安排专员免费上门作全面检测，制定施工方案，并给到合理的施工报价。收费项目主要由涂料及人工（含辅料）两部分构成。</p>
                    </div>
                    <div class="faq-row">
                        <p class="q">墙面施工面积如何计算？<span>+</span></p>
                        <p class="a">将有客户专员上门使用专业设备测量，以实测面积为准。</p>
                    </div>
                    <div class="faq-row">
                        <p class="q">不同墙面施工内容有什么差异？<span>+</span></p>
                        <p class="a">不同的墙面问题，施工的难度和内容有巨大差异。<br>墙面问题严重，如漏水、开裂，需要从墙面底层开始处理，包括铲底、补缝、找平、打磨、底漆、面漆等多种步骤。<br>所以从施工繁复程度、价格、工期都会与表层涂刷有差异，我们客户专员会根据您家墙面实际情况制定最合适的施工方案。</p>
                    </div>
                    <div class="faq-row">
                        <p class="q">墙面刷新施工周期一般需要多久？<span>+</span></p>
                        <p class="a">根据实际的施工面积和施工条件，一般来说，居家的局部刷新工期约为1-3天；若是一整套房子全部刷新，大约需要3-5天的时间。<br>如果碰到特殊情况（例如：墙体条件比较差、天气潮湿等状况）工期会稍有延迟。根据您的需求，一周7天均可以进行施工。</p>
                    </div>
                    <div class="faq-row">
                        <p class="q">墙面刷新期间可以正常入住生活吗？<span>+</span></p>
                        <p class="a">全程专业配套辅料，均为水性涂料，施工全程绝无添加一滴胶水，确保安全环保。<br>施工前负责搬移家具，施工后清洁归位，不会影响到您的健康和日常起居。</p>
                    </div>
                    <div class="faq-row">
                        <p class="q">刷新后墙面出现问题如何处理？<span>+</span></p>
                        <p class="a">我们的服务涂料辅料均为业界最高质量标准，施工人员经过严格的考核认证，因此您的墙面质量有充分的保证。<br>为确保您的放心，施工完成后，墙面服务最长两年的保修服务！可以通过<a target="_blank" href="/about/qua">「质保查询」</a>来查询您的质保信息</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop

@section('script')
<script>
$(function(){
    $('.faq-row').click(function(){
        if($(this).height() < 40){
            $(this).children('.a').fadeIn(300).end().siblings().children('.a').hide();
            $(this).find('span').html('-').end().siblings().find('span').html('+');
        }
    })

    $(".p-sub").click(function(){
        var mobile = $('.q-mobile').val();
        var token = $('#token').val();
        var bt = $('.p-sub').data('type');
        if( !mobile){
            alert('请输入手机号');
            return false;
        }

        if(!/^1[345789]\d{9}$/.test(mobile)){
            alert('请输入正确手机号');
            return false;
        }

        $.ajax({
            url:'/data/query',
            data:{'mobile':mobile,'t':bt},
            type:'post',
            dataType:'json',
            headers:{'X-CSRF-TOKEN':token},
            success:function(obj){
                if(obj.status == 'success'){
                    var html = '<p><strong>查询结果</strong></p>';
                    $.each(obj.data, function(k, v) {
                        if(bt == 'all'){
                            html += '<p><span>姓名：'+v.name+'</span><span>预约时间：'+v.create_time+'</span><span>地址：'+v.address+'</span>';
                        }else{
                            html += '<p><span>姓名：'+v.name+'</span><span>质保期：'+v.year+'年&nbsp;&nbsp;[&nbsp;'+v.keep_time+'&nbsp;]</span><span>地址：'+v.address+'</span>';
                        }
                        if(v['remark']) html += '<span>留言：'+v.remark+'</span></p>'
                        else html += '</p>';
                    })
                    $('.result-list').html(html);
                }else{
                    $('.result-list').html('<p><strong>'+obj.msg+'</strong></p>');
                }
            },
            error:function (){}
        })
    })
});
</script>
@stop