<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('content');?>" />   
 <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_min.css?2013-10-21-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_responsive/min.css?2013-10-21-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/sstyle.css?2013-10-21-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/todc_bootstrap.css?2013-10-21-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/themes.css?2013-10-21-2" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/iinside.css?2013-10-21-2" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js?2013-10-21-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js?2013-10-21-2"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/iinside.js?2013-10-21-2"></script>
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
                        <div class="span8">
                            <h3><i class="icon-table"></i>喜帖管理</h3>
                        </div>
                       <div class="span4">
                                <div class="form-horizontal">
                                    <input type="text" id="keyword-input" class="input-small-z" placeholder="请输入关键词" />
                                   
                                    <button class="btn" id="btn_search">查询</button>
				    <input type="hidden" name="aid" id ="aid" value="<?php echo ($uid); ?>">
				 

                                </div>
                            </div>
                    </div>

                    <div class="box-content">

                        <div class="row-fluid">

                            <div class="span12 control-group">
                                <a href="<?php echo U('Wcard/add',array('token'=>$_SESSION['token']));?>" class="btn" id="add_menu"><i class="icon-plus"></i>添加喜帖</a>
                                <div class="btn-group datatabletool">
                                    <a class="btn" attr="BatchDel" title="删除"><i class="icon-trash"></i></a>
                                </div>
                            </div>


                        </div>

                        <div class="row-fluid dataTables_wrapper">

                            <table id="listTable" class="table table-bordered table-hover dataTable">

                                <thead>
                                    <tr>
                                        <th class='with-checkbox'>
                                            <input type="checkbox" class="check_all" /></th>
                                        <th>标题</th>
                                        <th>关键字</th>
                                        <th>新郎/新娘</th>
										<th>总浏览数</th>
										<th>宴会日期</th>
										<th>宴会时间</th>
                                        <th>密码</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
				
				<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="with-checkbox">
                                        <input type="checkbox" name="check" value="<?php echo ($vo["id"]); ?>" /></td>
                                    <td><?php echo ($vo["title"]); ?></td>
                                    <td><?php echo ($vo["keyword"]); ?></td>
                                    <td><?php echo ($vo["man"]); ?>/<?php echo ($vo["woman"]); ?></td>
									<td><?php echo ($vo["click"]); ?></td>
									<td><?php echo ($vo["date"]); ?></td>
									<td><?php echo ($vo["hour"]); ?>时<?php echo ($vo["min"]); ?>分</td>
                                    <td><?php echo ($vo["password"]); ?></td>
                                    <td class="input-medium">
                                        <a href="<?php echo U('Wcard/md',array('token'=>$_SESSION['token'],'id'=>$vo['id'],'type'=>1));?>" class="btn" rel="tooltip" title="查看"><i class="icon-search"></i></a>
                                        <a class="btn" href="<?php echo U('Wcard/edit',array('token'=>$_SESSION['token'],'id'=>$vo['id']));?>" title="编辑"><i class="icon-edit"></i></a>
                                        <a class="btn" href="javascript: G.ui.tips.confirm('确定删除？','<?php echo U('Wcard/del',array('token'=>$_SESSION['token'],'id'=>$vo['id']));?>')" title="删除"><i class="icon-remove"></i></a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </table>
                            <div class="dataTables_paginate paging_full_numbers"><span>       </span></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
$(function(){
    $("[attr='BatchDel']").click(function(){
        var check = $("input:checked");
        if(check.length<1){
            alert('请选择删除项');
            return false;
        }
        var id = new Array();
        check.each(function(i){
           // id[i] = $(this).val();
	    id  += $(this).val()+',';
        });

        $.post('index.php?g=User&m=Wcard&a=delbatch', {ids:id, aid:$('#aid').val() },function(data){
            if (data ==0)
            {
                location.reload();
            } else {
                alert(data.error);
            }


        },'json');

    });
    
    $("#btn_search").click(function(){
			var keywords = $.trim($('#keyword-input').val());
			if (keywords.length <= 0) {
				alert('请输入搜索关键字.');
				$('#keyword-input').focus();
				return false;
			}
			window.location.href = 'index.php?g=User&m=Wcard&a=search&keyword=' + keywords;

		});

		$("#keyword-input").keyup(function(e) {
			if (e.keyCode == 13) {
				$("#btn_search").click();
				return false;
			}
		});
});
</script></body>
</html>