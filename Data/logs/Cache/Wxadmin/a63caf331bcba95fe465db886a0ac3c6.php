<?php if (!defined('THINK_PATH')) exit();?><link href="<?php echo RES;?>/css/admin/bootstrap_min.css" rel="stylesheet"/>
<link href="<?php echo RES;?>/css/admin/style.css" rel="stylesheet"/>
<div class="pad_lr_10 main" >
    <form name="searchform" method="get" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div class="explain_col">
                    <input type="hidden" name="g" value="admin" />
                    <input type="hidden" name="m" value="item" />
                    <input type="hidden" name="a" value="index" />
                    <input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />
					<?php if($sm != ''): ?><input type="hidden" name="sm" value="<?php echo ($sm); ?>" /><?php endif; ?>
                    发布时间 :
                    <input type="text" name="time_start" id="J_time_start" class="date" size="12" value="<?php echo ($search["time_start"]); ?>">
                    -
                    <input type="text" name="time_end" id="J_time_end" class="date" size="12" value="<?php echo ($search["time_end"]); ?>">

					&nbsp;&nbsp;分类 :
                    <select class="J_cate_select mr10" data-pid="0" data-uri="<?php echo U('item_cate/ajax_getchilds', array('type'=>0));?>" data-selected="<?php echo ($search["selected_ids"]); ?>"></select>
                    <input type="hidden" name="cate_id" id="J_cate_id" value="<?php echo ($search["cate_id"]); ?>" />
          	&nbsp;&nbsp;是否上架 :  
          	<select name="status" >
          	<option value="">--所有--</option>
          	<option <?php if($search["status"] == 1): ?>selected=''<?php endif; ?> value="1">上架</option>
          	<option <?php if($search["status"] == 0): ?>selected=''<?php endif; ?> value="0">下架</option>
          	</select>
			&nbsp;&nbsp;是否新品 :
			<select name="news" >
          	<option value="">--所有--</option>
          	<option <?php if($search["status"] == 1): ?>selected=''<?php endif; ?> value="1">是</option>
          	<option <?php if($search["status"] == 0): ?>selected=''<?php endif; ?> value="0">否</option>
          	</select>
			&nbsp;&nbsp;是否推荐 :
			<select name="tuijian" >
          	<option value="">--所有--</option>
          	<option <?php if($search["status"] == 1): ?>selected=''<?php endif; ?> value="1">是</option>
          	<option <?php if($search["status"] == 0): ?>selected=''<?php endif; ?> value="0">否</option>
          	</select>
                    <div class="bk8"></div>

                    价格区间 :
                    <input type="text" name="price_min" class="input-text" size="5" value="<?php echo ($search["price_min"]); ?>" />
                    -
                    <input type="text" name="price_max" class="input-text" size="5" value="<?php echo ($search["price_max"]); ?>" />
					
					

                    &nbsp;&nbsp;关键字 :
                    <input name="keyword" type="text" class="input-text" size="25" value="<?php echo ($search["keyword"]); ?>" />
                    <input type="submit" name="search" class="btn" value="搜索" />
					
                </div>
                </td>
            </tr>
        </tbody>
    </table>
    </form>
    <?php if($sm == 'image'): ?><div class="J_tablelist item_imglist clearfix">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="item fl">
            <label>
            <input type="checkbox" class="J_checkitem check" value="<?php echo ($val["id"]); ?>" />
            <div class="img clearfix"><img src="<?php echo attach(get_thumb($val['img'], '_m'), 'item');?>"></div>
            </label>
            <span class="line_x"><?php echo ($val["title"]); ?></span>
            <ul>
                <li><a class="J_tooltip btn_blue" title="<?php echo ($cate_list[$val['cate_id']]); ?>"><?php echo L('cate');?></a></li>
                <li><a class="J_tooltip btn_blue" title="<?php echo (($val["uname"])?($val["uname"]):L('item_no_author')); ?>"><?php echo L('author');?></a></li>
            </ul>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <?php else: ?>
    <div class="J_tablelist table_list" data-acturi="<?php echo U('item/ajax_edit');?>">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width=25><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                <th><span data-tdtype="order_by" data-field="id">ID</span></th>
                <th width="40">&nbsp;</th>
                <th align="left"><span data-tdtype="order_by" data-field="title">商品名称</span></th>
                <th width="70"><span data-tdtype="order_by" data-field="buy_num">卖出数量</span></th>
				<th width="70"><span data-tdtype="order_by" data-field="goods_stock">库存</span></th>
                <th width="60"><span data-tdtype="order_by" data-field="cate_id">分类</span></th>
               
                <th width="70"><span data-tdtype="order_by" data-field="price">价格(元)</span></th>
				
                <th width="40"><span data-tdtype="order_by" data-field="ordid"><?php echo L('sort_order');?></span></th>
                <th width="70"><span data-tdtype="order_by" data-field="status">是否上架</span></th>
				<th width="70"><span data-tdtype="order_by" data-field="news">是否新品</span></th>
				<th width="70"><span data-tdtype="order_by" data-field="tuijian">是否推荐</span></th>
                <th width="120"><span data-tdtype="order_by" data-field="add_time">发布时间</span></th>
                <th width="80"><?php echo L('operations_manage');?></th>
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><input type="checkbox" class="J_checkitem" value="<?php echo ($val["id"]); ?>"></td>
                <td align="center"><?php echo ($val["id"]); ?></td>
                <td align="right">
                    <?php if(!empty($val['img'])): ?><div class="img_border"><img src="<?php echo attach(get_thumb($val['img'], '_s'), 'item');?>" width="32" width="32" class="J_preview" data-bimg="<?php echo attach($val['img'], 'item');?>"></div><?php endif; ?>
                </td>
                <td align="left"><span data-tdtype="edit" data-field="title" data-id="<?php echo ($val["id"]); ?>" class="tdedit" style="color:<?php echo ($val["colors"]); ?>;"><?php echo ($val["title"]); ?></span></td>
             <td align="center"><b><?php echo ($val["buy_num"]); ?></b></td>
			 <td align="center"><b><?php echo ($val["goods_stock"]); ?></b></td>
                <td align="center"><b><?php echo ($cate_list[$val['cate_id']]); ?></b></td>
               
                
                <td align="center" class="red"><?php echo ($val["price"]); ?></td> 
				
                <td align="center"><span data-tdtype="edit" data-field="ordid" data-id="<?php echo ($val["id"]); ?>" class="tdedit"><?php echo ($val["ordid"]); ?></span></td>
                <td align="center"><img data-tdtype="toggle" data-id="<?php echo ($val["id"]); ?>" data-field="status" data-value="<?php echo ($val["status"]); ?>" src="__STATIC__/images/admin/toggle_<?php if($val["status"] == 0): ?>disabled<?php else: ?>enabled<?php endif; ?>.gif" /></td>
				<td align="center"><img data-tdtype="toggle" data-id="<?php echo ($val["id"]); ?>" data-field="news" data-value="<?php echo ($val["news"]); ?>" src="__STATIC__/images/admin/toggle_<?php if($val["news"] == 0): ?>disabled<?php else: ?>enabled<?php endif; ?>.gif" /></td>
				<td align="center"><img data-tdtype="toggle" data-id="<?php echo ($val["id"]); ?>" data-field="tuijian" data-value="<?php echo ($val["tuijian"]); ?>" src="__STATIC__/images/admin/toggle_<?php if($val["tuijian"] == 0): ?>disabled<?php else: ?>enabled<?php endif; ?>.gif" /></td>
                <td align="center"><?php echo (date('Y-m-d H:i:s',$val["add_time"])); ?></td>
                <td align="center"><a href="<?php echo u('item/edit', array('id'=>$val['id'], 'menuid'=>$menuid));?>"><?php echo L('edit');?></a> | <a href="javascript:void(0);" class="J_confirmurl" data-uri="<?php echo u('item/delete', array('id'=>$val['id']));?>" data-acttype="ajax" data-msg="<?php echo sprintf(L('confirm_delete_one'),$val['title']);?>"><?php echo L('delete');?></a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	</tbody>
    </table>
    </div><?php endif; ?>
    <div class="btn_wrap_fixed">
        <label class="select_all mr10"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('item/delete');?>" data-name="id" data-msg="<?php echo L('confirm_delete');?>" value="<?php echo L('delete');?>" />
        <div id="pages"><?php echo ($page); ?></div>
    </div>
</div>
<script src="<?php echo RES;?>/js/jquery/jquery.js"></script>
<script src="<?php echo RES;?>/js/jquery/plugins/jquery.tools.min.js"></script>
<script src="<?php echo RES;?>/js/jquery/plugins/formvalidator.js"></script>
<script src="<?php echo RES;?>/js/pinphp.js"></script>
<script src="<?php echo RES;?>/js/admin.js"></script>
<script>
//��ʼ������
(function (d) {
    d['okValue'] = lang.dialog_ok;
    d['cancelValue'] = lang.dialog_cancel;
    d['title'] = lang.dialog_title;
})($.dialog.defaults);
</script>

<?php if(isset($list_table)): ?><script src="<?php echo RES;?>/js/jquery/plugins/listTable.js"></script>
<script>
$(function(){
	$('.J_tablelist').listTable();
});
</script><?php endif; ?>
<link rel="stylesheet" href="<?php echo RES;?>/js/calendar/calendar-blue.css"/>
<script src="<?php echo RES;?>/js/calendar/calendar.js"></script>
<script>
Calendar.setup({
	inputField : "J_time_start",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
Calendar.setup({
	inputField : "J_time_end",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
$('.J_preview').preview(); //查看大图
$('.J_cate_select').cate_select({top_option:lang.all}); //分类联动
$('.J_tooltip[title]').tooltip({offset:[10, 2], effect:'slide'}).dynamic({bottom:{direction:'down', bounce:true}});
</script>