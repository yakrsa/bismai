<?php
class Ndisk_listModel extends Model{
	protected $_validate = array(
			array('title','require','相册标题不能为空',1),
			//array('info','require','相册详细内容必须填写',1),
			array('picurl','require','相册封面图片必须填写',1),
			array('id','checkid','非法操作',2,'callback',2),
	 );
	protected $_auto = array (		
		array('token','getToken',Model:: MODEL_INSERT,'callback'),
		array('pid','getpid',Model:: MODEL_INSERT,'callback'),
		array('createtime','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳);
	);
	function checkid(){
		$dataid=$this->field('id')->where(array('id'=>$_POST['id'],'token'=>session('token')))->find();
		if($dataid==false){
			return false;
		}else{
			return true;
		}
	}
	function getToken(){	
		return $_SESSION['token'];
	}
	function getpid(){	
		return (int)$_POST['pid'];
	}
}

?>
