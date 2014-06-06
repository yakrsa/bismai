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
<script type="text/javascript" src="<?php echo RES;?>/js/resource3.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js"></script>
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
                            <div class="span6">
                                <h3><i class="icon-table"></i>管理微信公众帐号</h3>
                            </div>

                        </div>

                       <div class="box-content nozypadding">
                            <div class="row-fluid">
                                <div class="span8 control-group">

                                    <a class="btn" href="<?php echo $priv; ?>"><i class="icon-plus"></i>添加公众帐号</a>
									
									
                                    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank" class="btn btn-warning" style="cursor:pointer">微助手</a>
                                </div>


                            </div>

                            <div class="row-fluid dataTables_wrapper">
                                <div class="alert">
                                    <strong>温馨提示</strong>：尊敬的<font color="#FF0000" size="3"><?php echo ($userg['name']); ?></font>您有 <font color="#FF0000" size="3"><?php echo ($userinfo["gongzhongnum"]); ?></font> 个公众号配额，已经使用 <font color="#FF0000" size="3"><?php echo ($total); ?></font> 个！ 您的账号将于<font color="#FF0000" size="3"><?php echo (date("Y-m-d",$thisUser["viptime"])); ?></font>到期，请提前续费！<span class="line"><?php echo C('site_name');?>交流QQ①群（<?php echo C('site_qq1');?>）</span>
                                </div>
                                <form method="post" action="" id="listForm">
                                    <table id="listTable" class="table table-hover table-nomargin table-bordered usertable dataTable">
                                        <thead>
                                            <tr>

                                                <th>公众号名称</th>
                                           <!--<th>会员套餐</th>-->
                                                <th>创建时间/到期时间</th>
                                                <th>已定义/上限</th>
                                                <th>请求数</th>
                                                <th>剩余请求数</th>
                                                <th>操作</th>
                                            </tr>

                                        </thead>
					  <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tbody>
					
					
					
					
						  <tr>
                                                <td style="text-align:center;">
                                                    <p>
                                                        <a href="javascript:void(0)" onclick="parent.location.href='<?php echo U('Function/index',array('id'=>$vo['id'],'token'=>$vo['token']));?>'" title="点击进入功能管理">
                                                            <img src="<?php echo ($vo["headerpic"]); ?>" style="width:88px;height:88px;"></a>
                                                    </p>
                                                    <p><?php echo ($vo["wxname"]); ?></p>
                                                </td>
                                                <td align="center" style="display:none;">
                                                    <p>VIP<?php if($_SESSION['gid']>1){echo $_SESSION['gid']-1;}else{echo 0;} ?>  <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank"><i class="icon-arrow-up" title="续费"></i>续费</a></p>

                                                </td>
                                                <td>
                                                    <p>创建时间:<?php echo (date("Y-m-d",$vo["createtime"])); ?></p>
                                                    <p>到期时间:<?php echo (date("Y-m-d",$thisUser["viptime"])); ?></p>
                                                </td>
                                                <td>
                                                    <p>活动：<?php echo (session('activitynum')); ?>/<?php echo ($userinfo["activitynum"]); ?></p>
                                                    <p>图文：<?php echo ($thisUser["diynum"]); ?>/<?php echo ($userinfo["diynum"]); ?></p>
                                                    <p>公众号个数：<?php echo ($total); ?>/<?php echo ($userinfo["gongzhongnum"]); ?></p>
                                                </td>
                                                <td>
                                                    <p>总请求数:<?php echo $_SESSION['connectnum'] ?></p>
                                                    <p>本月请求数:<?php echo ($userinfo["connectnum"]); ?></p>
                                                </td>
                                                <td>
                                                    <p>请求数剩余：<?php echo ($userinfo['connectnum']-$_SESSION['connectnum']); ?></p>
                                                </td>
                                                <td>
 
                                                    <a href="<?php echo U('Index/edit',array('id'=>$vo['id']));?>" class="btn" rel="tooltip" title="编辑"><i class="icon-edit"></i></a>
                                                    <a href="javascript:G.ui.tips.confirm('您确定要删除此公众帐号吗?', '<?php echo U('Index/del',array('id'=>$vo['id'],'forward'=>'acount'));?>');" class="btn" rel="tooltip" title="删除"><i class="icon-remove"></i></a>
                                                    <a  href="javascript:void(0)" onclick="parent.location.href='<?php echo U('Function/index',array('id'=>$vo['id'],'token'=>$vo['token']));?>'" class="btn" rel="tooltip" title="管理"><i class="icon-cog"></i></a>
                                                </td>
                                            </tr>
					  </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </table>
			<div class="dataTables_paginate paging_full_numbers"><span>       </span></div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<div class="hide" id="tisp">
        <p>尊敬的用户：</p>
    <pre>  您现在使用的是艾米微管家多用户微信营销系统 V1.0</pre>
    <pre>  请拒绝支付淘宝卖家的软件费用，本站地址 bbs.iMicms.com </pre>
    <p class="text-right">艾米微管家团队 2014.5.12</p> </div>

    <script>
    $(function(){
        if ($("#tisp")) {
             var $tisp=$("#tisp");
             G.ui.tips.up($tisp.html())
         }
    });
    </script></body>
</html>