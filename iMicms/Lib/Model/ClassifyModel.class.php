<?php
class ClassifyModel extends Model{
	protected $_validate =array(
		array('name','require','分类名不能为空',1),
		
	);
	
	protected $_auto = array (	       
		array('token','gettoken',self::MODEL_INSERT,'callback'),
		array('createtime','time',self::MODEL_INSERT,'function'),
		array('uptatetime','time',self::MODEL_BOTH,'function'),	
                	 	
	);
	
	public function gettoken(){
		return session('token');
	}
	public function getuser(){
		return session('uid');
	}
	
	
}
