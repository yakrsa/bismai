<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<link rel="shortcut icon" href="favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo C('site_name');?>,微信智能服务平台,企业微信营销首选,微信公众帐号营销系统-微信导航系统</title>
<meta name="description" content="<?php echo C('site_name');?>平台是企业微信管理和营销工具,通过梦展平台,用户可以轻松管理自己的微信各类信息,对微信公众账号进行维护、开展智能机器人、微信会员卡在线发优惠劵等活动,对微信营销实现有效监控,极大扩展潜在客户群和实现企业的运营目标!" />
<meta name="keywords" content="<?php echo C('site_name');?>,企业微信营销,微信营销案例,微信营销技巧,微信公共平台" />
<link href="<?php echo RES;?>/css/wstyle.css" rel="stylesheet" type="text/css" />
<script src="<?php echo RES;?>/js/jquery-1.9.1.min.js"></script>
<!-- <script src="js/common.js"></script> -->
<script src="<?php echo RES;?>/js/parallax.js"></script>
<!--[if IE 6]><script type="text/javascript" src="<?php echo RES;?>/js/DD_belatedPNG.js"></script><![endif]-->
<!--[if IE 6]>
<script type="text/javascript">
 DD_belatedPNG.fix("img");
</script>
<![endif]-->

</head>
<body>
<!-- <div class="load" id="load">
	<div id="loadInside" style="display:none;">
		<p><img src="" data-src="<?php echo RES;?>/img/load_2.png" alt="<?php echo C('site_name');?>" /></p>
		<p id="loadImg" style="width: 0;"><img src="" data-src="<?php echo RES;?>/img/load.png" alt="<?php echo C('site_name');?>" /></p>
		<p class="loadTxt"><span id="loadTxt">0</span>%</p>
	</div>
	<p><img src="<?php echo RES;?>/img/loading.gif" alt=""></p>
	<div class="load_bg"></div>
</div> -->
<div class="wrapHeader">
	<div class="header">
		<h1 class="logo"><a href="index.php"><img src="<?php echo RES;?>/img/logo.png" alt="艾米" title="艾米" width="200" height="60" /></a></h1>
		<ul class="nav">
			<li><a href="javascript:void(0)" class="cur">首页</a></li>
			<li><a href="javascript:void(0)">平台介绍</a></li>
			<li><a href="javascript:void(0)">六大优势</a></li>
			<li><a href="javascript:void(0)">特色功能</a></li>
			<li><a href="javascript:void(0)">核心价值</a></li>
			<li><a href="javascript:void(0)">联系我们</a></li>
			<?php if($_SESSION[uid]==false): ?><li><a href="index.php?g=User&m=Index&a=login">企业入口</a></li> 
			<?php else: ?>
			<li><a href="index.php?g=User&m=Index&a=index">管理中心</a></li><?php endif; ?>
			
		</ul>
	</div>
</div>
<ul class="fixedNav">
	<li class="cur">
		<em class="icon"></em>
		<span class="txt">首&nbsp;&nbsp;&nbsp;&nbsp;页</span>
	</li>
	<li>
		<em class="icon"></em>
		<span class="txt">营销工具</span>
	</li>
	<li>
		<em class="icon"></em>
		<span class="txt">六大优势</span>
	</li>
	<li>
		<em class="icon"></em>
		<span class="txt">特色功能</span>
	</li>
	<li>
		<em class="icon"></em>
		<span class="txt">核心价值</span>
	</li>
	<li>
		<em class="icon"></em>
		<span class="txt">联系我们</span>
	</li>
</ul>
<div class="wrapBox" id="wrapBox">
	<div class="box b1_bg">
		<div class="load">
			<p><img src="<?php echo RES;?>/img/loading.gif" alt=""></p>
			<div class="load_bg"></div>
		</div>
		<div class="box_bg box1_bg zIndex40"><img src="<?php echo RES;?>/img/b1_bg.jpg" data-src="<?php echo RES;?>/img/b1_bg.jpg" alt=""></div>
		<div class="box_fixed b1_fixed">
			<div class="b1_01 zIndex50"><img src="<?php echo RES;?>/img/b1_01.png" data-src="<?php echo RES;?>/img/b1_01.png" alt="" /></div>
			<div class="b1_02"><img src="<?php echo RES;?>/img/b1_02.png" data-src="<?php echo RES;?>/img/b1_02.png" alt="" /></div>
			<div class="b1_03">
				<img src="<?php echo RES;?>/img/b1_03.png" data-src="<?php echo RES;?>/img/b1_03.png" alt="" />
				<a href="javascript:void(0)" title="开始体验" class="b1_03_btn"><img src="" data-src="<?php echo RES;?>/img/b1_03_btn.png" alt="" /></a>
			</div>
		</div>
		<div class="b1_04 zIndex40"><img src="<?php echo RES;?>/img/b1_04.png" data-src="<?php echo RES;?>/img/b1_04.png" alt="" /></div>
	</div>
	<div class="box b2_bg">
		<div class="load">
			<p><img src="<?php echo RES;?>/img/loading.gif" alt=""></p>
			<div class="load_bg"></div>
		</div>
		<div class="box_bg box2_bg"><img src="" data-src="<?php echo RES;?>/img/b2_bg.jpg" alt=""></div>
		<div class="box_fixed b2_fixed">
			<div class="b2_01"><img src="" data-src="<?php echo RES;?>/img/b2_01.png" alt="" /></div>
			<h2 class="b2_02">微信用户已突破4亿，<br />您准备好了吗?</h2>
			<p class="b2_07">微信公众平台仅仅只是一个二维码吗？<br />
				为何不将4亿微信用户转化成您的客户<br />
				我们针对餐饮、销售、服务等行业超过五十项实用营销功能..<br />
				今天我们将助力你的移动互联网生根发芽
			</p>
			<div class="b2_03 zIndex40"><img src="" data-src="<?php echo RES;?>/img/b2_03.png" alt="" /></div>
			<div class="b2_04 zIndex40"><img src="" data-src="<?php echo RES;?>/img/b2_04.png" alt="" /></div>
			<div class="b2_05 zIndex40"><img src="" data-src="<?php echo RES;?>/img/b2_05.png" alt="" /></div>
			<div class="b2_06 zIndex50"><img src="" data-src="<?php echo RES;?>/img/b2_06.png" alt="" /></div>
		</div>
	</div>
	<div class="box b3_bg">
		<div class="load">
			<p><img src="<?php echo RES;?>/img/loading.gif" alt=""></p>
			<div class="load_bg"></div>
		</div>
		<div class="box_bg box3_bg"><img src="" data-src="<?php echo RES;?>/img/b3_bg.jpg" alt=""></div>
		<div class="box_fixed b3_fixed">
			<div class="b3_tl box_tl">
				<h2>六大移动<span class="clfea005">营销手段</span>，未来触手可及！</h2>
				<p>Six mobile marketing tools, the future at your fingertips!</p>
			</div>
			<div class="b3_img"><img src="" data-src="<?php echo RES;?>/img/b3_01.png" alt="" /></div>
			<div class="b3_01 b3_txt">
				<strong>3G微官网</strong>
				<p>1分钟打造属于你独一无二的3G网站<br />不同的风格、更快的速度<br />给你带来更好的体验。</p>
			</div>
			<div class="b3_02 b3_txt">
				<strong>SCRM(社会化客户管理)</strong>
				<p>将4亿微信用户完美无缝<br />转换成您的会员。</p>
			</div>
			<div class="b3_03 b3_txt">
				<strong>营销活动</strong>
				<p>电子优惠券节省你的宣传成本<br />微信订餐/订票快速锁定您的客户<br />提升用户体验。</p>
			</div>
			<div class="b3_04 b3_txt">
				<strong>刮刮卡等</strong>
				<p>刮刮卡、幸运大转盘等多种互动活动<br />让您的会员更活跃。</p>
			</div>
			<div class="b3_05 b3_txt">
				<strong>智能应答</strong>
				<p>用户询问根据关键词进行智能回复<br />它将是你的客服机器人。</p>
			</div>
			<div class="b3_06 b3_txt">
				<strong>移动电商</strong>
				<p>内置微商城、微团购，<br />移动电商更快人一步。</p>
			</div>
		</div>
	</div>
	<div class="box b4_bg">
		<div class="load">
			<p><img src="<?php echo RES;?>/img/loading.gif" alt=""></p>
			<div class="load_bg"></div>
		</div>
		<div class="box_bg box4_bg"><img src="" data-src="<?php echo RES;?>/img/b4_bg.jpg" alt=""></div>
		<div class="box_fixed b4_fixed">
			<div class="b4_txt_box">
				<h2 class="b4_tl">微3G网站六大优势，<br /><span>让客户更了解您</span></h2>
				<div class="b4_txt b4_txt01">
					<strong>跨平台，节省开发成本</strong>
					<p>一次开发，所有平台都能使用。</p>
				</div>
				<div class="b4_txt b4_txt02">
					<strong>多种风格，1秒切换</strong>
					<p><?php echo C('site_name');?>提供多达40多套微站模板并不断增加中。</p>
				</div>
				<div class="b4_txt b4_txt03">
					<strong>网站内容易更新维护</strong>
					<p>更新维护傻瓜化操作。</p>
				</div>
				<div class="b4_txt b4_txt04">
					<strong>便捷功能</strong>
					<p><?php echo C('site_name');?>可实现快速导航等便捷功能。</p>
				</div>
				<div class="b4_txt b4_txt05">
					<strong>自动更新</strong>
					<p>添加内容自动更新、图片自适应。</p>
				</div>
				<div class="b4_txt b4_txt06">
					<strong>无缝嵌入微信</strong>
					<p>内嵌于微信公众平台。</p>
				</div>
			</div>
			<div class="b4_01">
				<img src="" data-src="<?php echo RES;?>/img/b4_01.png" alt="" />
				<p class="tl"><?php echo C('site_name');?>网站</p>
			</div>
			<div class="b4_02">
				<img src="" data-src="<?php echo RES;?>/img/b4_02.png" alt="" />
				<p class="tl">普通3G网站</p>
			</div>
		</div>
	</div>
	<div class="box b5_bg">
		<div class="load">
			<p><img src="<?php echo RES;?>/img/loading.gif" alt=""></p>
			<div class="load_bg"></div>
		</div>
		<div class="box_bg box5_bg"><img src="" data-src="<?php echo RES;?>/img/b5_bg.jpg" alt=""></div>
		<div class="box_fixed b5_fixed">
			<div class="b5_tl box_tl">
				<h2><span class="clfea005">特色</span>功能模块</h2>
				<!-- <p>生成APP，可免输入网址直接浏览，支持Android与iOS，更多功能联系我们！</p> -->
			</div>
			<p class="b5_txt">生成APP，可免输入网址直接浏览，支持Android与iOS，更多功能联系我们！</p>
			<div class="b5_01"><img src="" data-src="<?php echo RES;?>/img/b5_01.png" alt="" /></div>
			<div class="b5_ico">
				<p class="b5_ico01">促销信息发布</p>
				<p class="b5_ico02">商品及服务展示</p>
				<p class="b5_ico03">在线咨询预订</p>
				<p class="b5_ico04">会员社会化转化</p>
				<p class="b5_ico05">移动电商</p>
				<p class="b5_ico06">丰富多彩的营销活动</p>
			</div>
		</div>
	</div>
	<div class="box b6_bg">
		<div class="load">
			<p><img src="<?php echo RES;?>/img/loading.gif" alt=""></p>
			<div class="load_bg"></div>
		</div>
		<div class="box_bg box6_bg"><img src="" data-src="<?php echo RES;?>/img/b6_bg.jpg" alt=""></div>
		<div class="box_fixed b6_fixed">
			<h2 class="b6_tl">核心价值<br /><span>Core Values</span></h2>
			<div class="b6_cont">
				<div class="b6_img"><img src="" data-src="<?php echo RES;?>/img/b6_img.png" alt="" /></div>
				<div class="b6_arrow">
					<em class="b6_arrow01"></em>
					<em class="b6_arrow02"></em>
				</div>
				<div class="b6_txt b6_txt01"><i></i>社会化会员管理工具<br />精准锁定，自动响应</div>
				<div class="b6_txt b6_txt02"><i></i>微网站同步实时更新</div>
				<div class="b6_txt b6_txt03"><i></i>大转盘、刮刮卡<br />一个也不能少</div>
				<div class="b6_txt b6_txt04"><i></i>在线预约、预定、留言反馈</div>
				<div class="b6_txt b6_txt05"><i></i>微3G网站更好的用户体验</div>
				<div class="b6_txt b6_txt06"><i></i>智能应答一切从容应对</div>
				<div class="b6_txt b6_txt07"><i></i>微商城、团购<br />快速进入移动电商时代</div>
			</div>
			<div class="b6_01"><img src="" data-src="<?php echo RES;?>/img/b6_01.png" alt="" /></div>
		</div>
	</div>
		<div class="box b7_bg">
		<div class="load">
			<p><img src="<?php echo RES;?>/img/loading.gif" alt=""></p>
			<div class="load_bg"></div>
		</div>
		<div class="box_bg box7_bg"><img src="" data-src="<?php echo RES;?>/img/b7_bg.jpg" alt=""></div>
		<div class="box_fixed b7_fixed">
			<div class="b7_tl box_tl">
				<h2><span class="clfea005">联系</span>我们</h2>
			</div>
			<div class="b7_contact">
				<strong class="clfea005 tel">400-000-0000</strong>
				<p class="service">
					<strong>在线客服</strong>
					<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=8441010&amp;site=qq&amp;menu=yes" target="_blank" class="qq qq01"></a>
					<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=8441010&amp;site=qq&amp;menu=yes" target="_blank" class="qq qq02"></a>
					<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=8441010&amp;site=qq&amp;menu=yes" target="_blank" class="qq qq03"></a>
				</p>
			</div>
			<div class="b7_bottom">
				<div class="b7_map">
					<p class="txt">请联系在线客服获取您当地的联系方式</p>
					<style type="text/css">
						html,body{margin:0;padding:0;}
						.iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
						.iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
					</style>
					<div class="img" style="width:400px;height:290px;border:#ccc solid 1px;" id="dituContent">
					<img src="<?php echo RES;?>/img/code.jpg"></img>
					</div>
				</div>
				<div class="b7_msg">
				<script>
				function ajax_sub(){
					var name=$('#username').val();
					var tel=$('#tel').val();
					var company=$('#company').val();
					var content=$('#content').val();
					if(name==""){
						$('#username').attr("placeholder", "请输入联系人");
						$('#username').focus();
						$('#username').select();
						return false;
					}
					if(tel==""){
						$('#tel').attr("placeholder", "请输入手机号码");
						$('#tel').focus();
						$('#tel').select();
						return false;
					}	
					if(tel){
						var tel=$("input[name=tel]").val();
						var me = false;
						var reg0 = /^13\d{9}$/;
						var reg1 = /^153\d{8}$/;
						var reg2 = /^159\d{8}$/;
						var reg3 = /^15\d{9}$/;
						var reg4 = /^18\d{9}$/;
						var my = false;
						if (reg0.test(tel))my=true;
						if (reg1.test(tel))my=true;
						if (reg2.test(tel))my=true;
						if (reg3.test(tel))my=true;
						if (reg4.test(tel))my=true;
						if (!my){
							$('#tel').val('');
							$('#tel').attr("placeholder", "手机号码输入有误，请重新输入");
							$('#tel').focus();
							$('#tel').select();
							return false;
						}
					}

					if(company==""){
						$('#company').attr("placeholder", "请输入公司名称");
						$('#company').focus();
						$('#company').select();
						return false;
					}
					if(content==""){
						$('#content').attr("placeholder", "请输入详细内容");
						$('#content').focus();
						$('#content').select();
						return false;
					}
					$("#msg").show().html('<img src="<?php echo RES;?>/img/loading.gif">');
					
					$.post('index.php?g=Home&m=Index&a=csend',{username:name,tel:tel,company:company,content:content},function(json){
						if(json==0){
							$('#username').val('');
							$('#tel').val('');
							$('#company').val('');
							$('#content').val('');
							$("#msg").show().html("<font color='#FF0000'>对不起，每天只能提交3次！</font>").fadeOut(2500);
						}else if(json==1){
							$("#msg").show().html("<font color='#FF0000'>请正确输入信息！</font>").fadeOut(2500);
						}else if(json==2){
							$('#username').val('');
							$('#tel').val('');
							$('#company').val('');
							$('#content').val('');
							$("#msg").show().html("<font color='#FF0000'>提交成功，我们会尽快电话联系您！</font>").fadeOut(2500);
						}else{
							$('#username').val('');
							$('#tel').val('');
							$('#company').val('');
							$('#content').val('');
							$("#msg").show().html("<font color='#FF0000'>提交失败，请重试！</font>").fadeOut(2500);
						}

					},'json');
					
				}
				</script>
					<h4>留言<span> / Message</span></h4>
					<div class="row">
						<input type="text" name="username" id="username" class="name" maxlength="20" placeholder="联系人"/>
						<input type="text" name="tel" id="tel" maxlength="15" placeholder="手机"/>
					</div>
					<div class="row">
						<input type="text" name="company" id="company" class="companyName" maxlength="20" placeholder="公司名称"/>
					</div>
					<div class="row">
						<textarea name="content" id="content" cols="30" rows="10" placeholder="详细内容"></textarea>
					</div>
					<div>
					<a href="javascript:void(0)" class="btn" onClick="ajax_sub()" style="float:left">提交</a>
					<span id="msg" style="float:left;margin-left:5px"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
//document.body.style.overflow = 'hidden';
var ie6 = !-[1,]&&!window.XMLHttpRequest;
ie6 || loadImg.init();
</script>
<script type="text/javascript" src="<?php echo RES;?>/js/audio.js"></script>
 <script>
			window.addEventListener("DOMContentLoaded", function(){
				playbox.init("playbox");
			}, false);
		</script>

		<span id="playbox" class="btn_music" onClick="playbox.init(this).play();">
		<audio src="1.mp3" loop id="audio"></audio></span>
		<script>
		playbox.init(document.getElementById('playbox')).play();
</script>
</body>
</html>