<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="keywords" content="<?php echo C('keyword');?>" />
    <meta name="description" content="<?php echo C('content');?>" />    
    <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_responsive_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/sstyle.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/todc_bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/themes.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/inside.css" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/inside.js"></script>
<title><?php echo C('site_name');?>-<?php echo C('site_title');?></title>
	<link rel="shortcut icon" href="/tpl/static/favicon.ico" />
    <!--[if lte IE 9]><script src="<?php echo RES;?>/js/watermark.js"></script><![endif]-->
	<!--[if IE 7]><link href="<?php echo RES;?>/css/font_awesome_ie7.css" rel="stylesheet" /><![endif]-->
</head>
<body>

	 	
    <div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">
                    <div class="box">
                        <div class="box-title">
                            <div class="span10">
                                <h3><i class="icon-edit"></i>请如实填写您的个人信息</h3>
                            </div>
                            <div class="span2"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
                        </div>

                        <div class="box-content">


                            <form action="<?php echo U('Index/usersaves');?>" method="post" class="form-horizontal form-validate">
                                <div class="control-group">
                                    <label for="name" class="control-label">商户名称：</label>
                                    <div class="controls">
                                        <input type="text" name="tusername" id="tusername" class="input-medium" value="<?php echo ($info['tusername']); ?>" data-rule-required="true" /><span class="maroon">*</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="mobile" class="control-label">手机号码：</label>
                                    <div class="controls">
                                        <input type="text" name="mobile" id="mobile" class="input-medium" data-rule-required="true" value="<?php echo ($info['mobile']); ?>" /><span class="maroon">*</span><span class="help-inline">

                                        </span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="qq" class="control-label">常用QQ号码：</label>
                                    <div class="controls">
                                        <input type="text" name="qq" id="qq" class="input-medium" data-rule-required="true" value="<?php echo ($info['qq']); ?>" /><span class="maroon">*</span>
                                    </div>
                                </div>
								  <div class="control-group">
                                    <label for="email" class="control-label">常用email：</label>
                                    <div class="controls">
                                        <input type="text" name="email" id="email" class="input-medium" data-rule-required="true" value="<?php echo ($info['email']); ?>" /><span class="maroon">*</span>
                                    </div>
                                </div>
			 <div class="control-group" style="display:none;">
                                    <label for="email" class="control-label">套餐类型：</label>
                                    <div class="controls">
                                        <b class="text-warning">VIP<?php if($_SESSION['gid']>1){echo $_SESSION['gid']-1;}else{echo 0;} ?></b>  <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank"><i class="icon-arrow-up" title="升级"></i>升级</a></p>
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">保存</button>
                                    <a class="btn" href="Javascript:window.history.go(-1)">取消</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div></body>
</html>