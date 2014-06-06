<?php
class WcardAction extends BaseAction{
        private $banner;	//微喜帖
        public function _initialize(){
		parent::_initialize();
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		//MicroMessenger
		if(!strpos($agent,"Mobile")) {
			//  echo '此功能只能在微信、易信浏览器中使用';exit;
		}
		// $datas['id']         = session('wxid');  
		 
        }
	public function webzf(){
		$redata	  = M('Wcard_zf');
		$wecha_id = $this->_post('wecha_id'); 
	    $token    = $this->_post('token'); 
		$id       = $this->_post('id'); 
		$type     = $this->_post('type');
		$where	  = array('token'=>$token,'wecha_id'=>$wecha_id,'pid'=>$id,'flag'=>$type);
		$record   = $redata->where($where)->find();
		//if($record == Null){
		    $where['userName']        =  $this->_post('userName');
			$where['telephone']       =  $this->_post('telephone');
			$where['count']           =  $this->_post('count');
			$where['create_time']     =  time();
			$where['flag']            =  $this->_post('type');
			
			
	
			$redata->add($where);
			
			
			 
		//}
        echo "感谢您的参与!";
	}
	public function index(){
		
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		$info=M('Wcard')->where(array('token'=>$token,'id'=>$this->_get('id')))->find();
		$list=M('Wcard')->where(array('token'=>$token,'id'=>$this->_get('id')))->setInc('click');
		$wcard_list=M('Wcard_list')->where(array('token'=>$token,'pid'=>$this->_get('id')))->limit(10)->select();
		//dump($wcard);
		 
		$this->assign('info',$info);
		$this->assign('gtoken',$token);
		$this->assign('wecha_id',$this->_get('wecha_id')); 
		$this->assign('Wcard',$wcard_list);
		$this->display();
		
	
	}
	
	public function webmd(){
		$type  = $this->_get('type');
		$token = $this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		$info=M('Wcard')->where(array('token'=>$token,'id'=>$this->_get('id')))->find();
		$wcard_list=M('Wcard_zf')->where(array('token'=>$token,'pid'=>$this->_get('id'),'flag'=>$type))->select();
		//dump($wcard);
		 
		$this->assign('info',$info);
		$this->assign('type',$type);
		$this->assign('gtoken',$token);
		
		 
		
		if(IS_POST)
		{
		$pid        = $this->_post('id');
		$pswd       = $this->_post('pswd');
		$password   = $this->_post('pwd');
		$token      = $this->_post('token');
		$type       = $this->_post('type');
		if($password == $pswd){
		   $info=M('Wcard')->where(array('token'=>$token,'id'=>$pid))->find();
		   $wcard_list = M('Wcard_zf')->where(array('token'=>$token,'pid'=>$pid,'flag'=>$type))->select();
		   $this->assign('Wcard',$wcard_list);
		   $this->assign('info',$info);
		   
		   if($type ==1) $this->display('mdlist');
		   if($type ==2) $this->display('zflist');
		   }
		   else
		   {
		   $this->assign('passerror',1);
		   $this->display('webzfmd');
		   }
		}
		else 
		{
		
		$this->display('webzfmd');
		
		}
	
	}
}
?>