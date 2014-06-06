<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> <?php echo C('site_title');?> <?php echo C('site_name');?></title>
<meta name="keywords" content="<?php echo C('keyword');?>" />
<meta name="description" content="<?php echo C('content');?>" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<script>var SITEURL='';</script>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/style_2_common.css?BPm" />

</head>
<body id="nv_member" class="pg_CURMODULE" onkeydown="if(event.keyCode==27) return false;">
 
    
    
 

 <link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css" />
 <div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">

                    <div class="box">
                        <div class="box-title">
                            <div class="span8">
                                <h3><i class="icon-table"></i>运营图表</h3>
                            </div>
                        </div>
				<script src="<?php echo RES;?>/flash/FusionCharts.js" type="text/javascript"></script>
				<div id="<?php echo MODULE_NAME;?>" class="content <?php echo MODULE_NAME;?>">
					<div class="cLineB">
						<h4 class="left">
							帐号请求数详情选择月份
							<select class="setting-period" name="period" id="period" onchange="doit(this.value)">
								<?php if(is_array($time)): $i = 0; $__LIST__ = $time;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imicms): $mod = ($i % 2 );++$i;?><option <?php if($imicms == $now_m): ?>selected="selected<?php endif; ?>"value="<?php echo ($imicms); ?>"><?php echo ($imicms); ?>月</option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</h4>
						<div class="clr"></div>
					</div>
					<div class="msgWrap">
						<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:20px 0; ">
							<tbody>
								<tr>
									<td align="center" bgcolor="#f9f9f9">
										<div id="iChartwrap" align="center"></div>
										<script type="text/javascript">
											var iChart = new FusionCharts("<?php echo RES;?>/flash/MSLine.swf", "ChartId", "996", "400", "0", "0");
											iChart.setDataURL("<?php echo U('User/Stats/getxmldata');?>");
											iChart.render("iChartwrap");
										</script>
									</td>
								</tr>
								<tr>
									<td align="center" bgcolor="#f9f9f9">
										<div id="chartdiv2" align="center"></div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div id="ajaxmsgWrap" class="msgWrap">
						<table width="100%" cellspacing="0" cellpadding="0" border="0" class="ListProduct">
							<thead>
								<tr>
									<th>日期</th>
									<th>3G网站浏览量</th>
									<th>文本请求数</th>
									<th>图文请求数</th>
									<th>语音请求数</th>
									<th>营销/电商请求</th>
									<th>关注人数</th>				
									<th>取消关注人数</th> 
									<th>总请求数/日</th>
								</tr>
							</thead>
							<tfoot>
								 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo (date('Y-m-d',$list["time"])); ?></td>
										<td><?php echo ($list["3g"]); ?></td>
										<td><?php echo ($list["textnum"]); ?></td>
										<td><?php echo ($list["imgnum"]); ?></td>
										<td><?php echo ($list["videonum"]); ?></td>
										<td><?php echo ($list["other"]); ?></td>					
										<td><?php echo ($list["follownum"]); ?></td>
										<td><?php echo ($list["unfollownum"]); ?></td>											 
										<td><?php echo $list['3g']+$list['textnum']+$list['imgnum']+$list['videonum']+$list['other']?></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							</tfoot> 			
						</table>
					</div>
					<div class="cLine">
						<div class="pageNavigator right">
							<div class="pages"><?php echo ($page); ?></div>
						</div>
						<div class="clr"></div>
					</div>
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
	<div class="clr"></div>
	<script>
	function doit(month){
		$.get("<?php echo U('User/Stats/getxmldata');?>", { month: month}, function(result){
			var iChart = new FusionCharts("<?php echo RES;?>/flash/MSLine.swf", "ChartId", "996", "400", "0", "0");
			iChart.setXMLData(result);
			iChart.render("iChartwrap");
		});
		$.get("<?php echo U('User/Stats/getajaxdata');?>", { month: month}, function(res){
			$("#ajaxmsgWrap").html(res);
		});
	}
	</script>
 
 
<div style="display:none">

</div>
</body>
</html>