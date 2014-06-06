<?php
	class GoldeggModel extends Model{
	protected $_validate = array(
			array('keyword','require','关键词不能为空',1),
			array('title','require','兑奖信息不能为空',1),
			array('summary','require','筒介不能为空',1),
			array('startdate','require','开始时间不能为空',1),
			array('enddate','require','结束时间不能为空',1),
			array('info','require','活动说明不能为空',1),
			array('endtite','require','活动结束公告内容不能为空',1),
			array('endinfo','require','活动结束说明不能为空',1),
			array('first','require','一等奖奖品不能为空',1),
			array('firstnums','require','一等奖奖品数量不能为空',1),
			array('allpeople','require','预计抽奖人数不能为空',1),
	 );
	protected $_auto = array (    
	array('status','0'), 
	array('createtime','time',1,'function'),
	);
}

?>