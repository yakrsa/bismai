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
                            <div class="span8">
                                <h3><i class="icon-table"></i><?php echo ($activityname); ?>设置</h3>
                            </div>
<div class="span2"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
                        </div>
<script src="./tpl/User/default/common/js/date/WdatePicker.js"></script>
<script src="/tpl/static/artDialog/jquery.artDialog.js?skin=default"></script>
<script src="/tpl/static/artDialog/plugins/iframeTools.js"></script>
<link href="<?php echo STATICS;?>/kindeditors/themes/default/default.css" rel="stylesheet" />
<script src="<?php echo STATICS;?>/kindeditors/kindeditor-min.js"></script>
<script src="<?php echo STATICS;?>/kindeditors/lang/zh_CN.js"></script>
<script src="<?php echo STATICS;?>/kindeditors/kindeditor.config-upfile.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/formCheck/formcheck.js"> </script>
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js?2013-9-13-2"></script>
<script>

var editor;
KindEditor.ready(function(K) {
editor = K.create('#intro', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
items : [
'source','undo','plainpaste','wordpaste','clearhtml','quickformat','selectall','fullscreen','fontname', 'fontsize','subscript','superscript','indent','outdent','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','hr']
});
});
</script>
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
		K('#upload1').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					fileUrl : K('#pic1').val(),
					clickFn : function(url, title) {
						if(url.indexOf("http") > -1){
							K('#pic1').val(url);
						}else{
							K('#pic1').val("<?php echo C('site_url');?>"+url);
						}
						editor.hideDialog();
					}
				});
			});
		});
		K('#upload2').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					fileUrl : K('#pic2').val(),
					clickFn : function(url, title) {
						if(url.indexOf("http") > -1){
							K('#pic2').val(url);
						}else{
							K('#pic2').val("<?php echo C('site_url');?>"+url);
						}
						editor.hideDialog();
					}
				});
			});
		});
		K('#upload3').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					fileUrl : K('#pic3').val(),
					clickFn : function(url, title) {
						if(url.indexOf("http") > -1){
							K('#pic3').val(url);
						}else{
							K('#pic3').val("<?php echo C('site_url');?>"+url);
						}
						editor.hideDialog();
					}
				});
			});
		});
		K('#upload4').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					fileUrl : K('#pic4').val(),
					clickFn : function(url, title) {
						if(url.indexOf("http") > -1){
							K('#pic4').val(url);
						}else{
							K('#pic4').val("<?php echo C('site_url');?>"+url);
						}
						editor.hideDialog();
					}
				});
			});
		});
		K('#upload5').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					fileUrl : K('#pic5').val(),
					clickFn : function(url, title) {
						if(url.indexOf("http") > -1){
							K('#pic5').val(url);
						}else{
							K('#pic5').val("<?php echo C('site_url');?>"+url);
						}
						editor.hideDialog();
					}
				});
			});
		});
		K('#upload6').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					fileUrl : K('#pic6').val(),
					clickFn : function(url, title) {
						if(url.indexOf("http") > -1){
							K('#pic6').val(url);
						}else{
							K('#pic6').val("<?php echo C('site_url');?>"+url);
						}
						editor.hideDialog();
					}
				});
			});
		});
});
</script>
				<div id="<?php echo MODULE_NAME;?>" class="content <?php echo MODULE_NAME;?>">
					<form class="form" method="post" action="" enctype="multipart/form-data" >
						
						<div class="cLine hide">
							<div class="pageNavigator left"></div>
							<div class="clr"></div>
						</div>
						<div class="msgWrap bgfc"> 
							<table class="userinfoArea" cellSpacing="0" cellPadding="0">
								<tbody>
									<tr>
										<th valign="top" class="f_l_r"><span class="red">*</span>关键词：</th>
										<td>
											<input type="input" class="px" id="keyword" value="<?php if($vo['keyword'] == ''): echo ($activityname); else: echo ($vo["keyword"]); endif; ?>" name="keyword" style="width:420px" ><br /><span class="red">只能写一个关键词</span>，用户输入此关键词将会触发此活动。
										</td>
									</tr>
									<tr>
										<th valign="top" class="f_l_r"><span class="red">*</span>名称：</span></th>
										<td><input type="input" class="px" id="name" value="" name="name" style="width:420px;">&nbsp;&nbsp;例：我家的客厅</td>
									</tr>
									<tr>
										<th valign="top" class="f_l_r"><span class="red">*</span>微信回复标题：</span></th>
										<td><input type="input" class="px" id="title" value="<?php echo ($set["title"]); ?>" name="title" style="width:420px;">&nbsp;&nbsp;例：全景客厅展示</td>
									</tr>
									<tr>
										<th valign="top" class="f_l_r"><span class="red">*</span>微信回复图片：</th>
										<td>

                                        <input type="text" name="picurl" value="<?php echo ($panoramic['picurl']); ?>" class="input-xlarge"  id="pic" readonly="readonly" style="width:420px;"/><span class="ke-button-common" id="upload" style="margin-top: 3px;margin-left: 5px;"><input type="button" class="ke-button-common ke-button" value="上传"></span><br />例：http://www.iMicms.com/tpl/Static/images/w720_h400_1.jpg</td>
										
									</tr>
									<tr>
										<th valign="top" class="f_l_r">顺序数字：</th>
										<td><input type="input" class="px" id="sort" value="1" name="sort" style="width:50px;">&nbsp;&nbsp;由小到大排列</td>
									</tr>
									<tr>
										<th valign="top" class="f_l_r">前：</th>

										<td>
										<input type="text" name="frontpic" value="<?php if($panoramic['frontpic'] != ''): echo ($panoramic['frontpic']); else: echo C ('site_url');?>/tpl/User/default/common/Panoramic/sample/pano_f.jpg<?php endif; ?>" class="input-xlarge"  id="pic1" readonly="readonly" style="width:420px;"/><span class="ke-button-common" id="upload1" style="margin-top: 3px;margin-left: 5px;"><input type="button" class="ke-button-common ke-button" value="上传"></span>&nbsp;&nbsp;</td>
									</tr>
									<tr>
										<th valign="top" class="f_l_r">右：</th>
										<span class="help-inline">
										
										<td><input type="text" name="rightpic" value="<?php if($panoramic['rightpic'] != ''): echo ($panoramic['rightpic']); else: echo C ('site_url');?>/tpl/User/default/common/Panoramic/sample/pano_r.jpg<?php endif; ?>" class="input-xlarge"  id="pic2" readonly="readonly" style="width:420px;"/><span class="ke-button-common" id="upload2" style="margin-top: 3px;margin-left: 5px;"><input type="button" class="ke-button-common ke-button" value="上传"></span>&nbsp;&nbsp;</td>
									</tr>
									<tr>
										<th valign="top" class="f_l_r">后：</th>
										
										<td><input type="text" name="backpic" value="<?php if($panoramic['backpic'] != ''): echo ($panoramic['backpic']); else: echo C ('site_url');?>/tpl/User/default/common/Panoramic/sample/pano_b.jpg<?php endif; ?>" class="input-xlarge"  id="pic3" readonly="readonly" style="width:420px;"/><span class="ke-button-common" id="upload3" style="margin-top: 3px;margin-left: 5px;"><input type="button" class="ke-button-common ke-button" value="上传"></span>&nbsp;&nbsp;</td>
									</tr>
									<tr>
										<th valign="top" class="f_l_r">左：</th>
										
										<td><input type="text" name="leftpic" value="<?php if($panoramic['leftpic'] != ''): echo ($panoramic['leftpic']); else: echo C ('site_url');?>/tpl/User/default/common/Panoramic/sample/pano_l.jpg<?php endif; ?>" class="input-xlarge"  id="pic4" readonly="readonly" style="width:420px;"/><span class="ke-button-common" id="upload4" style="margin-top: 3px;margin-left: 5px;"><input type="button" class="ke-button-common ke-button" value="上传"></span>&nbsp;&nbsp;</td>
									</tr>
									<tr>
										<th valign="top" class="f_l_r">顶部：</th>
										
										<td><input type="text" name="toppic" value="<?php if($panoramic['toppic'] != ''): echo ($panoramic['toppic']); else: echo C ('site_url');?>/tpl/User/default/common/Panoramic/sample/pano_u.jpg<?php endif; ?>" class="input-xlarge"  id="pic5" readonly="readonly" style="width:420px;"/><span class="ke-button-common" id="upload5" style="margin-top: 3px;margin-left: 5px;"><input type="button" class="ke-button-common ke-button" value="上传"></span>&nbsp;&nbsp;</td>
									</tr>
									<tr>
										<th valign="top" class="f_l_r">底部：</th>
										
										<td><input type="text" name="bottompic" value="<?php if($panoramic['bottompic'] != ''): echo ($panoramic['bottompic']); else: echo C ('site_url');?>/tpl/User/default/common/Panoramic/sample/pano_d.jpg<?php endif; ?>" class="input-xlarge"  id="pic6" readonly="readonly" style="width:420px;"/><span class="ke-button-common" id="upload6" style="margin-top: 3px;margin-left: 5px;"><input type="button" class="ke-button-common ke-button" value="上传"></span>&nbsp;&nbsp;</td>
									</tr>
									<tr>
										<th valign="top" class="f_l_r">描述信息：</th>
										<td><textarea name="intro" id="intro" class="px" style="width:420px; height:150px"></textarea></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="3">
											<button type="submit" name="button" class="btn btn-primary">保存</button>&nbsp;&nbsp;&nbsp;&nbsp;
											
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="cLine hide">
							<div class="pageNavigator right"></div>
							<div class="clr"></div>
						</div>
						<input type="hidden" name="token" value="<?php echo ($token); ?>" />
					</form>
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
	<div class="clr"></div>
 
 
<div style="display:none">

</div>
</body>
</html>