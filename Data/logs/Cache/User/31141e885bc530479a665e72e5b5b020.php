<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="keywords" content="<?php echo C('keyword');?>" />
    <meta name="description" content="<?php echo C('content');?>" />  
    <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/iindex.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_responsive_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/sstyle.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/todc_bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/themes.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/inside.css" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/inside.js"></script>
<title><?php echo C('site_name');?>-<?php echo C('site_title');?></title>
<link rel="shortcut icon" href="/tpl/static/favicon.ico" />


</head>
<body>
	
    <div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">
                    <div class="box">
                        <div class="box-title">
                            <div class="span10">
                                <h3><i class="icon-edit-sign"></i>功能介绍</h3>
                            </div>
                            <div class="span2"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
                        </div>
                        <!--微活动-->
                         <div class="row-fluid">
                            <div class="box-title">
                           <h4 class="text-warning"><strong class="text-info">微活动：</strong>优惠券+刮刮卡+大转盘</h4>
                           <h5>微活动，强大的交互体验，极大提高了用户粘性和粉丝活跃度。</h5>

                        </div>

                       <div class="box-content">

                        <ul id="myTab" class="nav nav-tabs">
                          <li class="active"><a href="#Coupon" data-toggle="tab">优惠券</a></li>
                          <li class=""><a href="#Scratch" data-toggle="tab">刮刮卡</a></li>
                          <li class=""><a href="#Wheel" data-toggle="tab">大转盘</a></li>
                         
                        </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="Coupon">
                <dl>
                	<dt class="span7">
                    	<p>优惠券是用于微信上与顾客互动的一种营销方式，不仅可以展现自己的产品，更能让顾客在使用此项功能时感受到更多的乐趣。</p>
                        <h3>使用方法：</h3>
                        <p>1、新建优惠券活动；</p>
                        <p>2、填写活动开始的内容；</p>
                        <p>3、填写活动结束的内容；</p>
                        <p>4、设置奖项，设定活动时间、中奖几率、触发关键词和相应的奖品，确定设置后系统会根据设定的中奖几率产生相应的SN码，保存活动；</p>
                        <p>5、设置活动开始；（点击开始活动后，就不能再修改活动奖项，但可以修改其他活动内容,活动开启会自动生成SN码，也就是兑奖码）</p>
                        <p>6、设置活动结束；（你设置的活动结束时间到了会自动结束活动，你也可以时间没有到直接结束活动）</p>
                        <p>7、兑奖，查看活动粉丝中奖详情；（点击SN码管理查看详情）通过设置SN码状态，可以将一等奖先不放出！要内部人员中奖，只要对着公众号，输入：刮奖 SN码 即可！</p>
                        <p>8、删除活动（最好是在最后兑奖时间过了，再删除活动）</p>
                        <p>备注：每个网友每次活动只能领取一张优惠劵。</p>
                    </dt>
                    <dd class="span5"><img src="<?php echo RES;?>/img/Coupon.png"></dd>
                </dl>
              </div>

              <div class="tab-pane fade" id="Scratch">
                <dl>
                	<dt class="span7">
                    	<p>该模块可为商家提供刮刮卡抽奖服务，全网第一个可以通过微信玩刮刮卡，用户通过手机屏幕进行刮奖的游戏！</p>
                        <H3>使用方法：</H3>
                        <p>1、设置抽奖前需要先编辑一条图文消息，提前一天或者当天推送给所有粉丝，告知在某个时间段发某个关键词可以参与刮奖；</p>
                        <p>2、进入抽奖设置，设定活动时间、中奖几率、触发关键词和相应的奖品，确定设置后系统会根据设定的中奖几率产生相应的SN码；</p>
                        <p>3、活动设定后，在规定时间到时，网友发送关键词如“我要抽奖”，就会发送给他一张刮刮卡，粉丝通过屏幕进行刮奖，中奖后会得到一个SN码，网友到店时向商家出示SN码，商家根据系统产生的SN码进行比对，确认无误后即可兑换奖品。</p>
                        <p>备注：每个网友每次活动只能参与一次刮奖。</p>
                    </dt>
                    <dd class="span5"><img src="<?php echo RES;?>/img/Scratch.png"></dd>
                </dl>
              </div>

             <div class="tab-pane fade" id="Wheel">
                 <dl>
                	<dt class="span7">
                    	<p>该模块可为商家提供转盘抽奖服务，商家通过设置活动时间，预计参加抽奖人数，相应奖项和触发关键词，由网友在线参与抽奖。</p>
                        <h3>使用方法：</h3>
                        <P>1、设置抽奖前需要先编辑一条图文消息，提前一天或者当天推送给所有粉丝，告知在某个时间段发某个关键词可以参与抽奖；</P>
                        <P>2、进入抽奖设置，设定活动的类别，设定活动的预热时间，已经活动的开始和结束时间，设置活动回复关键词“我要抽奖”，确定设置后系统会根据设定的中奖几率产生相应的SN码；</P>
                        <p>3、活动设定后，在规定时间到时，网友发送关键词如“我要抽奖”，就可以参与三次转盘，中奖后会得到一个SN码，网友到店时向商家出示SN码，商家根据系统产生的SN码进行比对，确认无误后即可兑换奖品。</p>
                        <p>备注：每个网友每次活动只能领取一张优惠劵。</p>
                    </dt>
                    <dd class="span5"><img src="<?php echo RES;?>/img/Wheel.png"></dd>
                </dl>
              </div>

              <div class="tab-pane fade" id="Vote">
                <dl>
                	<dt class="span7">
                    	<p>商家采用投票的活动来吸引用户，与用户之间产生互动，从而促进企业营销的一种手段。</p>
                        <h3>使用方法：</h3>
                        <p>1、商家发布一个活动名称，例如：“您愿意把介绍给您的朋友吗？”商家还可以为本次活动上传封面，吸引更多的用户来参加；</p>
                        <p>2、商家可以设置两个选项：愿意、不愿意，每个用户只能选择一个选项；</p>
                        <p>3、设置活动的回复关键词为“我要投票”；</p>
                        <p>4、编辑活动说明，例如：“每位参与投票的朋友都将获得商家送出的尊贵礼品，同时你还将参加抽奖，有机会获得iphone5等大奖。”；</p>
                        <p>5、设置活动的起开始时间和活动的结束时间。</p>
                    </dt>
                    <dd class="span5"><img src="<?php echo RES;?>/img/Vote.png"></dd>
                </dl>
              </div>

            
            </div>
          </div>
          </div>

                        <!--微服务-->

                         <div class="row-fluid">
                            <div class="box-title">
                            <h4 class="text-warning"><strong class="text-info">微服务：</strong>微信企业应用与电子商务</h4>
                            <h5>自定义菜单、无需重新开发APP</h5>

                        </div>
              <div class="box-content ">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#weather" data-toggle="tab">城市天气</a></li>
              <li class=""><a href="#bk" data-toggle="tab">百度百科</a></li>
              <li class=""><a href="#translate" data-toggle="tab">即时翻译</a></li>
              <li class=""><a href="#stock" data-toggle="tab">股票查询</a></li>
              <li class=""><a href="#delivery" data-toggle="tab">快递查询</a></li>
              <li class=""><a href="#bus" data-toggle="tab">火车查询</a></li>
              <li class=""><a href="#flight" data-toggle="tab">航班查询</a></li>
              <li class=""><a href="#rules" data-toggle="tab">星座密语</a></li>
 
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="weather">
                <dl>
                	<dd class="span5">
                    <img src="<?php echo RES;?>/img/weather.jpg" >
                    </dd>
                    <dt class="span5">
                    <p>城市天气是运用于微信公众平台上让用户随时随地查询天气情况的一种功能，更能方便用户的出行。</p>
                    <h3>使用方法：</h3>
                    <p>1、开通城市天气服务，在状态栏选择“ON”即可；</p>
                    <p>2、用户只需输入“所在的城市+天气“，就能查询到所在城市的天气情况。</p>
                    <p></p>
                    <p></p>
                     </dt>
                </dl>
              </div>

              <div class="tab-pane fade" id="bk">
                <dl>

                	<dd class="span5">
                    <img src="<?php echo RES;?>/img/bk.jpg" >
                    </dd>
                    <dt class="span5">
                    <p>百度百科利用微信为用户提供一个创造性的移动互联网平台，充分调动互联网所有用户的力量，汇聚上亿用户的头脑智慧，积极进行交流和分享，同时实现与搜索引擎的完美结合，从不同的层次上满足用户对信息的需求。</p>
                    <h3>使用方法：</h3>
                    <p>1、开通百度百科服务，在状态栏选择“ON”即可；</p>
                    <p>2、用户只需输入“百科查询内容“，如”百科姚明“，就能查询到姚明的所有相关资料。</p>
                     </dt>
                </dl>
              </div>

             <div class="tab-pane fade" id="translate">
                 <dl>
                	<dd class="span5">
                    <img src="<?php echo RES;?>/img/translate.jpg" >

                    </dd>
                    <dt class="span5">
                    <p>即时翻译是一款基于微信平台的翻译软件，支持语音输入与文本输入及发音，目前支持汉语、英语、汉语、日语、法语、德语、意大利语、西班牙语、捷克语、俄语和土耳其语之间的互相翻译。</p>
                    <h3>使用方法：</h3>
                    <p>1、开通即时翻译服务，在状态栏选择“ON”即可；</p>
                    <p>2、用户只需要输入“翻译查询内容（中文或英文）”，即可以查询到所要翻译的内容。</p>
                     </dt>
                </dl>
              </div>

              <div class="tab-pane fade" id="stock">
                <dl>
                	<dd class="span5">
                    <img src="<?php echo RES;?>/img/stock.jpg">

                    </dd>
                    <dt class="span5">
                    <p>股票查询是一款基于微信平台查询股票最动态的软件，能够方便用户理财。</p>
                    <h3>使用方法：</h3>
                    <p>1、开通股票查询服务，在状态栏选择“ON”即可；</p>
                    <p>2、用户只需输入"股票+数字代码 或 股票+字母缩写"，如“股票payh、股票000001”，就可以查询到股票的最新动态。</p>
                     </dt>
                </dl>
              </div>

              <div class="tab-pane fade" id="delivery">
                 <dl>

                	<dd class="span5">
                    <img src="<?php echo RES;?>/img/delivery.jpg">
                    </dd>
                    <dt class="span5">
                    <p>快递用户通过进入到快递查询公众账号，持快递公司邮单号，对包裹快递过程进行跟踪查询。</p>
                    <h3>使用方法：</h3>
                    <p>1、开通快递查询服务，在状态栏选择“ON”即可；</p>
                    <p>2、用户只需输入“ 快递单号”，如”查申通快递222222“，就可以查询到快递的最新动态。</p>
                     </dt>
                </dl>
              </div>

                <div class="tab-pane fade" id="bus">
                  <dl>
                	<dd class="span5">

                    <img src="<?php echo RES;?>/img/bus.jpg">
                    </dd>
                    <dt class="span5">
                    <p>火车查询是一款基于微信平台的火车查询工具，用户可以通过火车查询公众平台随时随地查询火车班次时刻表。</p>
                    <h3>使用方法：</h3>
                    <p>1、开通火车查询服务，在状态栏选择“ON”即可；</p>
                    <p>2、用户只需输入“ 火车车次”，如“ 火车T109“，就可以查询到火车的最新动态。</p>
                     </dt>
                </dl>
              </div>

                <div class="tab-pane fade" id="rules">
                 <dl>
                	<dd class="span5">
                    <img src="<?php echo RES;?>/img/flight.jpg" >

                    </dd>
                    <dt class="span5">
                    <p>航班查询是一款基于微信平台的为用户提供实时航班查询的服务，用户可以通过航班查询公众平台随时随地查询到航班的最新动态。</p>
                    <h3>使用方法：</h3>
                    <p>1、开通航班查询服务，在状态栏选择“ON”即可；</p>
                    <p>2、用户只需输入“ 航班班次”，如“CZ5108“，就可以查询到航班的最新动态。</p>
                     </dt>
                </dl>
              </div>

                <div class="tab-pane fade" id="rules">
                 <dl>

                	<dd class="span5">
                    <img src="<?php echo RES;?>/img/rules.jpg" >
                    </dd>
                    <dt class="span5">
                    <p>星座密语是一款基于微信平台的为用户提供星座查询的服务，用户可以通过星座密语公众平台随时随地查询到星座的最新动态。</p>
                    <h3>星座密语</h3>
                    <p>1、开通星座密语服务，在状态栏选择“ON”即可；</p>
                    <p>2、用户只需输入“ 星座”，如“射手座“，就可以查询到射手座相关的星座信息。</p>
                     </dt>
                </dl>
              </div>

            </div>
          </div>
          </div>
          
            <div class="row-fluid">
                            <div class="box-title">
                            <h4 class="text-warning"><strong class="text-info">微会员(SCRM)：</strong>移动时代的社会化会员管理平台</h4>
                            <h5>微会员通过在平台内植入会员卡，帮助企业建立新一代的移动会员管理系统。清晰记录企业用户的消费行为并进行数据分析;还可根据用户特征进行精细分类，从而实现各种模式的精准营销。</h5>

                        </div>

                        <!--微会员(SCRM)-->
                         <div class="box-content">
                          <ul id="myTab" class="nav nav-tabs">
                          <li class="active"><a href="#cardset" data-toggle="tab">会员卡设置</a></li>
                          <li class=""><a href="#cardman" data-toggle="tab">会员管理</a></li>
                          <li class=""><a href="#consumeman" data-toggle="tab">消费管理</a></li>
                          <li class=""><a href="#statistics" data-toggle="tab">数据统计</a></li>
                          <li class=""><a href="#storeset" data-toggle="tab">商家设置</a></li>
             
                          </li>
                        </ul>
                       
                        <div id="myTabContent" class="tab-content">
                        
                        	<div class="tab-pane fade active in" id="cardset">
                            <dl>
                               
                                <dt class="span7">
                                <p>会员卡设置是指商家通过在平台内植入会员卡，对会员卡的设置来管理会员。</p>
                                <h3>使用方法：</h3>
                             <p>  1、	设置商家信息，包括商家名称、触发关键词、商户所在地、商家类别、商家详细地址、联系方式、商家兑换密码。</p>
                            <p>2、	点击下一步，设置卡片信息。包括会员卡名称、会员卡名称颜色、会员卡的背景、自己设计的背景、图文消息封面上传、会员卡的图标上传、卡号文字颜色、首页提示文字。</p>
                            <p>3、	提交信息。</p>
                            <p>4、	添加会员特权管理，设置标题、正文内容、可使用次数、时间限制，点击保存即可。</p>

                                 </dt>
                                 
                               <dd class="span5">
                                <img src="<?php echo RES;?>/img/cardset.png" >
                                </dd>
                            </dl>
             				 </div>
                             
                             <div class="tab-pane fade" id="cardman">
                            <dl>
                                 <dt class="span7">
                                <p>会员管理是指商家可以通过平台后台查看到用户领取会员卡的记录。</p>
                                <h3>使用方法：</h3>
                                  <p>1、商家可以通过输入用户名或者手机号码查询已经领取会员卡的用户信息，包括：会员卡号、姓名、手机号码、领卡时间、状态。</p>
                                  <p>2、商家可以点击“冻结”、“解冻”对用户的状态进行设置。</p>
                                 </dt>
                            
                                <dd class="span5">
                                <img src="<?php echo RES;?>/img/cardman.png" >
                                </dd>
                               
                            </dl>
             				 </div>
                             
                             
                             <div class="tab-pane fade" id="consumeman">
                            <dl>
                            <dt class="span7">
                                <p>消费管理是指商家可以通过平台后台查看到用户特权消费管理的信息。</p>
                                <h3>使用方法：</h3>
                            <p>1、商家可以通过输入SN码查询特权消费用户的信息，包括：特权名称、用户名、电话、SN码、SN码派发时间、使用时间、消费门店、消费金额/(元)、状态。</p>
                            <p>2、商家可以选择需要管理的用户，进行批量启用或者批量停用操作来改变用户的状态。</p>
                            
                                 </dt>
                                <dd class="span5">
                                <img src="<?php echo RES;?>/img/consumeman.png" >
                                </dd>
                                
                            </dl>
             				 </div>
                             
                             
                             <div class="tab-pane fade" id="statistics">
                            <dl>
                              
                                <dt class="span7">
                                <p>数据统计是指商家可以通过后台查询最近一个月新增会员的趋势和最近一个月消费次数趋势的走向图。</p>
                                <h3>使用方法：</h3>
                                <p> 1、商家可以通过点击最近一个月新增会员的趋势图横坐标上的小圆点，查看到当天新增会员的人数。</p>
                                <p>2、同时可以通过查看右侧新增会员的区域，查看到今日新增会员人数、昨日新增会员人数和目前总会员人数。</p>
                                <p>3、商家还可以点击最近一个月消费次数的趋势图横坐标上的小圆点，查看到当天消费的人数。</p>
                                <p>4、同样的通过右侧消费次数的区域内，可以查看到今日消费次数、昨日消费次数数和目前总消费次数。</p>

                                 </dt>
                                   <dd class="span5">
                                <img src="<?php echo RES;?>/img/statistics.png" >
                                </dd>
                            </dl>
             				 </div>
                             
                                 <div class="tab-pane fade" id="storeset">
                            <dl>
                               
                                <dt class="span7">
                                <p>商家设置是指商家通过平台设置自己的商铺信息，从而让用户更加详细的了解商家的确切资料</p>
                                <h3>使用方法：</h3>
                                <p>1、点击“添加联系方式”，设置基本信息。包括：区域名称、电话、地址。</p>
                                <p>2、填写商家简介。</p>
                                <p>3、点击保存即可。</p>
                                 </dt>
                                  <dd class="span5">
                                <img src="<?php echo RES;?>/img/storeset.png" >
                                </dd>
                            </dl>
             				 </div>
                             
                         
                        </div>
                      </div>
               </div>
                       <!--微官网-->
                         <div class="box">
                                <div class="box-title">
                                  <h4 class="text-warning"><strong class="text-info">微官网：</strong>五分钟打造超炫微信3G网站</h4>
                                </div>

                          <div class="box-content">
                            <dl>
                                <dd class="span5">
                                <img src="<?php echo RES;?>/img/microwebsite.png">
                                 </dd>
                                <dt class="span6">
                                 <p>全国首创微信3G网站，用户只要通过简单的设置，就能快速生成属于您自己的微信3G网站，并且有各种精美模板，供您选择，还有自定义模版，可以设计出自己的风格，让您的粉丝有种惊艳的感觉。在官方微信号输入"首页"体验微信3G网站。</p>
                                    <p>1、微官网设置：商家可以设置微官网的标题、触发关键词、匹配模式、图文消息标题、上传图文消息封面、编辑图文消息简介，设置完全符合商家需求的个性化网站。</p>
                                    <p>2、首页幻灯片设置：商家可以设置幻灯片名称、显示顺序、上传幻灯片图片、填写外链网站或活动，设置在首页显示。</p>
<p>3、分类管理：点击添加分类，设置分类名称、分类描述、显示顺序、上传分类图片、是否显示在首页、添加外链网站或活动、选择图标，这样就创建了一个分类。</p>
<p>4、模板管理：首先选择栏目首页模板风格，然后选择图文列表模板风格，最后选择图文详细模板，这样就完成了一套完整的模板设置。</p>

                                </dt>
                            </dl>
                          </div>

                      </div>

                       <!--微商城-->
                          
 
 
                       


                      </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="footer">
        <p>
          Copyright (c) 2011-2013 <?php echo C('site_name');?> All Rights Reserved
        </p>
        <a href="#" class="gototop"><i class="icon-arrow-up"></i></a>
    </div>

</body>




</html>