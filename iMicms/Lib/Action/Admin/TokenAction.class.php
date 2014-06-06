<?php
class TokenAction extends BackAction{
	public function index(){
		$map = array();
		$UserDB = D('Wxuser');
		$count = $UserDB->where($map)->count();
		$Page       = new Page($count,5);// 实例化分页类 传入总记录数
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$nowPage = isset($_GET['p'])?$_GET['p']:1;
		$show       = $Page->show();// 分页显示输出
		$list = $UserDB->where($map)->order('id ASC')->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		foreach($list as $key=>$value){
			$user=M('Users')->field('id,gid,username,connectnum')->where(array('id'=>$value['uid']))->find();
			if($user){
				$list[$key]['user']['username']=$user['username'];
				$list[$key]['user']['connectnum']=$user['connectnum'];
				$list[$key]['user']['gid']=$user['gid']-1;
			}
		}
		//dump($list);
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
		
		
	}
	public function del(){
		$id=$this->_get('id','intval',0);
		$wx=M('Wxuser')->where(array('id'=>$id))->find();
		M('Img')->where(array('token'=>$wx['token']))->delete();
		M('Text')->where(array('token'=>$wx['token']))->delete();
		M('Lottery')->where(array('token'=>$wx['token']))->delete();
		M('Keyword')->where(array('token'=>$wx['token']))->delete();
		M('Photo')->where(array('token'=>$wx['token']))->delete();
		M('Home')->where(array('token'=>$wx['token']))->delete();
		M('Areply')->where(array('token'=>$wx['token']))->delete();
		$diy=M('Diymen_class')->where(array('token'=>$wx['token']))->delete();
		if($diy){
			$this->success('操作成功');
		}else{
			$this->error('操作失败');
		}
	}
	
	public function search(){
	        $data  = array();
		$datas = array();
		$name=$this->_post('name');
		$type=$this->_post('type');
		switch($type){  
			case 1:
			$data['wxname']=$name;
			break;
			case 2:
			$data['wxid']=$name;
			break;
			case 3:
			$data['weixin']=$name;
			break;
			case 4:
			$datas['username']=$name;
		}
		if($data){
		$list=M('Wxuser')->where($data)->select();
		foreach($list as $key=>$value){
			$user=M('Users')->field('id,gid,username,connectnum')->where(array('id'=>$value['uid']))->find();
			if($user){
				$list[$key]['user']['username']=$user['username'];
				$list[$key]['user']['connectnum']=$user['connectnum'];
				$list[$key]['user']['gid']=$user['gid']-1;
			}
			
		}
		}
		
		if($datas){
		$values=D('Users')->where($datas)->find();
		 
		$list=M('Wxuser')->where(array('uid'=>$values['id']))->select();
		 
		foreach($list as $key=>$value){
			$user=M('Users')->field('id,gid,username,connectnum')->where(array('id'=>$value['uid']))->find();
			if($user){
				$list[$key]['user']['username']=$user['username'];
				$list[$key]['user']['connectnum']=$user['connectnum'];
				$list[$key]['user']['gid']=$user['gid']-1;
			}
			
		}
		}
		
		// dump($list);exit;
		$this->assign('Type',$type);
		$this->assign('list',$list);
		$this->display('index');
	
	}
	public function edit(){
		if(IS_POST){
			$this->all_save();
		}else{
			$id=$this->_get('id','intval',0);
			if($id==0)$this->error('非法操作');
			$this->assign('tpltitle','编辑');
			$fun=M('Function')->where(array('id'=>$id))->find();
			$this->assign('info',$fun);
			$group=D('User_group')->getAllGroup('status=1');
			$this->assign('group',$group);
			$this->display('add');
		}
	}
}
?>