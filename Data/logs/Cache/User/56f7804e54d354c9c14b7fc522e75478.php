<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Apple devices fullscreen -->
    <meta name="keywords" content="<?php echo C('keyword');?>" />
    <meta name="description" content="<?php echo C('content');?>" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <base target="mainFrame" />
    <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/iindex.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_responsive_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/sstyle.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/themes.css" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/application.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js"></script>
<title><?php echo C('site_name');?>-<?php echo C('site_title');?></title>
    <!--[if IE 7]>
       <link href="<?php echo RES;?>/css/font_awesome_ie7.css" rel="stylesheet" />
    <![endif]-->
    <link rel="shortcut icon" href="/tpl/static/favicon.ico" />
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?php echo RES;?>/js/excanvas_min.js"></script><![endif]-->

</head>

<body>
    <div id="navigation">
        <div class="container-fluid">
            <div>
                <a href="/" target="_blank" id="brand"></a>
                <a href="/index.php?g=User&m=Index&a=index" target="_self" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
            </div>
            <ul class='main-nav'>
	    
	       
                <li class='active'>
                    <a href="/index.php?g=User&m=Index&a=index" target="_self">
                        <span>管理平台</span>
                    </a>
                </li>

                <li><a href="/index.php?g=User&m=Index&a=packageintr">套餐介绍</a></li>
                <li><a href="/index.php?g=User&m=Index&a=info">功能介绍</a> </li>

                <li style="display:;">
                    <a href="javascript:void(0)" data-toggle="dropdown" class='dropdown-toggle' data-hover="dropdown">
                        <span>个性化服务</span>
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="/index.php?g=User&m=Index&a=trusteeship">运营托管</a></li>
                        <li><a href="/index.php?g=User&m=Index&a=customdev">定制开发</a></li>
                    </ul>
                </li>

                <li><a href="javascript:void(0)" data-toggle="dropdown" class='dropdown-toggle' data-hover="dropdown">
                    <span>帮助中心</span>
                    <span class="caret"></span>
                </a>
                    <ul class="dropdown-menu">

                        <li><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank">在线客服</a></li>
                        <li><a href="/index.php?g=User&m=Index&a=userguide">使用指南</a></li>
                        <li><a href="/index.php?g=User&m=Index&a=about">关于我们</a></li>
                        <li><a href="/index.php?g=User&m=Index&a=help">常见问题</a></li>
                        

                    </ul>

                </li>



            </ul>

            <div class="user">
                <ul class="icon-nav">
                    <li class='dropdown'>
                        <a href="#" class='dropdown-toggle' data-toggle="dropdown" title="消息" style="display:none;"><i class="icon-envelope"></i><span class="label label-lightred">4</span></a>
                    </li>
                    <li class="dropdown sett" style="display:none;">
                        <a href="#" class='dropdown-toggle' data-toggle="dropdown" title="系统设置"><i class="icon-cog"></i></a>
                    </li>
                    <li class='dropdown colo'>
                        <a href="#" class='dropdown-toggle' data-toggle="dropdown" title="选择颜色"><i class="icon-tint"></i></a>
                        <ul class="dropdown-menu pull-right theme-colors">
                            <li class="subtitle">选择颜色
                            </li>
                            <li>
                                <span class='red'></span>
                                <span class='orange'></span>
                                <span class='green'></span>
                                <span class="brown"></span>
                                <span class="blue"></span>
                                <span class='lime'></span>
                                <span class="teal"></span>
                                <span class="purple"></span>
                                <span class="pink"></span>
                                <span class="magenta"></span>
                                <span class="grey"></span>
                                <span class="darkblue"></span>
                                <span class="lightred"></span>
                                <span class="lightgrey"></span>
                                <span class="satblue"></span>
                                <span class="satgreen"></span>
                            </li>
                        </ul>
                    </li>
                     <li>
                         <a href="/#" onclick="Javascript:window.open('<?php echo U('Admin/Admin/logout');?>','_self')"    title="退出"><?php echo (session('uname')); ?> <i class="icon-signout"></i> 退出</a>
                    </li>

                </ul>


            </div>
        </div>
    </div>
    <div class="container-fluid" id="content">
        <div id="left">
            <div class="subnav">
                <div class="subnav-title ">
                    <a href="javascript:void(0)" class='toggle-subnav'><i class="icon-angle-right"></i><span>我的管家</span></a>
                </div>
                <ul class="subnav-menu" style="display: block">
                    <li >
                        <a href="/index.php?g=User&m=Index&a=user">商户信息</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Index/useredit');?>">修改密码</a>
                    </li>
                    <li class="active">
                        <a href="/index.php?g=User&m=Index&a=acount">公众帐号管理</a>
                    </li>
                </ul>
            </div>



        </div>
        <div class="right">
            <div class="main">

                <iframe frameborder="0" id="mainFrame" name="mainFrame" src="/index.php?g=User&m=Index&a=acount" style="background: url('/tpl/static/loading.gif') center no-repeat"></iframe>

            </div>
        </div>

    </div>
<script type="text/javascript">  P.skn();  </script>
<script type="text/javascript" src="/tpl/static/huishuo.js"></script>
</body>

</html>