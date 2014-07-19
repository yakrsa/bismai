<?php

class AuthcodeAction extends BackAction{

public function index(){
#$code=md5(microtime());
#cookie('name','bismiatest');
#$this->ajaxReturn($code,"success",1);

$map=array();
$AuthcodeDB=D('Authcode');
$count = $AuthcodeDB->where($map)->count();
			$Page       = new Page($count);// 实例化分页类 传入总记录数
			// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
			$nowPage = isset($_GET['p'])?$_GET['p']:1;
			$show       = $Page->show();// 分页显示输出
			$list = $AuthcodeDB->where($map)->order('id DESC')->page($nowPage.','.C('PAGE_NUM'))->select();			
			$this->assign('list',$list);
			$this->assign('page',$show);// 赋值分页输出
$this->display();
}

public function addAuth(){
#$this->ajaxReturn($this->_post('level'),"fail",0);

$data['level']=$this->_post('level');
$data['code']=md5(microtime());
$data['status']=0;
$data['createtime']= date("Y-m-d H:i:s",time());
$Authcode=M('Authcode');
$Authcode->data($data);
if($Authcode->add()){
	$this->ajaxReturn($data['code'],"success",1);
	}
else{
	$this->ajaxReturn('',"fail",0);
    }
}



public function checkAuthcode($code){

$where["status"]=1;
return $this->field($field)-where($where)->find();
}

public function  del($id){
	$id=$this->_get('id','intval',0);
	if($id==0)$this->error('非法操作');
	$info = D('Authcode')->delete($id);
	if($info==true){
		$this->success('操作成功');		
	}else{
		$this->error('操作失败');
	}
}
}
?>
