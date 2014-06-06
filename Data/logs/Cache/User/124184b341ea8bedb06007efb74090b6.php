<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
         <meta name="keywords" content="<?php echo C('keyword');?>" />
    <meta name="description" content="<?php echo C('content');?>" />
    <!-- Mobile Devices Support @begin -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
            <meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <!-- Mobile Devices Support @end -->
        <link rel="shortcut icon" href="/tpl/static/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_responsive_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/sstyle.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/themes.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/todc_bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/inside.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/colorpicker.css" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_colorpicker.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_methods.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jscolor.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/inside.js"></script>
<title><?php echo C('site_name');?>-<?php echo C('site_title');?></title>
        <!--[if IE 7]>
            <link href="<?php echo RES;?>/css/font_awesome_ie7.css" rel="stylesheet" />
        <![endif]-->
        <!--[if lte IE 8]>
            <script src="<?php echo RES;?>/js/excanvas_min.js"></script>
        <![endif]-->
        <!--[if lte IE 9]>
            <script src="<?php echo RES;?>/js/watermark.js"></script>
        <![endif]-->
    </head>
    <!--[if lte IE 9]>
<script src="<?php echo RES;?>/js/watermark.js"></script> 
<![endif]-->
<style type="text/css">
.plug-menu {
	width: 36px;
	height: 36px;
	border-radius: 36px;
	-moz-box-shadow: 0 0 0 4px #FFFFFF, 0 2px 5px 4px rgba(0, 0, 0, 0.25);
	-webkit-box-shadow: 0 0 0 4px #FFFFFF, 0 2px 5px 4px rgba(0, 0, 0, 0.25);
	box-shadow: 0 0 0 4px #FFFFFF, 0 2px 5px 4px rgba(0, 0, 0, 0.25);
	position: relative;
}

.plug-menu span {
	display: block;
	width: 28px;
	height: 28px;
	background: url(<?php echo RES;?>/img/plugmenu.png) no-repeat;
	-moz-background-size: 28px 28px;
	-o-background-size: 28px 28px;
	-webkit-background-size: 28px 28px;
	background-size: 28px 28px;
	text-indent: -999px;
	position: absolute;
	top: 4px;
	left: 4px;
	overflow: hidden;
}
.ico-views {
	font-size: 30px;
	color: #fff;
	padding: 5px;
}
</style>
<script>
$(document).ready(function(){
	$('#plugmenucolor').css('backgroundColor','<?php echo ($user['namecolor']); ?>');
});
	</script>
<body>
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">

                    <div class="box">
                        <div class="box-title">
                            <div class="span12">
                                <h3>
                                    <i class="icon-table"></i>幻灯片管理
                                    <small>3G网站头部幻灯片。</small>
                                </h3>
                           <a class="btn preview pull-right btn-success" href="javascript:;">微官网预览</a>
								<script type="text/javascript">
									$("a.preview").click(function () {
										if ($.browser.msie) {
											alert("不支持在IE浏览器下预览，建议使用谷歌浏览器或者360极速浏览器或者直接在微信上预览。");
											return;
										}
										var left = ($(window.parent.parent).width() - 450) / 2;
																				window.open("<?php echo C('site_url');?>/index.php?g=Wap&m=Index&a=index&token=<?php echo ($info[0]['token']); ?>", "我的微官网", "height=650,width=450,top=0,left=" + left + ",toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no");
									});
								</script>
                            </div>
                        </div>


                        <div class="box-content">

                           
                            <div class="tab-content">
                               
                            <div class="alert">
			    1、幻灯片图片最佳尺寸(宽640高425) 。<br>
			    2、幻灯片外链地址 <br>
			       比如访问微官网时候，点击微官网的幻灯片时，你想让它跳转到百度，就填写<a class="red">http://www.baidu.com</a><br>

			       不需要跳转就不用填写。  </div> 
                                <div class="tab-pane active" id="menu">
                                    <div class="span12 control-group">
                                        <a class="btn" href="<?php echo U('Flash/add');?>"><i class="icon-plus"></i>添加幻灯片</a>
                                    </div>
                                    <table id="listTable" class="table table-bordered table-hover dataTable ajax-checkbox" ajax-url="<?php echo U('Classify/Classify_show');?>" ajax-length="40">

                                        <thead>
                                            <tr>
		                
                        
						<th >标题</th>
					        <th>图片</th>                                                
                                              
						<th style="width:150px">跳转链接地址</th>
                                              
                                              
                                                <th>操作 </th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                         
						
						<td><?php echo ($vo["info"]); ?></td>
                                                <td><img type="img" src="<?php echo ($vo["img"]); ?>" style="max-height:50px;" />
</td>
                                              
                                                <td><?php echo ($vo["url"]); ?></td>
                                                
                                               
                                                <td>
                                                    <a href="<?php echo U('Flash/edit',array('id'=>$vo['id']));?>" class="btn" rel="tooltip" title="编辑"><i class="icon-edit"></i></a>
                                                    <a href="javascript:G.ui.tips.confirm('确定要删除吗？', 'index.php?g=User&m=Flash&a=del&id=<?php echo ($vo['id']); ?>');" class="btn" rel="tooltip" title="删除"><i class="icon-remove"></i></a>
                                                </td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                                                      
                                            											                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>