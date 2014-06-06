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
          
<!--<link rel="stylesheet" href="<?php echo C('site_url');?>/up_pic/themes/default/default.css" />
<link rel="stylesheet" href="<?php echo C('site_url');?>/up_pic/plugins/code/prettify.css" />
<script src="<?php echo C('site_url');?>/up_pic/kindeditor.js" type="text/javascript"></script>
<script src="<?php echo C('site_url');?>/up_pic/lang/zh_CN.js" type="text/javascript"></script>
<script src="<?php echo C('site_url');?>/up_pic/plugins/code/prettify.js" type="text/javascript"></script>-->

<link href="<?php echo STATICS;?>/kindeditors/themes/default/default.css" rel="stylesheet" />
<script src="<?php echo STATICS;?>/kindeditors/kindeditor-min.js"></script>
<script src="<?php echo STATICS;?>/kindeditors/lang/zh_cn.js"></script>

<script src="<?php echo STATICS;?>/kindeditors/kindeditor.config-upfile.js"></script>

<script>
	KindEditor.ready(function(K){
		var editor = K.editor({
			allowFileManager:true
		});
		K('#upload').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					fileUrl : K('#pic').val(),
					clickFn : function(url, title) {
						if(url.indexOf("http") > -1){
							K('#pic').val(url);
						}else{
							K('#pic').val("<?php echo C('site_url');?>"+url);
						}
						editor.hideDialog();
					}
				});
			});
		});
	});
</script>
<div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">

                    <div class="box">
                        <div class="box-title">
                            <div class="span8">
                                <h3><i class="icon-table"></i><?php echo ($infoType["name"]); ?>回复配置</h3>
                            </div>
<div class="span2"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
                        </div>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/cymain.css" />
<div class="content">

 <!--tab start-->
<div class="tab">
<ul>
<!--<?php if($infoType["type"] == 'Groupon'): ?><li class="tabli" id="tab0"><a href="<?php echo U('Groupon/index',array('token'=>$token));?>">团购订单管理</a></li>
<li class="tabli" id="tab2"><a href="<?php echo U('Groupon/products',array('token'=>$token));?>">团购管理</a></li>
<?php else: ?>
<li class="tabli" id="tab0"><a href="<?php echo U('Product/index',array('token'=>$token,'dining'=>$isDining));?>"><?php if($isDining != 1): ?>商品<?php else: ?>菜品<?php endif; ?>管理</a></li>
<li class="tabli" id="tab2"><a href="<?php echo U('Product/cats',array('token'=>$token,'dining'=>$isDining));?>"><?php if($isDining != 1): ?>商品分类<?php else: ?>菜品分类<?php endif; ?>管理</a></li>
<li class="tabli" id="tab3"><a href="<?php echo U('Product/orders',array('token'=>$token,'dining'=>$isDining));?>">订单管理</a></li>
<?php if($isDining == 1): ?><li class="tabli" id="tab2"><a href="<?php echo U('Product/tables',array('token'=>$token,'dining'=>1));?>">桌台管理</a></li><?php endif; endif; ?>-->
<li class="current tabli" id="tab20"><a href="<?php echo U('Reply_info/set',array('token'=>$token,'infotype'=>$infoType['type']));?>"><?php echo ($infoType["name"]); ?>回复配置</a></li>
</ul>
</div>
<!--tab end-->        
    <div class="msgWrap bgfc">
	  <form class="form" method="post" action=""  enctype="multipart/form-data">	 
		<table class="userinfoArea" style=" margin:0;" border="0" cellspacing="0" cellpadding="0" width="100%">
			<tbody>
				<tr>
				  <th valign="top"><span class="red">*</span>关键词：</th>
				  <td>
					<span class="red"><?php echo ($infoType["keyword"]); ?> —— 当用户输入该关键词时，将会触发此回复。</span></td>
				</tr>
				<tr>
					<th width="120"><span class="red">*</span>回复标题：</th>
					<td><input type="text" name="title" value="<?php echo ($set["title"]); ?>" class="px" style="width:550px;"></td>
				</tr>
				<tr>
					<th width="120">内容介绍：</th>
					<td><textarea style="width:560px;height:75px" name="info" id="info" class="px"><?php echo ($set["info"]); ?></textarea><br/>最多填写120个字</td>
				</tr>
				<tr>
					<th>回复图片：</th>
					<td><input type="text" name="picurl" value="<?php echo ($set["picurl"]); ?>" class="px" style="width:550px;" id="pic" readonly="readonly"><span class="ke-button-common" id="upload" style="margin-top: 3px;margin-left: 5px;"><input type="button" class="ke-button-common ke-button" value="上传"></span><br/> 填写图片外链地址，大小为720x400</td>
				</tr>
				<tr>
					<th>第三方接口：</th>
					<td><input name="apiurl" value="<?php echo ($set["apiurl"]); ?>" class="px" style="width:550px;" type="text"><br> 只适用于引用第三方3G网站的链接</td>
				</tr>
				<?php if($infoType["type"] == 'Dining'): ?><tr>
					<th>订购方式开关：</th>
					<td><label><input type="checkbox" name="diningyuding" value="1" <?php if($set["diningyuding"] == 1): ?>checked<?php endif; ?> /> 开启预定</label> <label><input type="checkbox" name="diningwaimai" value="1" <?php if($set["diningwaimai"] == 1): ?>checked<?php endif; ?> /> 开启外卖</label></td>
				</tr><?php endif; ?>
				<tr>
					<th>支付开关：</th>
					<td><select name="if_pay"><option value="0" <?php if($set["if_pay"] == 0): ?>selected<?php endif; ?>>关闭</option><option value="1" <?php if($set["if_pay"] == 1): ?>selected<?php endif; ?>>开启</option></select>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<th>支付方式：</th>
					<td><select name="pay_type"><option value="0" <?php if($set["pay_type"] == 0): ?>selected<?php endif; ?>>在线支付</option><option value="1" <?php if($set["pay_type"] == 1): ?>selected<?php endif; ?>>货到付款</option></select>&nbsp;&nbsp;支付开启时有效</td>
				</tr>
				<th>&nbsp;</th>
					<td>
					<input type="hidden" name="keyword" value="<?php echo ($infoType["keyword"]); ?>" />
					<input type="hidden" name="infotype" value="<?php echo ($infoType["type"]); ?>" />
					<input type="hidden" name="token" value="<?php echo ($token); ?>" />
						<button type="submit" name="button" class="btn btn-primary">保存</button>
						<a href="javascript:history.go(-1);" class="btn">取消</a>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
  </div> 
 
  
        </div>
 
 
<div style="display:none">

</div>
</body>
</html>