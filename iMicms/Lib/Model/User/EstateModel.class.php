<?php
class EstateModel extends Model{
	protected $_validate = array(
			array('title','require','相册标题不能为空',1),
			array('keyword','require','关键字不能为空',1),
			array('album_title','require','相册标题必须填写',1),			 
			 
			 

	 );
	protected $_auto = array (		
		array('token','getToken',Model:: MODEL_BOTH,'callback'),
		array('categoryid','getclassid',self::MODEL_BOTH,'callback'),
		array('categoryname','getclassname',self::MODEL_BOTH,'callback'),
		array('create_time','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳);
	);
	//获取分类ID
	public function getclassid(){
		$id=explode(',',$_POST['category_id']);
		return $id[0];
	}
	//获取分类名字
	public function getclassname(){
		$id=explode(',',$_POST['category_id']);
		return $id[1];
	} 
	function getToken(){	
		return $_SESSION['token'];
	}
}

?>
