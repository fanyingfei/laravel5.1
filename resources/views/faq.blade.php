@extends('main')

@section('content')
    <div class="faq-bg crumb-bg"></div>
    <div class="faq-wrapper">
        <div class="faq-list">
            <div class="faq-row">
                <p class="q">墙面刷新服务如何收费？<span>-</span></p>
                <p class="a">刷新服务的费用主要由施工面积与施工内容而决定，我们的服务是全透明的，服务价格明码标价在官网可查，签订合同后不会有二次费用产生。<br>预约后，我们将安排专员免费上门作全面检测，量身制定施工方案，并给到合理的施工报价。收费项目主要由涂料及人工（含辅料）两部分构成。</p>
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
                <p class="a">我们的服务涂料辅料均为业界最高质量标准，施工人员经过严格的考核认证，因此您的墙面质量有充分的保证。<br>为确保您的放心，施工完成后，墙面服务最长两年的保修服务！</p>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
$(function(){
    $('.faq-row').click(function(){
        if($(this).height() < 40){
            $(this).children('.a').fadeIn(500).end().siblings().children('.a').hide();
            $(this).find('span').html('-').end().siblings().find('span').html('+');
        }
    })
});
</script>
@stop