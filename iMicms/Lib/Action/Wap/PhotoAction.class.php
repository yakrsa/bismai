<?php
class PhotoAction extends BaseAction{
        private $banner;	//微相册
        public function _initialize(){
		parent::_initialize();
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		//MicroMessenger
		if(!strpos($agent,"Mobile")) {
			//  echo '此功能只能在微信、易信浏览器中使用';exit;
		}
		$datas['id']         = session('wxid');  
		$phead = M('Users')->field('photo_head')->where($datas)->find();
		if(!$phead['photo_head'])  $phead['photo_head'] = C('site_url')."/tpl/static/images/albums_head_url.jpg";
		$this->banner = $phead['photo_head'];
        }
	public function index(){
		 
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		$photo=M('Photo')->where(array('token'=>$token,'status'=>1))->order('id desc')->select();
		if($photo==false){ }
		
		$this->assign('banner',$this->banner);
		$this->assign('photo',$photo);
		$this->display();
	}
	public function plist(){
		
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		$info=M('Photo')->field('title')->where(array('token'=>$token,'id'=>$this->_get('id')))->find();
		$photo_list=M('Photo_list')->where(array('token'=>$token,'pid'=>$this->_get('id'),'status'=>1))->select();
		//dump($photo);
		$this->assign('banner',$this->banner);
		$this->assign('info',$info);
		$this->assign('photo',$photo_list);
		$this->display();
		
	
	}
}
?>