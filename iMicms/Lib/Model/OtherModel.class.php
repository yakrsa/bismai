<?php
class OtherModel extends Model{

	protected $_validate =array(
		//array('keyword','require','填写已定义的关键词',1),
		//array('lbs_distance','require','填写默认LBS查询范围',1),
		
	);
	
	protected $_auto = array (
		array('uid','getuser',self::MODEL_INSERT,'callback'),
		array('uname','getname',self::MODEL_INSERT,'callback'),
		array('createtime','time',self::MODEL_INSERT,'function'),
		array('updatetime','time',self::MODEL_BOTH,'function'),		
		array('token','gettoken',self::MODEL_INSERT,'callback'),
		array('click','0'),
	);
	
	public function getuser(){
		return session('uid');
	}
	
	public function getname(){
		return session('uname');
	}
	 
	function gettoken(){
		return session('token');
	}
	
}