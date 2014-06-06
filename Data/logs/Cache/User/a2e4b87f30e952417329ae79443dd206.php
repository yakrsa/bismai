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
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_fileupload_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_methods.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/region_select.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/inside.js?2013-9-13-2"></script>
<link href="<?php echo STATICS;?>/kindeditors/themes/default/default.css" rel="stylesheet" />
<script src="<?php echo STATICS;?>/kindeditors/kindeditor-min.js"></script>
<script src="<?php echo STATICS;?>/kindeditors/lang/zh_cn.js"></script>
<script src="<?php echo STATICS;?>/kindeditors/kindeditor.config-upfile.js"></script>
<title><?php echo C('site_name');?>-<?php echo C('site_title');?></title>
<link rel="shortcut icon" href="/tpl/static/favicon.ico" />
    <!--[if lte IE 9]><script src="<?php echo RES;?>/js/watermark.js"></script><![endif]-->
	<!--[if IE 7]><link href="<?php echo RES;?>/css/font_awesome_ie7.css" rel="stylesheet" /><![endif]-->
</head>
<script>
	KindEditor.ready(function(K){
		var editor = K.editor({
			allowFileManager:false
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
							K('#picl').val(url);
						}else{
							K('#picl').val("<?php echo C('site_url');?>"+url);
						}
						editor.hideDialog();
					}
				});
			});
		});
		
		
});
</script>
<body>
	<div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">
                    <div class="box">
                        <div class="box-title">
                            <div class="span10">
                                <h3><i class="icon-edit"></i>添加公众帐号     <small><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank"><img  src="/tpl/static/zs.jpg" alt="管家助手"/></a></small></h3>

                            </div>
                            <div class="span2"><a class="btn" onclick="javascript:window.history.go(-1);">返回</a></div>
                        </div>

                        <div class="box-content">
                            <div id="validateErrorContainer" class="validateErrorContainer ">
                                <h5>以下信息填写有误,请重新填写</h5>
                                <ul></ul>
                            </div>

                            <form action="<?php echo U('User/Index/upsave');?>" method="POST" class="form-horizontal form-validate">
			     <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
			     <input type="hidden" name="farword" value="/index.php?g=User&m=Index&a=acount">
                                <div class="control-group">
                                    <label for="plc_name" class="control-label">公众号名称：</label>
                                    <div class="controls">
                                        <input type="text" name="wxname" value="<?php echo ($info["wxname"]); ?>" id="wxname" class="input-medium" data-rule-required="true"><span class="maroon">*</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="wxid" class="control-label">公众号原始id：</label>
                                    <div class="controls">
                                        <input type="text" name="wxid" value="<?php echo ($info["wxid"]); ?>"  id="plc_sourceid" class="input-medium" data-rule-required="true"  readonly><span class="maroon">*</span><span class="help-inline">
												请认真填写，错了不能修改。比如：gh_7153e08dbacf      <a href="http://jingyan.baidu.com/article/63f23628eb6b490209ab3d6b.html" target="_blank" ><i class="icon-question-sign"></i> 不懂问我</a> <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank"  ><i class="icon-smile"></i> 联系客服</a>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="wechat_id" class="control-label">微信号：</label>
                                    <div class="controls">
                                        <input type="text"  name="weixin" value="<?php echo ($info["weixin"]); ?>" id="wechat_id" class="input-medium" data-rule-required="true" value="sjtftx"><span class="maroon">*</span>
                                    </div>
                                </div>
								<div class="control-group">
                                    <label for="wechat_id" class="control-label">AppID：</label>
                                    <div class="controls">
                                        <input type="text"  name="appid" value="<?php echo ($info["appid"]); ?>" id="wechat_id" class="input-medium"  value="sjtftx"><span class="maroon">用于微客服等高级功能，可以不填</span>
                                    </div>
                                </div>
								<div class="control-group">
                                    <label for="wechat_id" class="control-label">appsecret</label>
                                    <div class="controls">
                                        <input type="text"  name="appsecret" value="<?php echo ($info["appsecret"]); ?>" id="wechat_id" class="input-medium"  value="sjtftx"><span class="maroon">用于微客服等高级功能，可以不填</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">头像地址（url）:</label>
                                    <div class="controls">
				     		    
				    
					 <img id="thumb_img" src="<?php echo ($info["headerpic"]); ?>" style="max-height:100px;" /> 
                                            <input type="text" name="headerpic" value="<?php echo ($info["headerpic"]); ?>" class="px" style="width:200px;" id="picl" readonly="readonly"><span class="ke-button-common" id="upload1" style="margin-left:5px;margin-top:35px;"><input type="button" class="btn" value="上传"></span>
                                    </div>
                                </div>
				  <div class="control-group">
                                    <label for="api_key" class="control-label">接口地址：</label>
                                    <div class="controls">
										<span class="help-inline"><font color="red"><?php echo C('site_url');?>/index.php/api/<?php echo ($info["token"]); ?></font></span>
                                    </div>
                                </div>
				<input type="hidden" name="token" value="<?php echo ($info["token"]); ?>" class="px" tabindex="1" size="40">
                                <div class="control-group">
                                    <label for="token" class="control-label">TOKEN：</label>
                                    <div class="controls">
                                      <span class="help-inline"><font color="red"><?php echo ($info["token"]); ?></font></span>
                                    </div>
                                </div>
								                                <div class="control-group">
                                    <label class="control-label">地区：</label>

                                    <div class="controls">
				       

                                     <select id="province" name="province" ></select>
                                        <select id="city"   name="city" ></select>
                                        <select name="areaid" id="areaid" ></select>
                                        <script type="text/javascript">
                                            new PCAS('province', 'city', 'areaid', '<?php echo ($info["province"]); ?>', '<?php echo ($info["city"]); ?>', '<?php echo ($info["areaid"]); ?>');
                                        </script>
                                    </div>

                                </div>
                                <div class="control-group">
                                    <label for="email" class="control-label">公众号邮箱：</label>
                                    <div class="controls">
                                        <input type="text" value="<?php echo ($info["qq"]); ?>" name="qq" id="email" class="input-medium" data-rule-email="true" data-rule-required="true"><span class="maroon">*</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="funs" class="control-label">粉丝数：</label>
                                    <div class="controls">
                                        <input type="text" name="wxfans" value="<?php echo ($info["wxfans"]); ?>"  id="funs" class="input-medium" data-rule-required="true"><span class="maroon">*</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="type" class="control-label">微信号类型：</label>
                                    <div class="controls">
                                        <select id="winxintype" name="winxintype">                  
                  <option value="1" <?php if(($info["winxintype"]) == "1"): ?>selected<?php endif; ?>>订阅号</option>
                  <option value="2" <?php if(($info["winxintype"]) == "2"): ?>selected<?php endif; ?>>服务号</option>
                  <option value="3" <?php if(($info["winxintype"]) == "3"): ?>selected<?php endif; ?>>高级服务号</option>
                  </select>　高级服务号是指每年向微信官方交300元认证费的公众号
                                    </div>
                                </div>
                                  <div class="control-group hide">

                                    <label for="tongji" class="control-label">图文页统计代码：</label>
                                    <div class="controls">
                                        <input type="text" name="tongji"  value="<?php echo ($info["tongji"]); ?>" id ="tongji" style="width: 600px; height: 40px;" maxlength="300">
                                    </div>
                                </div>
                                <div class="form-actions">
									<input type="hidden" name="aid" id="aid" value="1659">
                                    <button type="submit" class="btn btn-primary">保存</button>
                                    <a class="btn" href="Javascript:window.history.go(-1)">取消</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

	<script type="text/javascript">
	$(function(){
		$('#wxname').focus();
	});
</script></body>
</html>