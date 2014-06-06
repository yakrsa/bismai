<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content="微信营销、微信代运营、微信定制开发、微信托管、微网站、微商城、微营销" name="Keywords">
<meta content="国内最大的微信公众智能服务平台，八大微体系：微菜单、微官网、微会员、微活动、微商城、微推送、微服务、微统计，企业微营销必备。" name="Description">
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
    <!--[if lte IE 9]><script src="<?php echo RES;?>/js/watermark.js"></script><![endif]-->
	<!--[if IE 7]><link href="<?php echo RES;?>/css/font_awesome_ie7.css" rel="stylesheet" /><![endif]-->
</head>
<body>
 
	<div id="main">
        <div class="row-fluid">
            <div class="span12">
                <div class="box ">
                    <div class="box-title">
                        <h3><i class="icon-user"></i>账户信息</h3>
                    </div>
                    <div class="box-content">

                        <dl class="dl-horizontal">
                            <dt>
                                <img src="<?php echo ($info["headerpic"]); ?>" style="width: 88px; height: 88px" class="img-rounded"></dt>
                            <dd>
                                <p><strong>微信号:<?php echo ($info["weixin"]); ?></strong>：<b class="text-warning"><?php echo ($userg['name']); ?></b>  <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank"><i class="icon-arrow-up" title="升级"></i>升级</a></p>



                                <table class="table noborder">
								                                    <tr>
                                        <td>套餐有效期：<?php echo (date("Y-m-d",$thisUser["viptime"])); ?></td>
                                        <td>活动自定义：<?php echo (session('activitynum')); ?>/<?php echo ($userinfo["activitynum"]); ?></td>
                                        <td>图文自定义：<?php echo ($thisUser["diynum"]); ?>/<?php echo ($userinfo["diynum"]); ?></td>
                                        <td>公众号配额：<?php echo ($total); ?>/<?php echo ($userinfo["gongzhongnum"]); ?></td>
                                    </tr>
                                    <tr>
                                        <td>请求数剩余：
					 <?php echo ($userinfo['connectnum']-$_SESSION['connectnum']); ?>										</td>
                                        <td>总请求数：<?php echo $_SESSION['diynum']; ?></td>
                                        <td>本月请求数：<?php echo $_SESSION['connectnum'] ?></td>
                                        <td>每月可请求总数：<?php echo ($userinfo["connectnum"]); ?></td>
                                    </tr>
                                </table>
								<p><strong>接口地址：</strong><?php echo C('site_url');?>/index.php/api/<?php echo ($token); ?>&nbsp;&nbsp;&nbsp;&nbsp;
								<strong>TOKEN：</strong><?php echo ($token); ?></p>
								<p><strong>备用地址：</strong><?php echo C('site_url');?>/index.php?g=Home&m=Weixin&a=index&token=<?php echo ($token); ?>&nbsp;&nbsp;&nbsp;&nbsp;
								<strong>TOKEN：</strong><?php echo ($token); ?></p>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
<div class="row-fluid">
            <div class="box">

                <div class="box-title">
                    <h3>
                        <i class="icon-rocket"></i>
                        快捷操作
                    </h3>
                </div>
                <div class="box-content">
           <div class="block block-tiles block-tiles-animated clearfix">
	   
	    
                       <a href="<?php echo U('Areply/index',array('token'=>$token));?>" class="tile tile-themed">
                            <i class="icon-globe "></i>
                            <div class="tile-info"><strong>关注时回复</strong></div>
                        </a>
	 
                        <a href="<?php echo U('Text/index',array('token'=>$token));?>" class="tile tile-themed">
                            <i class="icon-credit-card"></i>
                            <div class="tile-info"><strong>文本回复</strong></div>
                        </a>
                        <a href="<?php echo U('Voiceresponse/index',array('token'=>$token));?>" class="tile tile-themed">
                            <i class="icon-hand-up"></i>
                            <div class="tile-info"><strong>语音回复</strong></div>
                        </a>
                        <a href="<?php echo U('Classify/index',array('token'=>$token));?>" class="tile tile-themed">
                            <i class="icon-dashboard "></i>
                            <div class="tile-info"><strong>分类管理</strong></div>
                        </a>
			<a href="<?php echo U('Tmpls/index',array('token'=>$token));?>" class="tile tile-themed">
                            <i class="icon-money "></i>
                            <div class="tile-info"><strong>模板管理</strong></div>
                        </a>

                       <a href="<?php echo U('Diymen/index',array('token'=>$token));?>"  class="tile tile-themed">
                            <i class="icon-reorder"></i>
                            <div class="tile-info"><strong>自定义菜单</strong></div>
                        </a>
                        <a href="<?php echo U('Flash/index',array('token'=>$token));?>" class="tile tile-themed">
                            <i class="icon-comments-alt "></i>
                            <div class="tile-info"><strong>首页幻灯片</strong></div>
                        </a>
                       <a href="<?php echo U('Api/index',array('token'=>$token));?>" class="tile tile-themed">
                            <i class="icon-smile"></i>
                            <div class="tile-info"><strong>融合第三方</strong></div>
                        </a>
                       <a href="<?php echo U('Taobao/index',array('token'=>$token));?>" class="tile tile-themed">
                            <i class="icon-thumbs-up"></i>
                            <div class="tile-info"><strong>淘宝天猫店铺配置</strong></div>
                        </a>
                        <a href="<?php echo U('Adma/index',array('token'=>$token));?>" class="tile not tile-themed">
                            <i class="icon-truck"></i>
                            <div class="tile-info"><strong>DIY宣传页</strong></div>
                        </a>
                       <a href="<?php echo U('Photo/index',array('token'=>$token));?>"class="tile not tile-themed">
                            <i class="icon-shopping-cart"></i>
                            <div class="tile-info"><strong>3G图集(相册)</strong></div>
                        </a>
                       <a href="<?php echo U('Lottery/index',array('token'=>$token));?>" class="tile not tile-themed">
                            <i class="icon-group"></i>
                            <div class="tile-info"><strong>幸运大转盘</strong></div>
                        </a>
                       <a href="<?php echo U('Coupon/index',array('token'=>$token));?>"  class="tile tile-themed">
                            <i class="icon-user-md"></i>
                            <div class="tile-info"><strong>优惠券</strong></div>
                        </a>

                        <a href="<?php echo U('Guajiang/index',array('token'=>$token));?>" class="tile not tile-themed">
                            <i class="icon-home"></i>
                            <div class="tile-info"><strong>刮刮卡</strong></div>
                        </a>
                       <a href="<?php echo U('Member_card/index',array('token'=>$token));?>" class="tile not tile-themed">
                            <i class="icon-plane"></i>
                            <div class="tile-info"><strong>会员卡设计</strong></div>
                        </a>

                       <a href="<?php echo U('Member_card/privilege',array('token'=>$token));?>"  class="tile not tile-themed">
                            <i class="icon-gift"></i>
                            <div class="tile-info"><strong>最新通知</strong></div>
                        </a>
                        <a href="<?php echo U('Member_card/privilege',array('token'=>$token));?>" class="tile not tile-themed">
                            <i class="icon-food"></i>
                            <div class="tile-info"><strong>会员特权</strong></div>
                        </a>
						<a href="<?php echo U('Member_card/create',array('token'=>$token));?>" class="tile tile-themed">
                            <i class="icon-phone-sign"></i>
                            <div class="tile-info"><strong>在线开卡(自定义卡号)</strong></div>
                        </a>

                    </div>
                       <script type="text/javascript">
                          $(function () {
                             var $p = window.top.document;
                             var $left_a = $("#left a", $p);
                             var keyArray = new Array;
                             $left_a.each(function () {
                                 keyArray.push($(this).attr("href"))
                             })
                             $(" div.block-tiles a:not(.not)").click(function (e) {
                                 e.preventDefault();
                                 var $this = $(this);
                                 var $h = $(this).attr("href");
                                 var $eq = $.inArray($h, keyArray);
                                 if ($eq) {
                                     window.parent.lfet_select_menu($eq);
                                     if ($this.attr("rel")) {
                                         window.top.location = $h;
                                     } else {
                                         if ($h != "javascript:void(0)") {
                                             $("#mainFrame", $p).attr("src", $h);
                                         }

                                     }
                                 } else {
                                       G.ui.tips.suc("研发中 敬请期待")
                                 }

                             });




                         });

                    </script>
                </div>
            </div>

        </div>
        </div>




</body>
</html>