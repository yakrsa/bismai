<?php if (!defined('THINK_PATH')) exit();?><chart caption='<?php echo ($year); ?>年<?php echo ($month); ?>月统计分析' xAxisName='日期' yAxisName='数量' showValues='0' numberPrefix=''>
	<categories>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><category label='<?php echo (date('d',$list["time"])); ?>' /><?php endforeach; endif; else: echo "" ;endif; ?>
	</categories>
    <dataset seriesName='3G网站浏览量'>
		<?php if(is_array($list3g)): $i = 0; $__LIST__ = $list3g;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list3g): $mod = ($i % 2 );++$i;?><set value='<?php echo ($list3g["3g"]); ?>' /><?php endforeach; endif; else: echo "" ;endif; ?>
    </dataset>
    <dataset seriesName='文本请求数'>
		<?php if(is_array($listtext)): $i = 0; $__LIST__ = $listtext;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$listtext): $mod = ($i % 2 );++$i;?><set value='<?php echo ($listtext["textnum"]); ?>' /><?php endforeach; endif; else: echo "" ;endif; ?>
    </dataset>
    <dataset seriesName='图文请求数'>
		<?php if(is_array($listimg)): $i = 0; $__LIST__ = $listimg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$listimg): $mod = ($i % 2 );++$i;?><set value='<?php echo ($listimg["imgnum"]); ?>' /><?php endforeach; endif; else: echo "" ;endif; ?>
    </dataset>
	<dataset seriesName='语音请求数'>
		<?php if(is_array($listvideo)): $i = 0; $__LIST__ = $listvideo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$listvideo): $mod = ($i % 2 );++$i;?><set value='<?php echo ($listvideo["videonum"]); ?>' /><?php endforeach; endif; else: echo "" ;endif; ?>
    </dataset>
	<dataset seriesName='营销/电商请求'>
		<?php if(is_array($listother)): $i = 0; $__LIST__ = $listother;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$listother): $mod = ($i % 2 );++$i;?><set value='<?php echo ($listother["other"]); ?>' /><?php endforeach; endif; else: echo "" ;endif; ?>
    </dataset>
	<dataset seriesName='关注人数'>
		<?php if(is_array($listfollow)): $i = 0; $__LIST__ = $listfollow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$listfollow): $mod = ($i % 2 );++$i;?><set value='<?php echo ($listfollow["follownum"]); ?>' /><?php endforeach; endif; else: echo "" ;endif; ?>
    </dataset>
	<dataset seriesName='取消关注人数'>
		<?php if(is_array($listunfollow)): $i = 0; $__LIST__ = $listunfollow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$listunfollow): $mod = ($i % 2 );++$i;?><set value='<?php echo ($listunfollow["unfollownum"]); ?>' /><?php endforeach; endif; else: echo "" ;endif; ?>
    </dataset>
	<dataset seriesName='总请求数/日'>
		<?php if(is_array($listall)): $i = 0; $__LIST__ = $listall;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$listall): $mod = ($i % 2 );++$i;?><set value='<?php echo $listall['3g']+$listall['textnum']+$listall['imgnum']+$listall['videonum']+$listall['other']?>' /><?php endforeach; endif; else: echo "" ;endif; ?>
    </dataset>
    <styles>
		<definition>
			<style name='CanvasAnim' type='animation' param='_xScale' start='0' duration='1' />
			<style name='iFont' type='font' bold='1' size='12' />
		</definition>
		<application>
			<apply toObject='Canvas' styles='CanvasAnim' />
			<apply toObject='xAxisName' styles='iFont' />
			<apply toObject='yAxisName' styles='iFont' />
		</application>
    </styles>
</chart>