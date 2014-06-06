<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('content');?>" />   
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
                                <h3><i class="icon-edit"></i>授权设置</h3>
                            </div>
                            <div class="span2"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
                        </div>

                        <div class="box-content">
                            <div class="alert">
                                1. 要在微信、易信公众平台<strong>“开发模式”</strong>下使用自定义菜单，首先要在公众平台<strong>申请</strong>自定义菜单使用的<strong>AppId和AppSecret</strong>，然后填入下边表单。<br>
                                2. 提交完id和密钥后，可以在【菜单设置】中设置各个菜单项，然后进行发布，您的微信公众号便支持自定义菜单了。<br>
				3. 没有申请开通<strong><span class="red bold">"易信"</span></strong>的，可以不用填写（可选填）项。<br>
                                4. 公众平台规定，<strong>菜单发布<span class="red bold">24小时后生效</span></strong>。如果为新增粉丝，则可马上看到菜单。
                            </div>
                            <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label" for="appid">微信应用id:</label>
                                    <div class="controls">
                                        <input type="text" class="span4" id="appid" name="appid" value="<?php echo ($diymen["appid"]); ?>" data-rule-required="true" data-rule-maxlength="100">
                                        <span class="maroon">*</span>
                                        <span><a href="https://mp.weixin.qq.com" target="_blank">微信公众平台申请到的AppId</a></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="appsecret">微信应用密钥:</label>
                                    <div class="controls">
                                        <input type="text" class="span4" id="appsecret" name="appsecret" value="<?php echo ($diymen["appsecret"]); ?>" data-rule-required="true" data-rule-maxlength="200">
                                        <span class="maroon">*</span>
                                        <span><a href="https://mp.weixin.qq.com" target="_blank">微信公众平台申请到的AppSecret</a></span>
                                    </div>
                                </div>
                                

                                  			
                                <div class="form-actions">
									<input type="hidden" name="aid" id="aid" value="3420">
                                    <button id="bsubmit" type="submit" data-loading-text="提交中..." class="btn btn-primary">保存</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>