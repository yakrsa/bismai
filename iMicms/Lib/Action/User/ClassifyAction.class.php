<?php
/**
 *语音回复
**/
class ClassifyAction extends UserAction{
      public function _initialize() {
		parent::_initialize();
		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		if(!strpos($token_open['queryname'],'plugmenu_set')){
            $this->error('您还未开启一键拨号和版权模块的使用权,请到微接入服务里开启',U('Function/adlist',array('token'=>session('token'),'id'=>session('wxid'))));
		}
	}

	public function index(){
		$db=D('Classify');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('sorts asc')->limit($page->firstRow.','.$page->listRows)->select();
		$ltype =array('img'=>'图文','url'=>'链接','tel'=>'电话','map'=>'导航','activity'=>'活动','business'=>'业务模块');
		foreach ($info as $key => $val) {
		$info[$key]['n_ltype'] = $ltype[$info[$key]['ltype']];
		}

		$this->assign('lclass',$ltype);
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	
	public function add(){
		$this->display();
	}
	
	public function edit(){
		$id=$this->_get('id','intval');
		$info=M('Classify')->find($id);
		
		if($info['ltype']=="business" && $info['business_type']=="Selfform"){
		
		$blist=M('Selfform')->field('id,keyword,name')->where(array('token'=>session('token')))->order('id desc')->select();
		$this->assign('blist',$blist); 
		
		
		}
		
		if($info['ltype']=="business"  && $info['business_type']=="Hotel"){
		
		$blist=M('Host')->field('id,keyword,title')->where(array('token'=>session('token')))->order('id desc')->select();
		
		foreach($blist as $key=>$vo){
			 
			 
			  $blist[$key]['name']=  $vo['title'];
		}
		$this->assign('blist',$blist); 		
		
		}
		
		if($info['ltype']=="business"  && $info['business_type']=="house"){
		
		$blist=M('Estate')->field('id,keyword,title')->where(array('token'=>session('token')))->order('id desc')->select();
		
		foreach($blist as $key=>$vo){
			 
			//$list[$key]['statdate']= date("Y-m-d I:m:s",$vo['statdate']);
			  $blist[$key]['name']=  $vo['title'];
		}
		$this->assign('blist',$blist); 		
		
		}
		 
		if($info['ltype']=="business"  && $info['business_type']=="Panoramic"){
		
		$blist=M('Panoramic')->field('id,keyword,title')->where(array('token'=>session('token')))->order('id desc')->select();
		 
		foreach($blist as $key=>$vo){
			 
			//$list[$key]['statdate']= date("Y-m-d I:m:s",$vo['statdate']);
			  $blist[$key]['name']=  $vo['title'];
		}
		$this->assign('blist',$blist); 		
		
		}
		 
		$activity_type  = intval($info['activity_type']); 
		$activity_value = intval($info['activity_value']); 
		if($activity_type ==4 ) $list=M('Vote')->field('id,keyword,title,statdate,enddate')->where(array('token'=>session('token'),'status'=>1))->select();
		
		else
		if($activity_value ==5 ) $list=M('Wcard')->field('id,keyword,title,date,hour,min')->where(array('token'=>session('token'),'status'=>1))->select();
		else
		if($activity_value ==6 ) $list=M('Goldegg')->field('id,keyword,title,startdate,enddate')->where(array('token'=>session('token'),'status'=>1))->select();
		else
		$list=M('Lottery')->field('id,keyword,title,statdate,enddate')->where(array('token'=>session('token'),'type'=>$activity_type))->select();
		$this->assign('activity_value',$activity_value);
		$this->assign('list',$list);
		
		$this->assign('info',$info);
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
	public function Classify_show(){
		  $data['id']        =$this->_post('id','intval');
		  $data['status']   =$this->_post('ck','intval');
		  
		  $data['token']     =session('token');
		  if(M('Classify')->save($data)){
		 			
				$this->success('操作成功',U(MODULE_NAME.'/index'));
			}else{
				$this->error('操作失败',U(MODULE_NAME.'/index'));
			}
		  
	}
	public function insert(){
	        
		$this->all_insert();
	}
	public function upsave(){
	 
		$this->all_save();
	}
}
?>