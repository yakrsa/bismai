<?php
class PlugmenuModel extends Model{
	protected $_validate =array(
	        array('keyword','require','快捷名称不能为空',1),
		
	);
	
	protected $_auto = array (
	        array('uid','getuser',self::MODEL_INSERT,'callback'),
		array('token','gettoken',self::MODEL_INSERT,'callback'),
		array('createtime','time',self::MODEL_INSERT,'function'),
		array('uptatetime','time',self::MODEL_BOTH,'function'),	
                array('click','0'),		
	);
	
	public function gettoken(){
		return session('token');
	}
	public function getuser(){
		return session('uid');
	}
	
}