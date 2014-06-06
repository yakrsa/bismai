<?php
class VoteModel extends Model{

	protected $_validate =array(
		array('vtitle','require','标题不能为空',1),
		array('keyword','require','关键词必须填写',1),
		array('time','require','投票起始时间必须填写',1),
	);
	
	protected $_auto = array (
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