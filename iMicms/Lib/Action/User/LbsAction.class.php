<?php
class LbsAction extends UserAction{
	//配置
	
	public function index(){
		$db=D('Lbs');
		$where['uid']= $uid = session('uid');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('uid',$uid); 
		$this->assign('info',$info);
		$this->display();
	}
	public function add(){
		$class=M('Classify')->where(array('token'=>session('token')))->select();
		if($class==false){$this->error('请先添加3G网站分类',U('Classify/index',array('token'=>session('token'))));}
		$db=M('Classify');
		$where['token']=session('token');
		$info=$db->where($where)->select();
		$this->assign('info',$info);
		$this->display();
	}
	public function edit(){
		$where['id']=$this->_get('id','intval'); 
		$where['token']=session('token');
		$where['uid']=session('uid');
		$info=D('Lbs')->where($where)->find();
		$this->assign('info',$info);
		 
		$this->display();
	}
	public function del(){
	
		$where['id']=$this->_post('tid','intval');
		 
		$where['uid']=session('uid');
		if(D(MODULE_NAME)->where($where)->delete()){
			//M('Keyword')->where(array('pid'=>$id,'token'=>session('token'),'module'=>'Lbs'))->delete();
			echo 0;
			//$this->success('操作成功',U(MODULE_NAME.'/index'));
		}else{
			echo -1;
			//$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	
	public function delbatch(){
		$ids =$this->_post('ids');
		if(!$ids)  $this->error('数据错误');
		$ids .=0; 
		
		if($ids) $ids = str_replace("on,","",$ids);
		$where['uid']= session('uid');
		$uid = session('uid');
		if($ids) $where = "uid=$uid AND id IN ($ids)";
		if($ids) 
		{
		$where       = "uid=$uid AND id IN ($ids)";
		 
		$wherekeypid = "uid=$uid AND module='Lbs' AND pid IN ($ids)";
		}
		 
		if(D(MODULE_NAME)->where($where)->delete()){
			M('Keyword')->where($wherekeypid)->delete();
			echo 0;
		}else{
			echo 1;
		}
	}
	public function search(){
		$keyword=$this->_get('keywords');
		$type=$this->_get('type');
		$data['uid']= session('uid'); 
		switch($type){
			case 1:
			$data['title']=$keyword;
			break;
			case 2:
			$data['place']=$keyword;
			break;
			 
		}
		//dump($where);
		$list=M('Lbs')->where($data)->select();
		$this->assign('info',$list);
		$this->display('index');
	
	}
	public function indexs(){
		$Lbs=M('Lbs')->where(array('token'=>session('token')))->find();
		 
		if(IS_POST){
			if($Lbs==false){				
				$this->all_insert('Lbs','/index');
			}else{
				$_POST['id']=$Lbs['id'];
				$this->all_save('Lbs','/index');				
			}
		}else{
			//dump($Lbs);
			$this->assign('Lbs',$Lbs);
			$this->display();
		}
	}
	public function insert(){
	        $farword=$_POST['farword'];
		
		$this->all_insert();
		 
	}
	public function upsave(){
	        $farword=$_POST['farword'];
		$this->all_save();
	}
	
}



?>