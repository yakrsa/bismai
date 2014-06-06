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
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/album.css?2013-9-13-2" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_validate_methods.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery_form_min.js?2013-9-13-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/inside.js?2013-9-13-2"></script>
<title><?php echo C('site_name');?>-<?php echo C('site_title');?></title>
<link rel="shortcut icon" href="/tpl/static/favicon.ico" />
    <!--[if lte IE 9]><script src="<?php echo RES;?>/js/watermark.js"></script><![endif]-->
	<!--[if IE 7]><link href="<?php echo RES;?>/css/font_awesome_ie7.css" rel="stylesheet" /><![endif]-->
</head>
<body>
	
<body>
    <div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">

                    <div class="box">
                        <div class="box-title">
                            <div class="span8">
                                <h3><i class="icon-table"></i>网盘管理</h3>
                            </div>

                        </div>

                        <div class="box-content nozypadding">

                            <div class="row-fluid">
                                <div class="span12 control-group">
                                    <a class="btn" href="<?php echo U('Ndisk/add',array('token'=>$_SESSION['token']));?>" ><i class="icon-plus"></i>创建网盘</a>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <ul class="photo">
				<?php if(is_array($photo)): $i = 0; $__LIST__ = $photo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$photo): $mod = ($i % 2 );++$i;?><li>
                                        <div class="photoimg">
                                            <a title="<?php echo ($photo["title"]); ?>" class="cover" href="<?php echo U('Ndisk/upload',array('id'=>$photo['id']));?>">
                                                <img src="<?php echo ($photo["picurl"]); ?>">
                                            </a>
                                            <div class="bd">
                                                <h6><?php echo ($photo["title"]); ?></h6>
                                                <p class="sn">有<?php echo ($photo["num"]); ?>张图片</p>
                                            </div>
                                            <div class="fr"> 
                                                <a href="<?php echo U('Ndisk/upload',array('id'=>$photo['id']));?>">上传图片</a>　<a href="<?php echo U('Ndisk/edit',array('token'=>session('token'),'id'=>$photo['id']));?>">编辑</a>　<a href="javascript:void(0);" onclick="ajaxdel(<?php echo ($photo['id']); ?>);">删除</a>
                                            </div>
                                        </div>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>		                                    <li>
                                      </ul>
                            </div>

                            <div class="row-fluid dataTables_wrapper">
				<div class="dataTables_paginate paging_full_numbers"><span>       </span></div>                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
	<script type="text/javascript">
	         
		function ajaxdel(del_id){
		        
			if(confirm('您确定要删除吗?')){
				$.ajax("<?php echo U('Ndisk/del');?>", {dataType: 'json', data: {'id':del_id}}).done(function (d) {
					if(1 == d){
						G.ui.tips.err("操作成功！");
						window.location.reload();
					}else{
						G.ui.tips.err("操作失败！");
					}
				});
			}
		}

    </script>
</body>
</body>
</html>