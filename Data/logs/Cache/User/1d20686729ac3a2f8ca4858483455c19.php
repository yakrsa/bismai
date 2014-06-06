<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('content');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/iindex.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_responsive_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/sstyle.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/themes.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/todc_bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/bootstrap_switch.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/inside.css" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/inside.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/bootstrap_switch.js"></script>
<title><?php echo C('site_name');?>-<?php echo C('site_title');?></title>
    <link rel="shortcut icon" href="/tpl/static/favicon.ico" />
    <!--[if lte IE 9]><script src="<?php echo RES;?>/js/watermark.js"></script><![endif]-->
	<!--[if IE 7]><link href="<?php echo RES;?>/css/font_awesome_ie7.css" rel="stylesheet" /><![endif]-->
</head>
<body><!-- oncontextmenu="return false" onselectstart ="return false" id="nv_member" class="pg_CURMODULE" onkeydown="if(event.keyCode==27) return false;"-->

	
    <div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">
                    <div class="box">
                        <div class="box-title">
                            <div class="span10">
                                <h3><i class="icon-book"></i>微服务接入服务</h3>
                            </div>
                            <div class="span2"><a class="btn" href="Javascript:window.history.go(-1)">返回</a></div>
                        </div>

                        <div class="box-content">
                            <div class="bs-docs-example">
                                <div class="span6">
                                    <table class=" table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>开通服务</th>
                                                <th>回复关键词</th>
                                                <th>状态</th>
                                            </tr>
                                        </thead>
                                        <tbody>
					
  <?php if(is_array($fun)): $i = 0; $__LIST__ = $fun;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fun): $mod = ($i % 2 );++$i; if(is_array($fun)): $b = 0; $__LIST__ = $fun;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($b % 2 );++$b;?><tr>
                                                <td><span class="sn music"><?php echo ($list["name"]); ?></span></td>
                                                <td><?php echo ($list["info"]); ?></td>
                                                <td>
                                                    <div class="switch switch-small">
                                                        <input type="checkbox"   name="checkapp<?php echo ($list["id"]); ?>" <?php if(in_array($list['funname'],$check)): ?>checked="checked"<?php endif; ?> <?php if($list['gid'] > session('gid')): ?>disabled="disabled"<?php endif; ?> value="<?php echo ($list["id"]); ?>"  onchange="changeapp(this,'<?php echo (session('token')); ?>','<?php echo ($list["id"]); ?>')"  alt="<?php echo ($token); ?>"/>
                                                    </div>

                                                </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
					
 
											
                                        </tbody>
                                    </table>
                                </div>
				
				
				
				       <div class="span6">
                                    <table class=" table table-bordered table-striped">
                                       <thead>
                                            <tr>
                                                <th>开通服务</th>
                                                <th>回复关键词</th>
                                                <th>状态</th>
                                            </tr>
                                        </thead>

                                        <tbody>
					
  <?php if(is_array($fun2)): $i = 0; $__LIST__ = $fun2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fun2): $mod = ($i % 2 );++$i; if(is_array($fun2)): $b = 0; $__LIST__ = $fun2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($b % 2 );++$b;?><tr>
                                                <td><span class="sn music"><?php echo ($list["name"]); ?></span></td>
                                                <td><?php echo ($list["info"]); ?></td>
                                                <td>
                                                    <div class="switch switch-small">
                                                        <input type="checkbox"   name="checkapp<?php echo ($list["id"]); ?>" <?php if(in_array($list['funname'],$check)): ?>checked="checked"<?php endif; ?> <?php if($list['gid'] > session('gid')): ?>disabled="disabled"<?php endif; ?> value="<?php echo ($list["id"]); ?>"  onchange="changeapp(this,'<?php echo (session('token')); ?>','<?php echo ($list["id"]); ?>')"  alt="<?php echo ($token); ?>"/>
                                                    </div>

                                                </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
					
 
											
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
<script>
function changeapp(obj,token,id){
if(obj.checked==true){
   
var myurl='index.php?g=User&m=Token_open&a=add&token='+token+'&id='+id+'&r='+Math.random(); 
$.get(myurl,function(data){
	 if(data==1){
		alert('该功能已经成功添加');
	}
});
}else{
  
var myurl='index.php?g=User&m=Token_open&a=del&token='+token+'&id='+id+'&r='+Math.random(); 
$.get(myurl,function(data){
 if(data==1){
		alert('已经取消该功能');
	}
});
}
}
</script>

</body>
</html>