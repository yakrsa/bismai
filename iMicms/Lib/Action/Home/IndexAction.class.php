<?php
class IndexAction extends BaseAction{
	//关注回复   offset="0" length="32"
	public function index(){
		
		$db=D('users');
		F('users',null);
		$users  = $db->where('hometj=1')->limit(32)->select();
		$wxuser = M('wxuser')->field('uid,headerpic,wxname')->order('uid desc')->select();
		foreach($wxuser as $k=>$v){
			$w[$v['uid']]=$v['headerpic'];
			$wn[$v['uid']]=$v['wxname'];
		}
		unset($wxuser); 
		 
		$this->assign('list',$users);
		$this->assign('wxuser',$w);
		$this->assign('wxname',$wn);
		
		$this->display();
	}
	public function common(){
	$Case = M('Case')->field('id,name,url,img')->order('id desc')->select();
	$this->assign('list',$Case);
	$this->display();
	}
	
	public function csend(){
	        
		  $data['username'] = $this->_post('username');
		  $data['tel']      = $this->_post('tel');
		  $data['company']  = $this->_post('company');
		  $data['content']  = $this->_post('content');
		  $data['creatime']  = time();
		 
		  $db=D('Customer'); 
		  
		
			$id=$db->add($data);
			if($id){
		         echo 2;
			 }
			 else echo 3;
		  
			 
	}	
	public function setpass(){
	         $where['pid']= $pid = $this->_get('pid');		 
		 $res=M('Users')->field('id,username')->where($where)->select();
		 if($res[0] == false) $this->error('非法操作',U('Index/index'));
		 $this->assign('info',$res[0]);
		 $this->display();
	}	
	public function resetpwd(){
		$uid=$this->_get('uid','intval');
		$code=$this->_get('code','trim');
		$rtime=$this->_get('resettime','intval');
		$info=M('Users')->find($uid);
		if( (md5($info['uid'].$info['password'].$info['email'])!==$code) || ($rtime<time()) ){
			$this->error('非法操作',U('Index/index'));
		}
		$this->assign('uid',$uid);
		$this->display();
	}
}