<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_min.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_responsive_min.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/sstyle.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/todc_bootstrap.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/themes.css?2013-9-13-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/inside.css?2013-9-13-2" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/inside.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_methods.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_min.js?2013-9-13-2"></script>
<script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/js/common.js" type="text/javascript"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> <?php echo C('site_title');?> <?php echo C('site_name');?></title>
<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('content');?>" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<script>var SITEURL='';</script>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/style_2_common.css?BPm" />
<script src="<?php echo RES;?>/js/common.js" type="text/javascript"></script>
</head>
<body id="nv_member" class="pg_CURMODULE" onkeydown="if(event.keyCode==27) return false;">
 
    
    
 

 <link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css" />
  <!--中间内容
  <script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>
  
  <div class="contentmanage">
    <div class="developer">
       <div class="appTitle normalTitle2">
        <div class="vipuser">


 

<div id="nickname">
<strong><?php echo ($wecha["wxname"]); ?></strong><a href="#" target="_blank" class="vipimg vip-icon<?php echo $userinfo['id']-1; ?>" title=""></a></div>
<div id="weixinid">微信号:<?php echo ($wecha["wxid"]); ?></div>
</div>

 <div class="accountInfo">
<table class="vipInfo" width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td><strong>VIP有效期：</strong><?php if($_SESSION['viptime'] != 0): echo (date("Y-m-d",session('viptime'))); else: ?>vip0不限时间<?php endif; ?></td>
<td><strong>图文自定义：</strong><?php echo (session('diynum')); ?>/<?php echo ($userinfo["diynum"]); ?></td>
<td><strong>活动创建数：</strong><?php echo (session('activitynum')); ?>/<?php echo ($userinfo["activitynum"]); ?></td>
<td><strong>请求数：</strong><?php echo (session('connectnum')); ?>/<?php echo ($userinfo["connectnum"]); ?></td>
</tr>
<tr>
<td><strong>请求数剩余：</strong><?php echo ($userinfo['connectnum']-$_SESSION['connectnum']); ?></td>
<td><strong>已使用：</strong><?php echo $_SESSION['diynum']; ?></td>
<td><strong>当月赠送请求数：</strong><?php echo ($userinfo["activitynum"]); ?></td>
<td><strong>当月剩余请求数：</strong><?php echo $userinfo['connectnum']-$_SESSION['connectnum']; ?></td>
</tr>

</table>
 </div>
        <div class="clr"></div>
      </div>
  
      <div class="tableContent">-->
        
        <!--左侧功能菜单-->
          
<div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="box">
                        <div class="box-title">
                            <div class="span12">
                                <h3>
                                    <i class="icon-table"></i>360全景配置 
                                </h3>
								
                            </div>
                        </div>
				<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/<?php echo MODULE_NAME;?>/css/style.css" />
				<script src="<?php echo STATICS;?>/artDialog/jquery.artDialog.js"></script>
				<script src="<?php echo STATICS;?>/artDialog/plugins/iframeTools.js"></script>
				<div id="<?php echo MODULE_NAME;?>" class="content <?php echo MODULE_NAME;?>">
					<div class="cLineB">
						<h4 class="left"><?php echo ($activityname); ?>活动信息 (<?php if($count == ''): ?>0<?php else: echo ($count); endif; ?>) 条<span class="FAQ">你本月有 <?php echo ($group["activitynum"]); ?> 次机会可免收活动创建费，已经使用了 <?php echo ($activitynum); ?> 次机会!</span></h4>
						<div class="clr"></div>
					</div>
					<div class="cLine">
						<div class="pageNavigator left">
							<a href="<?php echo U(MODULE_NAME.'/add',array('token'=>$token));?>" title="新增<?php echo ($activityname); ?>" class="btn"><i class="icon-plus"></i>新增<?php echo ($activityname); ?></a>
						</div>
						<div class="clr"></div>
					</div>
					<div class="msgWrap">
						<form method="post" action="" id="info">
							<table class="ListProduct" border="0" cellspacing="0" cellpadding="0" width="100%">
								<thead>
									<tr>
										<th>名称</th>
										<th>关键词</th>
										<th>总浏览数</th>
										<th>外链代码</th>
										<th class="norightborder">操作</th>
									</tr>
								</thead>
								<tbody>
									<tr></tr>
									<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo ($o["name"]); ?></td>
										<td><?php echo ($o["keyword"]); ?></td>
										<td><?php echo ($o["click"]); ?></td>
										<td><?php echo ($activityname); ?> <?php echo ($o["id"]); ?></td>
										<td class="norightborder"><a href="<?php echo U('Wap/'.MODULE_NAME.'/item',array('id'=>$o['id'],'token'=>$o['token']));?>" target="_blank">预览</a> <a href="<?php echo U(MODULE_NAME.'/edit',array('token'=>$token,'id'=>$o['id']));?>">修改</a> <a href="javascript:drop_confirm('您确定要删除吗?', '<?php echo U(MODULE_NAME.'/delete',array('token'=>$token,'id'=>$o['id']));?>');">删除</a></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</tbody>
							</table>
							<input type="hidden" name="token" value="<?php echo ($_GET['token']); ?>" />
						</form>
					</div>
					<div class="cLine">
						<div class="pageNavigator right">
							<div class="pages"></div>
						</div>
						<div class="clr"></div>
					</div>
				</div>
			</div>	
			<div class="clr"></div>
		</div>
	</div>
 
 
<div style="display:none">

</div>
</body>
</html>