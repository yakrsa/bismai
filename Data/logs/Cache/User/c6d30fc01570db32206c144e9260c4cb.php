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
          
<link href="<?php echo STATICS;?>/kindeditors/themes/default/default.css" rel="stylesheet" />
<script src="<?php echo STATICS;?>/kindeditors/kindeditor-min.js"></script>
<script src="<?php echo STATICS;?>/kindeditors/lang/zh_CN.js"></script>
<script src="<?php echo STATICS;?>/kindeditors/kindeditor.config-upfile.js"></script>
<div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">

                    <div class="box">
                        <div class="box-title">
                            <div class="span8">
                                <h3><i class="icon-table"></i><?php if($isDining != 1): ?>商品分类<?php else: ?>菜品分类<?php endif; ?>设置</h3>
                            </div>
<div class="span2"><a class="btn" href="<?php echo U('Product/cats',array('token'=>$token,'parentid'=>$parentid,'dining'=>$isDining));?>">返回</a></div>
                        </div> 
  <div class="content"> 
 
   <form class="form" method="post" action="" enctype="multipart/form-data"> 
    <input type="hidden" name="id" value="<?php echo ($set["id"]); ?>" /> 
     
    <div class="msgWrap bgfc"> 
     <table class="userinfoArea" style=" margin:0;" border="0" cellspacing="0" cellpadding="0" width="100%"> 
      <tbody> 
       <tr> 
        <th><span class="red">*</span>名称：</th> 
        <td><input type="text" name="name" value="<?php echo ($set["name"]); ?>" class="px" style="width:400px;" /></td> 
       </tr> 
       <tr> 
        <th><span class="red">*</span>Logo地址：</th> 
        <td>
		<div class="control-group">
						<div class="controls">
						<img id="thumb_img" src="<?php echo ($set["logourl"]); ?>" style="max-height:100px;" />
						</div>
						<input type="hidden" id="thumb"  name="logourl" value="<?php echo ($set["logourl"]); ?>" class="input-xlarge"  data-rule-required="true" data-rule-url="true" />
                        <span class="help-inline"><a class="btn" id="insertimage">选择封面</a></span>
						</div>
       </td> 
       </tr>
       
        <tr> 
        <th><span class="red">*</span>简介：</th> 
        <td><textarea name="des" class="px" style="width:400px;height:80px;"><?php echo ($set["des"]); ?></textarea></td> 
       </tr>
       <tr>         
       <th>&nbsp;</th>
       <td>
       <?php if($isDining != 1): ?><input type="hidden" value="0" name="dining" /><?php else: ?><input type="hidden" value="1" name="dining" /><?php endif; ?>
       <input type="hidden" value="<?php echo $parentid;?>" name="parentid" />
       <button type="submit" name="button" class="btn btn-primary">保存</button> &nbsp; <a href="Javascript:window.history.go(-1)" class="btn">取消</a></td> 
       </tr> 
      </tbody> 
     </table> 
     </div>
    
   </form> 
  </div> 
   
 
<div style="display:none">

</div>
</body>
</html>