<?php
class FunctionAction extends UserAction{
	public function index(){
	 
		$id=$this->_get('id','intval');
		$token=$this->_get('token','trim');	
	        $info=M('Wxuser')->find($id);
		$this->assign('info',$info); 
		$this->assign('id',$id);
		$this->assign('token',$token);
		$this->display();
		$login_info=array();
		#$login_info['user']='user';
		$login_info['weichatid']=$token;
		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"'); 
		session_start();
		session("login_info",$login_info);	
		$wxid=md5($info['wxid']);
		$tkey=$wxid.$id;
		cookie("tkey",$tkey,"expire=80000&path=/&domain=.bismai.com");
	}
	
	public function fclist(){
	 
		$id=$this->_get('id','intval');
		$token=$this->_get('token','trim');	
		$info=M('Wxuser')->find($id);
		if($info==false||$info['token']!==$token){
			$this->error('非法操作',U('Home/Index/index'));
		}
		session('token',$token);
		session('wxid',$info['id']);
		//第一次登陆　创建　功能所有权
		$token_open=M('Token_open');
		$toback=$token_open->field('id,queryname')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
		$open['uid']=session('uid');
		$open['token']=session('token');
		//遍历功能列表
		
		$check=explode(',',$toback['queryname']);
		$this->assign('check',$check);
		
		$group=M('User_group')->field('id,name')->where('status=1 and id<2')->select();
		foreach($group as $key=>$vo){
			$fun=M('Function')->where(array('status'=>1,'gid'=>$vo['id']))->select();
			foreach($fun as $vkey=>$vo){
				$function[$key][$vkey]=$vo;
			}
		}
		
		$group2=M('User_group')->field('id,name')->where('status=1 and id<4 and id>1')->select();
		foreach($group2 as $key2=>$vo2){
			$fun2=M('Function')->where(array('status'=>1,'gid'=>$vo2['id']))->select();
			foreach($fun2 as $vkey2=>$vo2){
				$function2[$key2][$vkey2]=$vo2;
			}
		}
		
		$this->assign('fun2',$function2);
		$this->assign('fun',$function);
		$this->assign('id',$id);
		$this->assign('token',$token);
		 
		$this->display();
	}
	public function adlist(){
	 
		$id=$this->_get('id','intval');
		$token=$this->_get('token','trim');	
		$info=M('Wxuser')->find($id);
		if($info==false||$info['token']!==$token){
			$this->error('非法操作',U('Home/Index/index'));
		}
		session('token',$token);
		session('wxid',$info['id']);
		//第一次登陆　创建　功能所有权
		$token_open=M('Token_open');
		$toback=$token_open->field('id,queryname')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
		$open['uid']=session('uid');
		$open['token']=session('token');
		//遍历功能列表
		
		$check=explode(',',$toback['queryname']);
		$this->assign('check',$check);
		
		$group=M('User_group')->field('id,name')->where('status=1 and id>3')->select();
		foreach($group as $key=>$vo){
			$fun=M('Function')->where(array('status'=>1,'gid'=>$vo['id']))->select();
			foreach($fun as $vkey=>$vo){
				$function[$key][$vkey]=$vo;
			}
		}
		 
		
		 
		$this->assign('fun',$function);
		$this->assign('id',$id);
		$this->assign('token',$token);
		 
		$this->display();
	}
	
	
	public function fcindex(){
	        $where['uid']=session('uid');  
		$gid = session('gid');  
		 
		$id=$this->_get('id','intval');
		$token=$this->_get('token','trim');	
		
		$db=M('Wxuser');
		$info=$db->find($id);
		
		if($info==false||$info['token']!==$token){
			$this->error('非法操作',U('Home/Index/index'));
		}
		
		$count=$db->where($where)->count();
		
		$userg=M('User_group')->field('gongzhongnum,name')->find($gid); 
		 
		 
		
		session('token',$token);
		session('wxid',$info['id']);
		//第一次登陆　创建　功能所有权
		$token_open=M('Token_open');
		$toback=$token_open->field('id,queryname')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
		$open['uid']=session('uid');
		$open['token']=session('token');
		 
		
		$group=D('User_group')->select();
		foreach($group as $key=>$val){
			$groups[$val['id']]['did']=$val['diynum'];
			$groups[$val['id']]['cid']=$val['connectnum'];
		}
		unset($group);
		//遍历功能列表
		$this->assign('userg',$userg);
		$this->assign('total',$count);
		$this->assign('info',$info); 
		$this->assign('id',$id);
		$this->assign('token',$token);
		$this->assign('group',$groups); 
		$this->display();
	}
	 
}

?>
