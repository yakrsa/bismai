<?php
class FlashModel extends Model{
	protected $_validate =array(
	        array('name','require','幻灯片名称不能为空',1),
	        array('info','require','幻灯片描述不能为空',1),
		array('img','require','幻灯片封面地址不正确',1),
	);
	
	protected $_auto = array (
		array('token','gettoken',self::MODEL_INSERT,'callback'),
	);
	
	public function gettoken(){
		return session('token');
	}
	
	
}