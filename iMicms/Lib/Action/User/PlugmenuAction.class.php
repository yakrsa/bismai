<?php
 
class PlugmenuAction extends UserAction{
        public function _initialize() {
		parent::_initialize();
		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		if(!strpos($token_open['queryname'],'plugmenu_set')){
            $this->error('您还未开启该模块的使用权,请到微接入服务里开启',U('Function/adlist',array('token'=>session('token'),'id'=>session('wxid'))));
		}
	}


	public function index(){
		$db=D('Plugmenu');
		$where['uid']=session('uid');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$ltype =array('link'=>'链接','tel'=>'电话','map'=>'导航','activity'=>'活动','business'=>'业务模块');
		 
		$users = D('Wxuser')->where($where)->select(); 		 
		
		$info  = $db->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->assign('user',$users[0]);
		$this->assign('lclass',$ltype);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function plugmenu_show(){
		  $data['id']        =$this->_post('id','intval');
		  $data['display']   =$this->_post('ck','intval');
		  $data['uid']       =session('uid');
		  $data['token']     =session('token');
		  if(M('Plugmenu')->save($data)){
		 			
				$this->success('操作成功',U(MODULE_NAME.'/index'));
			}else{
				$this->error('操作失败',U(MODULE_NAME.'/index'));
			}
		  
	}
	
	public function copyright(){
	        $data['id']         =$this->_post('id','intval');
		$data['namecolor']  =$this->_post('namecolor','trim');
		$data['copyright']  =$this->_post('copyright','trim');
		//$data['copyid']     =$this->_post('homemenu','intval');
                $data['copyid']=0;
	        
		 
		
		if(M('Wxuser')->save($data)){
		 			
				$this->success('操作成功',U(MODULE_NAME.'/index'));
			}else{
				$this->error('操作失败',U(MODULE_NAME.'/index'));
			}
		 
	}                              
	public function getlist(){
               
		$type=$this->_post('type','intval'); 
		$list=M('Lottery')->field('id,keyword,title,statdate,enddate')->where(array('token'=>session('token'),'type'=>$type))->select();
		$counts = count($list); 
		$arr = array();
		foreach($list as $key=>$vo){
			 
			$list[$key]['statdate']= date("Y-m-d I:m:s",$vo['statdate']);
			$list[$key]['enddate']=  date("Y-m-d I:m:s",$vo['enddate']);
		}
		$arr= array('data'=>$list,'counts'=>$counts,'success'=>true); 
		echo json_encode($arr);  
		 
	}
	public function votelist(){
               
		$type=$this->_post('type','intval'); 
		$list=M('Vote')->field('id,keyword,title,qstime')->where(array('token'=>session('token'),'status'=>1))->select();
		$counts = count($list); 
		$arr = array();
		foreach($list as $key=>$vo){
			 
			$ts                     = explode("-",$vo['qstime']);
			$list[$key]['statdate'] = trim($ts[0]);
			$list[$key]['enddate']  = trim($ts[1]);
		}
		$arr= array('data'=>$list,'counts'=>$counts,'success'=>true); 
		echo json_encode($arr);  
		 
	}
	
	//微喜帖列表
		public function wcardlist(){
               
		$type=$this->_post('type','intval'); 
		$list=M('Wcard')->field('id,keyword,title,date,hour,min')->where(array('token'=>session('token')))->select();
		$counts = count($list); 
		$arr = array();
		foreach($list as $key=>$vo){
			 
			$list[$key]['date']                     = $vo['date'];
			$list[$key]['hour']                     = $vo['hour'];
			$list[$key]['min']                     = $vo['min'];

		}
		$arr= array('data'=>$list,'counts'=>$counts,'success'=>true); 
		echo json_encode($arr);  
		 
	}
	//砸金蛋列表
		public function Goldegglist(){
   
	    $type=$this->_post('type','intval'); 
		$list=M('GoldenEgg')->field('id,keyword,title,startdate,enddate')->where(array('token'=>session('token')))->select();
		$counts = count($list); 
		$arr = array();
		foreach($list as $key=>$vo){
			 
			$list[$key]['startdate']= date("Y-m-d I:m:s",$vo['startdate']);
			$list[$key]['enddate']=  date("Y-m-d I:m:s",$vo['enddate']);
		}
		$arr= array('data'=>$list,'counts'=>$counts,'success'=>true); 
		echo json_encode($arr);  
		 
	}
	
	public function getbusiness(){
	       
	        $ptype=$this->_post('ptype'); 
		
		if($ptype == "Selfform")
		$list=M('Selfform')->field('id,keyword,name')->where(array('token'=>session('token')))->order('id desc')->select();
		if($ptype == "Hotel")
		$list=M('Host')->field('id,keyword,title')->where(array('token'=>session('token')))->order('id desc')->select();
		
		if($ptype == "house")
		$list=D('Estate')->field('id,keyword,title')->where(array('token'=>session('token')))->order('id desc')->select();
		
		if($ptype == "Panoramic")
		$list=D('Panoramic')->field('id,keyword,title')->where(array('token'=>session('token')))->order('id desc')->select();
		
		 
		$counts = count($list); 
		$arr = array();
		foreach($list as $key=>$vo){
			 
			// $list[$key]['statdate']= date("Y-m-d I:m:s",$vo['time']);
			if($ptype == "Hotel" || $ptype == "house" || $ptype == "Panoramic" ) $list[$key]['name']=  $vo['title'];
		}
		$arr= array('data'=>$list,'counts'=>$counts,'success'=>true); 
		echo json_encode($arr);  
		 
	}
	public function edit(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		$res=D('Plugmenu')->where($where)->find();
		
		
		if($res['ltype']=="business" && $res['business_type']=="Selfform"){
		
		$blist=M('Selfform')->field('id,keyword,name')->where(array('token'=>session('token')))->order('id desc')->select();
		$this->assign('blist',$blist); 
		
		
		}
		
		if($res['ltype']=="business"  && $res['business_type']=="Hotel"){
		
		$blist=M('Host')->field('id,keyword,title')->where(array('token'=>session('token')))->order('id desc')->select();
		
		foreach($blist as $key=>$vo){
			 
			 
			  $blist[$key]['name']=  $vo['title'];
		}
		$this->assign('blist',$blist); 		
		
		}
		
		if($res['ltype']=="business"  && $res['business_type']=="house"){
		
		$blist=M('Estate')->field('id,keyword,title')->where(array('token'=>session('token')))->order('id desc')->select();
		
		foreach($blist as $key=>$vo){
			 
			//$list[$key]['statdate']= date("Y-m-d I:m:s",$vo['statdate']);
			  $blist[$key]['name']=  $vo['title'];
		}
		$this->assign('blist',$blist); 		
		
		}
		if($res['ltype']=="business"  && $res['business_type']=="Panoramic"){
		
		$blist=M('Panoramic')->field('id,keyword,title')->where(array('token'=>session('token')))->order('id desc')->select();
		
		foreach($blist as $key=>$vo){
			 
			//$list[$key]['statdate']= date("Y-m-d I:m:s",$vo['statdate']);
			  $blist[$key]['name']=  $vo['title'];
		}
		$this->assign('blist',$blist); 		
		
		}
		
		
		$activity_type  = intval($res['activity_type']); 
		$activity_value = intval($res['activity_value']); 
		if($activity_type ==4 ) $list=M('Vote')->field('id,keyword,title,statdate,enddate')->where(array('token'=>session('token'),'status'=>1))->select();
		else
		if($activity_type ==5 ) $list=M('Wcard')->field('id,keyword,title,date,hour,min')->where(array('token'=>session('token'),'status'=>1))->select();
		else
		if($activity_type ==6 ) $list=M('GoldenEgg')->field('id,keyword,title,startdate,enddate')->where(array('token'=>session('token'),'status'=>1))->select();
		else
		$list=M('Lottery')->field('id,keyword,title,statdate,enddate')->where(array('token'=>session('token'),'type'=>$activity_type))->select();
		$this->assign('activity_value',$activity_value);
		$this->assign('list',$list);
		$this->assign('info',$res);
		$this->display();
	}
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		 
		if(D(MODULE_NAME)->where($where)->delete()){
		        $result = array('info'=>'操作成功','url'=>U(MODULE_NAME.'/index')); 
			//echo json_encode($result);
			$this->success('操作成功',U(MODULE_NAME.'/index'));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	public function insert(){
		//C('TOKEN_ON',false);
		 
		$this->all_insert();
	}
	public function upsave(){
		$this->all_save();
	}

}
?>
