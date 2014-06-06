<?php
class ShakedoAction extends BaseAction{
	public function index(){
				
		$data=array();
		$data['phone'] 		= $this->_get('phone');
		$data['token'] 		= $this->_get('token');
		$data['wecha_id'] = $this->_get('wecha_id');
		$ifact=M('Shake')->where(array('token'=>$data['token'],'isopen'=>'1'))->find(); //'isopen'=>array('neq',2)
		if($ifact==false){echo '<script>alert ("商家目前没有进行中的摇一摇活动")</script>'; return;}
		$exst=M('shakedo')->where(array('wecha_id'=>$data['wecha_id']))->select();
		if($exst==false){M('shakedo')->add($data);}
		$this->assign('info',$data);
		$this->assign('ctime',$ifact['clienttime']);
		$this->assign('music',$ifact['pass3']);
		$this->display();
		
	}

    public function repoint(){
		
		$data=array();
		$data['phone'] 		= $this->_post('phone');
		$data['token'] 		= $this->_post('token');
		$data['wecha_id'] = $this->_post('wecha_id');
		$data['point'] = $this->_post('point');
		$where = array('token'=>$data['token'],'isact'=>'1','isopen'=>"1");
		$exst=M('Shake')->where($where)->select();
		if($exst==false){
		echo '1'; return;
		}else{
		$where['wecha_id'] = $data['wecha_id'];
		$where['token'] = $data['token'];
		//看情况加入用户不刷新页面情况下加入游戏
		//$a=M('shakedo')->where($where)->find();
		//if($a!==false)
		$act=M('shakedo')->where($where)->save($data);
		//else
		//$act=M('shakedo')->where($where)->add($data);
		//echo json_encode($data);
		echo '0';
		}
	}
	
	
}
?>