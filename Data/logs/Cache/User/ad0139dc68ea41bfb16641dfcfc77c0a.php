<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('content');?>" /> 
 
 <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_min.css?2013-12-06-5" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_responsive_min.css?2013-12-06-5" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/sstyle.css?2013-12-06-5" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/themes.css?2013-12-06-5" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/todc_bootstrap.css?2013-12-06-5" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/resource.css?2013-12-06-5" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/iinside.css?2013-12-06-5" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js?2013-12-06-5"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js?2013-12-06-5"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_min.js?2013-12-06-5"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_min.js?2013-12-06-5"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_methods.js?2013-12-06-5"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/resource.js?2013-12-06-5"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/iinside.js?2013-12-06-5"></script>
<title><?php echo C('site_name');?>-<?php echo C('site_title');?></title>
<link rel="shortcut icon" href="/tpl/static/favicon.ico" />
        <!--[if IE 7]>
            <link href="<?php echo RES;?>/css/font_awesome_ie7.css?v=2013-12-06-5" rel="stylesheet" />
        <![endif]-->
        <!--[if lte IE 8]>
            <script src="<?php echo RES;?>/js/excanvas_min.js?v=2013-12-06-5"></script>
        <![endif]-->
        <!--[if lte IE 9]>
            <script src="<?php echo RES;?>/js/watermark.js?v=2013-12-06-5"></script>
        <![endif]-->
    </head>
    <script src="http://api.map.baidu.com/api?key=24ffad3855e675265336a4cfb46d32b4&v=1.1&services=true" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditors/kindeditor-min.js?v=2013-12-06-5"></script>
<script src="<?php echo STATICS;?>/kindeditors/lang/zh_CN.js?v=2013-12-06-5"></script>
<script src="<?php echo STATICS;?>/kindeditors/kindeditor.config-upfile.js?v=2013-12-06-5"></script>
<link href="<?php echo STATICS;?>/kindeditors/themes/default/default.css?v=2013-12-06-5" rel="stylesheet" />
<body>
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="box">
                        <div class="box-title">
                            <div class="span12">
                                <h3><i class="icon-cog"></i>添加幻灯片</h3>
                            </div>
                        </div>
                        <form action="<?php echo U('Flash/insert');?>" method="post" class="form-horizontal form-validate">
                            <div class="box-content">
                                <div class="control-group">
                                    <label for="name" class="control-label">幻灯片名称：</label>
                                    <div class="controls">
                                        <input type="text" id="name" name="name" value="" class="input-medium" data-rule-required="true" />
                                        <span class="maroon">*</span><span class="help-inline"></span>
                                    </div>
                                </div>
				 <div class="control-group">
                                    <label for="info" class="control-label">幻灯片标题：</label>
                                    <div class="controls">
                                        <input type="text" id="info" name="info" value="" class="input-medium" data-rule-required="true" />
                                        <span class="maroon">*</span><span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label for="insertimage" class="control-label">幻灯片封面:</label>
                                    <div class="controls">
                                         <img type="img" src="<?php echo C('site_url');?>/tpl/static/images/default-slide.jpg?=2013-9-28-2" style="max-height:50px;" />
                                        <input type="hidden" name="img" value="<?php echo C('site_url');?>/tpl/static/images/default-slide.jpg?=2013-9-28-2" class="input-medium" />
                                        <a class="btn insertimage">选择幻灯片</a>
					 <span class="help-inline">建议尺寸：宽640像素，高425像素</span>
                                    </div>
                                </div>
                               
                                <div id="res_block">
                                    <div class="control-group">
                                            <label class="control-label" for="source_url">跳转链接：</label>
                                            <div class="controls">
                                                <input type="url" id="source_url" value="" class="input-xlarge" name="url"  />
                                                <span class="help-inline">根据自身需要，可以填写、可以留空。</span>
                                        </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">保存</button>
                                    <button type="button" class="btn" onclick="window.history.go(-1);">取消</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        var resource = Resource.create();
        var ins = Resource.instance['res_block'];
        ins.result = ins.result || {};
        ins.result.wuid = 1;

        
        window.ICON();
    });

    KindEditor.ready(function(K){
        var editor = K.editor({
            themeType: 'simple',
            allowFileManager: true
        });
        $('a.insertimage').live('click', function(e){
            editor.loadPlugin('smimage', function(){
                editor.plugin.imageDialog({
                    imageUrl: $(e.target).prev().val(),
                    clickFn: function(url, title, width, height, border, align){
                        $(e.target).prev().val(url);
                        if ('img' == $(e.target).prev().prev().attr('type')) {
                            $(e.target).prev().hide();
                            $(e.target).prev().prev().attr('src', url);
                            $(e.target).prev().prev().show();
                        }
                        editor.hideDialog();
                    }
                });
            });
        });
    });
</script></html>