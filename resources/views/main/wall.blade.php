@extends('retrofit')

@section('retrofit-info')
    <ul class="tab-list tab-menu">
        <li>服务介绍：</li>
        <li><a href="#1" class="curr">服务简介</a></li>
        <li><a href="#2">服务流程</a></li>
        <li><a href="#3">服务价格</a></li>
        <li><a href="#4">案例分享</a></li>
    </ul>
@stop

@section('tab-content')
    <div class="f-content">
        <h4>服务介绍</h4>
        <p>墙壁色彩一向是家中装修的重要项目， 干净、整洁的墙面往往给人一种自然舒适的感觉。</p>
        <p class="wall-problem">墙面刷新，轻松为您解决<strong>开裂</strong>、<strong>起皮</strong>、<strong>霉变</strong>、<strong>渗水</strong>等各种问题，给您的生活一个华丽的变身。</p>
        <p>只需轻松拨打一个电话，我们的专业人员就会上门为你定制墙面改造计划和具体施工方案。您也不必担心日常生活会因为施工而受到影响，我们贴心周到的服务能为您免去一切家装施工带来的后顾之忧——细致的家具遮蔽业务能够保护您的家具和地板免受涂料的“亲密接触”。而施工后，工作人员也会带走所有的施工垃圾，还原一个整洁的家居环境。优质环保的涂料产品、时尚个性的配色方案、专业体贴的施工团队，让您的小窝在短短几日之内就能焕然一新！</p>
        <h4>服务特点</h4>
        <p class="wall-sevice"><strong>安全环保</strong>施工空气甲醛含量24小时监控，全水性材料，只选用多乐士、立邦品牌水性涂料</p>
        <p class="wall-sevice"><strong>全程省心</strong>无需您搬家，无需您遮蔽，无需您清洁，轻松焕新</p>
        <p class="wall-sevice"><strong>品质保证</strong>满意后付尾款，1年质保，全铲除型质保2年</p>
        <h4>刷新项目</h4>
        <div class="cat-list">
            <div style="background-color:#995c49;">
                <div class="cat-img"><img src="http://ww3.sinaimg.cn/mw690/ce768b7ajw1f8flm9mnc0j20ad0763z2.jpg" /></div>
                <div class="cat-content">焕新墙面颜色</div>
            </div>
            <div style="background-color:#518db4;">
                <div class="cat-img"><img src="http://ww1.sinaimg.cn/mw690/ce768b7ajw1f89oq3pbk4j206a0563yg.jpg" /></div>
                <div class="cat-content">解决墙面问题</div>
            </div>
            <div style="background-color:#5e9e84;">
                <div class="cat-img"><img src="http://ww2.sinaimg.cn/mw690/ce768b7agw1f89p32vpcdj20b3077mxp.jpg" /></div>
                <div class="cat-content">翻新木质家具</div>
            </div>
            <div style="background-color:#5099c3;">
                <div class="cat-img"><img src="http://ww1.sinaimg.cn/mw690/ce768b7agw1f89p6vcjcxj20o40fen3b.jpg" /></div>
                <div class="cat-content">外墙刷新</div>
            </div>
        </div>
    </div>
    <div class="f-content">
        <div class="flow-list">
            <div>
                <div class="flow-img"><img src="http://ww2.sinaimg.cn/large/ce768b7ajw1f8evk0giwwj20dw09274p.jpg" /></div>
                <div class="flow-step"><strong>01</strong><span>免费检测</span></div>
                <div class="flow-content">免费上门为您检测墙面状况，测量施工墙面面积，为施工方案提供准确依据</div>
            </div>
            <div>
                <div class="flow-img"><img src="http://ww1.sinaimg.cn/mw690/ce768b7ajw1f8evmnnpsqj2095064jrd.jpg" /></div>
                <div class="flow-step"><strong>02</strong><span>制定方案</span></div>
                <div class="flow-content">根据墙面状况指定施工方案，包括墙面漆、腻子的选择，施工周期和施工预算，并签定合同</div>
            </div>
            <div class="flow-right">
                <div class="flow-img"><img src="http://ww2.sinaimg.cn/mw690/ce768b7ajw1f8evrhhy4ej20dw0b476b.jpg" /></div>
                <div class="flow-step"><strong>03</strong><span>搬移保护</span></div>
                <div class="flow-content">我们帮您搬移家具，并保护家具、地板、灯具和开关等，避免磕碰弄脏，让您安心放心</div>
            </div>
            <div>
                <div class="flow-img"><img src="http://ww3.sinaimg.cn/large/ce768b7ajw1f8evtw7yuzj2094064q2v.jpg" /></div>
                <div class="flow-step"><strong>04</strong><span>无尘打磨</span></div>
                <div class="flow-content">我们有经验丰富的施工团队，打磨无灰尘，丝毫不影响您的生活，为您提供优势、高效的服务</div>
            </div>
            <div>
                <div class="flow-img"><img src="http://ww4.sinaimg.cn/mw690/ce768b7ajw1f8evxmai24j20dw096aap.jpg" /></div>
                <div class="flow-step"><strong>05</strong><span>清洁归位</span></div>
                <div class="flow-content">所有墙面涂新完成后，我们帮您把家具归位，并清理房间，验收完所有施工项目后才收取尾款</div>
            </div>
            <div class="flow-right">
                <div class="flow-img"><img src="http://ww2.sinaimg.cn/mw690/ce768b7ajw1f8f0gp952mj20dy09xmxh.jpg" /></div>
                <div class="flow-step"><strong>06</strong><span>售后保证</span></div>
                <div class="flow-content">施工完成后，我们为您提供一年质保期，全铲除型质保两年。质保信息<a target="_blank" href="/about/qua">「查询地址」</a></div>
            </div>
        </div>
    </div>
    <table class="wall-price f-content"  border="1" cellpadding="3">
        <tr class="table-th">
            <td width="150">服务名称</td>
            <td width="230">服务内容</td>
            <td width="75">单位</td>
            <td width="110">单价（元）</td>
            <td width="280">施工周期及预期</td>
            <td width="295">适应场景</td>
        </tr>
        <tr class="row-gray">
            <td>快速刷新</td>
            <td>上门检测，涂刷工具，打磨涂刷 二遍面漆</td>
            <td>平米</td>
            <td>16</td>
            <td>最快一天 最低1000元起</td>
            <td>无墙面问题的 出租房和老房</td>
        </tr>
        <tr>
            <td>基础刷新</td>
            <td>上门检测，成品保护，局部修补 打磨刷漆，清理归位</td>
            <td>平米</td>
            <td>26</td>
            <td>三天左右 最低1200元起</td>
            <td>墙体基层牢固局部有 污渍磕碰或有轻微裂缝</td>
        </tr>
        <tr class="row-gray">
            <td>深度刷新</td>
            <td>上门检测，成品保护，披刮腻子 打磨刷漆，清理归位</td>
            <td>平米</td>
            <td>48</td>
            <td>三天左右 最低2000元起</td>
            <td>适用于墙体疏松，龟裂 脱落等情况</td>
        </tr>
        <tr>
            <td>全刷新</td>
            <td>上门检测，成品保护，旧墙铲除 基层找平，打磨刷漆，清理归位</td>
            <td>平米</td>
            <td>72</td>
            <td>七天左右，防裂网8元/平米 最低2000元起</td>
            <td>发霉脱落 开裂粉化</td>
        </tr>
    </table>
@stop
