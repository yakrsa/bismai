<?php
class PanoramaModel extends Model{
	protected $_validate = array(
			array('title','require','相册标题不能为空',1),
			array('keyword','require','关键字不能为空',1),
			 		 
			 
			 

	 );
	protected $_auto = array (		
		array('token','getToken',Model:: MODEL_BOTH,'callback'),
		 
		array('create_time','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳);
	);
	 
	function getToken(){	
		return $_SESSION['token'];
	}
}

?>
