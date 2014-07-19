<?php

class AuthcodeAction extends Action{

public function index(){
$code=md5(microtime());
#cookie('name','bismiatest');
$this->ajaxReturn($code,"success",1);
}

public function addAuth(){
$AuthcodeDB=D("Authcode");
$data['level']=$this->_post('level');
$data['code']=md5($Think.now);
$data['status']=1;

if($AuthcodeDB->create()){
	if($AuthcodeDB->add){
		$this->ajaxReturn($data['code'],"success",1);
	}else{
		$this->ajaxReturn('',"fail",0);
		}
	}else{
	$this->ajaxReturn(''."fail",-1);
	}
}



public function checkAuthcode($code){

$where["status"]=1;
return $this->field($field)-where($where)->find();
}
}
?>
