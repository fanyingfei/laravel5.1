@extends('retrofit')

@section('retrofit-info')
    <ul class="retrofit-tab retrofit-info">
        <li>服务介绍：</li>
        <li><a class="curr">服务简介</a></li>
        <li><a>服务流程</a></li>
        <li><a>服务价格</a></li>
        <li><a>案例分享</a></li>
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
                <div class="cat-img"><img src="http://ww1.sinaimg.cn/mw690/ce768b7ajw1f89oy24oygj20a006f0ta.jpg" /></div>
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
                <div class="flow-img"><img src="/img/retrofit/p01.jpg" /></div>
                <div class="flow-step"><strong>01</strong><span>免费检测</span></div>
                <div class="flow-content">免费上门为您检测墙面状况，测量施工墙面面积，为施工方案提供准确依据</div>
            </div>
            <div>
                <div class="flow-img"><img src="/img/retrofit/p02.jpg" /></div>
                <div class="flow-step"><strong>02</strong><span>制定方案</span></div>
                <div class="flow-content">根据墙面状况指定施工方案，包括墙面漆、腻子的选择，施工周期和施工预算，并签定合同</div>
            </div>
            <div class="flow-right">
                <div class="flow-img"><img src="/img/retrofit/p04.jpg" /></div>
                <div class="flow-step"><strong>03</strong><span>搬移保护</span></div>
                <div class="flow-content">我们帮您搬移家具，并保护家具、地板、灯具和开关等，避免磕碰弄脏，让您安心放心</div>
            </div>
            <div>
                <div class="flow-img"><img src="/img/retrofit/p04.jpg" /></div>
                <div class="flow-step"><strong>04</strong><span>无尘打磨</span></div>
                <div class="flow-content">我们有经验丰富的施工团队，打磨无灰尘，丝毫不影响您的生活，为您提供优势、高效的服务</div>
            </div>
            <div>
                <div class="flow-img"><img src="/img/retrofit/p04.jpg" /></div>
                <div class="flow-step"><strong>05</strong><span>清洁归位</span></div>
                <div class="flow-content">所有墙面涂新完成后，我们帮您把家具归位，并清理房间，验收完所有施工项目后才收取尾款</div>
            </div>
            <div class="flow-right">
                <div class="flow-img"><img src="/img/retrofit/p03.jpg" /></div>
                <div class="flow-step"><strong>06</strong><span>售后保证</span></div>
                <div class="flow-content">施工完成后，我们为您提供一年质保期，全铲除型质保两年</div>
            </div>
        </div>
    </div>
    <div class="f-content">
    <p class="p-price"><strong>修补型：</strong>&nbsp;&nbsp;60/㎡<span>包含：人工 25/㎡</span><span>辅材 15/㎡</span><span>涂料 20/㎡</span></p>
    <p class="p-price"><strong>铲除型：</strong>100/㎡<span>包含：人工 45/㎡</span><span>辅材 35/㎡</span><span>涂料 20/㎡</span></p>
    <table class="wall-price"  border="1" cellpadding="3">
        <tr class="table-th">
            <td width="60">编号</td>
            <td width="350">服务内容</td>
            <td width="75">单位</td>
            <td width="110">单价（元）</td>
            <td width="150">最低收费（元）</td>
            <td width="415">服务说明</td>
        </tr>
        <tr>
            <td>1</td>
            <td>施工乳胶漆服务费</td>
            <td>平米</td>
            <td>15</td>
            <td>1200</td>
            <td>适用于家中有简单家具，墙面情况完好，无需修补，<br>直接涂刷（1遍底漆+2遍乳胶漆）</td>
        </tr>
        <tr>
            <td>2</td>
            <td>局部修补打磨后施工乳胶漆服务费</td>
            <td>平米</td>
            <td>25</td>
            <td>1500</td>
            <td>适用于墙体基层牢固，局部污渍/磕碰等情况，问题部位修补，<br>打磨后涂刷（1遍底漆+2遍乳胶漆）</td>
        </tr>
        <tr>
            <td>3</td>
            <td>满批腻子后施工乳胶漆服务费</td>
            <td>平米</td>
            <td>35</td>
            <td>2000</td>
            <td>适用于墙体基层牢固，无粉化脱离情况， 或 无基层新 墙体， <br>批两遍腻子，打磨后涂刷（1遍底漆+2遍乳胶漆）</td>
        </tr>
        <tr>
            <td>4</td>
            <td>铲除原基层， 批刮腻子后施工乳胶漆服务费</td>
            <td>平米</td>
            <td>45</td>
            <td>2000</td>
            <td>适用于基层墙体松动、脱落、需铲除，做基层粉刷修补，批两遍腻子，<br>打磨后涂刷（1遍底漆+2遍乳胶漆）</td>
        </tr>
        <tr>
            <td>5</td>
            <td>铲除墙纸及原基层， 批刮腻子 后施工乳胶漆服务费</td>
            <td>平米</td>
            <td>55</td>
            <td>2000</td>
            <td>适用于墙纸与基层铲除，基底找平，批2遍腻子，<br>打磨后涂刷（1遍底漆+2遍乳胶漆）</td>
        </tr>
        <tr>
            <td>6</td>
            <td>铲除原基层，贴网格布满批腻子后施工乳胶漆服务费</td>
            <td>平米</td>
            <td>60</td>
            <td>2000</td>
            <td>根据客户需求全部铲除原基层后， 满贴网格 布、腻子找平，<br>打磨后涂刷（1遍底漆+2遍乳胶漆）</td>
        </tr>
        <tr>
            <td>7</td>
            <td>铲除原墙体已松动的植（纸）筋灰， 批刮植（纸）筋 后施工乳胶漆服务费</td>
            <td>平米</td>
            <td>65</td>
            <td>2000</td>
            <td>根据客户需求全部铲除 已松动的植筋灰，批刮新 的植筋，<br>打磨后涂刷（1遍底漆+2遍乳胶漆）</td>
        </tr>
        <tr>
            <td>8</td>
            <td>辅助材料（1-2 项服务增收）<br>辅助材料（3-7 项服务增收）</td>
            <td>平米</td>
            <td>15/35</td>
            <td></td>
            <td>腻子粉、界面剂、遮蔽膜、滚筒、毛刷、美纹纸、砂皮、设备折旧费</td>
        </tr>
        <tr>
            <td>9</td>
            <td>木器漆基本型-参考价</td>
            <td>平米</td>
            <td>90</td>
            <td>300</td>
            <td>打磨后涂刷，根据不同的造型和工艺，可能会产生额外的费用</td>
        </tr>
        <tr>
            <td>10</td>
            <td>木器漆修补型-参考价</td>
            <td>平米</td>
            <td>110</td>
            <td>500</td>
            <td>采取相同的工艺修补打磨后涂刷，根据不同的造型和工艺，<br>可能会产生额外的费用</td>
        </tr>
        <tr>
            <td>11</td>
            <td>木器漆-踢脚线-参考价</td>
            <td>米</td>
            <td>20</td>
            <td>200</td>
            <td>清洗后涂刷</td>
        </tr>
        <tr>
            <td>12</td>
            <td>木器、地板找平</td>
            <td>平米</td>
            <td>5</td>
            <td>500</td>
            <td>适合于局部修补后变形、凸起的平整度较差的门板、地板，<br>根据实际情况签约前同业主确认</td>
        </tr>
        <tr>
            <td>13</td>
            <td>墙面找平</td>
            <td>间</td>
            <td></td>
            <td>300</td>
            <td>适合于局部修补后墙面凸起、变形、倾斜的墙面，<br>根据实际情况签约前同业主确认</td>
        </tr>
        <tr>
            <td>14</td>
            <td>仅墙顶面施工</td>
            <td>间</td>
            <td>200</td>
            <td>200</td>
            <td>若墙面无须施工，仅施工墙顶，需要加收200元/间的增费</td>
        </tr>
        <tr>
            <td>15</td>
            <td>深色乳胶漆施工</td>
            <td>平米</td>
            <td>8</td>
            <td></td>
            <td>多乐士色号R3及以上的颜色为深色，立邦色号VX以上为深色</td>
        </tr>
        <tr>
            <td>16</td>
            <td>墙面特殊造型</td>
            <td>户</td>
            <td></td>
            <td>普通漆200元起收<br>立体漆400元起收</td>
            <td>灯池台阶、凹槽、三角形等异型特殊造型，<br>根据实际情况签约前同业主确认</td>
        </tr>
        <tr>
            <td>17</td>
            <td>内墙防水材料涂刷</td>
            <td>平米</td>
            <td>15</td>
            <td>150</td>
            <td>涂刷防水浆两遍</td>
        </tr>
        <tr>
            <td>18</td>
            <td>墙面乳胶漆喷涂</td>
            <td>平米</td>
            <td>10</td>
            <td>200</td>
            <td>喷涂底漆+面漆，在以上报价基础上增加</td>
        </tr>
        <tr>
            <td>19</td>
            <td>喷涂施工分色费</td>
            <td>间</td>
            <td>100</td>
            <td>100</td>
            <td>一个房间内有两中颜色，需要加收分色费</td>
        </tr>
        <tr>
            <td>20</td>
            <td>超高作业</td>
            <td>户</td>
            <td></td>
            <td>200元起收</td>
            <td>层高3.5米及以上，根据实际情况签约前与业主确认</td>
        </tr>
        <tr>
            <td>21</td>
            <td>建筑垃圾清理</td>
            <td>车</td>
            <td>350</td>
            <td>350</td>
            <td>将建筑垃圾运输至小区外垃圾站处理</td>
        </tr>
        <tr>
            <td>22</td>
            <td>家具搬移与遮蔽保护、清洁、归位</td>
            <td>间</td>
            <td>0</td>
            <td>免费</td>
            <td>施工前进行家具搬移和遮蔽保护;免费服务</td>
        </tr>
    </table>
    </div>
@stop
