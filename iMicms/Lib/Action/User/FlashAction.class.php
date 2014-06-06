<?php
/**
 *首页幻灯片回复
**/
class FlashAction extends UserAction{
	public function index(){
		$db=D('Flash');
		$where['uid']=session('uid');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('sort asc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function edit(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		$res=D('Flash')->where($where)->find();
		$this->assign('info',$res);
		$this->display();
	}
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		if(D(MODULE_NAME)->where($where)->delete()){
			$this->success('操作成功',U(MODULE_NAME.'/index'));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	public function insert(){
    	$data=array();
        $data['token']=$_SESSION['token'];
    	$data['img']=trim($_POST['img']);
		$data['name']=trim($_POST['name']);
		$data['sort']=trim($_POST['sort']);
    	if($_FILES['file']['name']){
			$img = $this->_upload();
			$data['img'] = $img[0]['savepath'].$img[0]['savename'];
    	}	
    	$data['info']=trim($_POST['info']);
    	$data['url']=trim($_POST['url']);
    	$result=M('flash')->add($data);
		if($result!==false){
				$this->success('操作成功',U(MODULE_NAME.'/index'));
			}
	}
	public function upsave(){
		$this->all_save();
	}
}
?>