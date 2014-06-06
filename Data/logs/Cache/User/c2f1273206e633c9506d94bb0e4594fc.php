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
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/themes.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/todc_bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/inside.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/daterangepicker.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/datepicker.css" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/inside.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_methods.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_min.js"></script>
<title><?php echo C('site_name');?>-<?php echo C('site_title');?></title>
	<link rel="shortcut icon" href="/tpl/static/favicon.ico" />
    <!--[if lte IE 9]><script src="<?php echo RES;?>/js/watermark.js"></script><![endif]-->
	<!--[if IE 7]><link href="<?php echo RES;?>/css/font_awesome_ie7.css" rel="stylesheet" /><![endif]-->
</head>
<body>
	<body class="theme-satgreen">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="box">
                        <div class="box-title">
                            <div class="span10">
                                <h3><i class="icon-edit"></i>修改密码</h3>
                            </div>
                            <div class="span2">
                                <a class="btn" href="javascript:window.history.go(-1);">返回</a>
                            </div>
                        </div>
                        <div class="box-content">
                            <form action="<?php echo U('Index/usersave');?>" method="post" class="form-horizontal form-validate">
                                <div class="control-group">
                                    <label class="control-label" for="old_password">原始密码</label>
                                    <div class="controls">
                                        <input type="password" name="old_password" id="old_password" data-rule-required="true" data-rule-rangelength="[1,16]" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="password">设置密码</label>
                                    <div class="controls">
                                        <input type="password" name="password" id="password" data-rule-required="true" data-rule-rangelength="[6,16]" />
                                        <span class="maroon">*</span><span class="help-inline">长度为6~16位字符</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="repassword">确认密码</label>
                                    <div class="controls">
                                        <input type="password" name="repassword" id="repassword" data-rule-required="true" data-rule-equalto="#password">
                                    </div>
                                </div>
                                <div class="form-actions" id="btn_box">
                                    <button id="bsubmit" type="submit" data-loading-text="提交中..." class="btn btn-primary">保存</button>
                                    <button class="btn" type="button" onclick="javascript:window.history.go(-1);">取消</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body></body>
</html>