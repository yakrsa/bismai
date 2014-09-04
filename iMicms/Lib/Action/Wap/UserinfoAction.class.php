<?php
class UserinfoAction extends BaseAction{
	public function index(){
		$agent = $_SERVER['HTTP_USER_AGENT'];
//		if(!strpos($agent,"MicroMessenger")) {
//			echo '此功能只能在微信浏览器中使用';exit;
//		}
Log::write("++++++++++++++ begin:");
		$card = D('Member_card_create'); 
		$data['wecha_id']=$this->_get('wecha_id');
		$data['token']=$this->_get('token');
		$cardinfo=$card->where($data)->find(); //是否领取过

		$sql=D('Userinfo');
		$userinfo=$sql->where($data)->find();
		$member=M('Member')->where(array('token'=>$data['token']))->find();
		if($memboer['hoempic']!=false){
			$img=$member['homepic'];			
		}else{
			$img='tpl/Wap/default/common/images/userinfo/fans.jpg';
		}
		$this->assign('cardnum',$cardinfo['number']);
		$this->assign('homepic',$img);
		$this->assign('info',$userinfo);
		$this->assign('cardid',$this->_get('cardid'));
		if(IS_POST){
			
			//如果有post提交，说明是修改
			$data['wechaname'] = $this->_post('wechaname');
			$data['tel']       = $this->_post('tel');
			if(empty($data['wechaname']) || empty($data['tel'])){
				$this->error("微信号或手机号必填。");exit;
			}

			$data['truename']  = $this->_post('truename');			
			$data['qq']  = $this->_post('qq');
			$data['sex'] = $this->_post('sex');
			$data['age'] = $this->_post('age');
 			//如果会员卡不为空[更新]
 			//写入两个表 Userinfo Member_card_create 
			if($cardinfo){ //如果Member_card_create 不为空，说明领过卡，但是可以修改会员信息
				//如果当前cardid和之前的不同，则代表申请第二张卡，需要换掉原来的卡,要申请新卡id
				if($cardinfo['cardid']!=$this->_post('cardid')){
					Log::write("当前cardid和之前的不同".$this->_post('cardid'));
					//申请新卡id
					$newcard=M('Member_card_create')->field('id,number')->where("token='".$this->_get('token')."' and wecha_id ='' and cardid=".$this->_post('cardid'))->order('id')->find();
					if($newcard != false){
						 Log::write("new card no:".$newcard['id']);
						$card->where("id=".$newcard['id'])->delete();
						$cardinfo['cardid']=$this->_post('cardid');
						$cardinfo['number']=$newcard['number'];
						$card->data($cardinfo)->save();	
              	 	                 	$update['wecha_id']=$data['wecha_id'];
           	  	              	        $update['token']=$data['token'];
   	                 	           	unset($data['wecha_id']);
	                        	       	unset($data['token']);
	                       	        	if(M('Userinfo')->where($update)->save($data)){
	                              	        	 echo 4;exit;
	                                	}else{
	                                        	echo 4;exit;
	 	                               	}
					}else{
						echo 3;exit;
						
					}
				}else{
					$update['wecha_id']=$data['wecha_id'];
					$update['token']=$data['token'];
					unset($data['wecha_id']);
					unset($data['token']);
					if(M('Userinfo')->where($update)->save($data)){
						echo 1;exit;
					}else{
						echo 0;exit;
					}
				}
			}else{
				//还没有会员卡，领卡
				$card=M('Member_card_create')->field('id,number')->where("token='".$this->_get('token')."' and wecha_id = '' and cardid=".$this->_post('cardid'))->order('id')->find();
				//如果商家还有会员卡，可以领
					if($card != false){
						//微信与会员卡绑定
						$card_up=M('Member_card_create')->where(array('id'=>$card['id']))->save(array('number'=>$card['number'],'wecha_id'=>$data['wecha_id']));
						//写入会员卡信息
						$data['token'] = $this->_get('token');
						$data['getcardtime'] = time();
						M('Userinfo')->data($data)->add();
						echo 2;exit;
					}else{
						//商家没有了会员卡
						$token=M('wxuser')->field('uid')->where(array('token'=>$this->_get('token')))->find();
						
					//	M('Users')->where(array('id'=>$token['uid']))->setField(array('card_create_status'=>0));//?????
						echo 3;exit;
					}				 
			} //post 





		} 

		$this->display();	
		 /*
		$member=M('Member')->where(array('token'=>$data['token']))->find();
		if($memboer['hoempic']!=false){
			$img=$member['homepic'];			
		}else{
			$img='tpl/Wap/default/common/images/userinfo/fans.jpg';
		}
		$this->assign('homepic',$img);
		$this->assign('info',$info);
		if(IS_POST){
			$data['wechaname'] = $this->_post('wechaname');
			$data['tel']       = $this->_post('tel');
			if(empty($data['wechaname']) || empty($data['tel'])){
				$this->error("微信号或手机号必填。");exit;
			}

			$data['truename']  = $this->_post('truename');			
			$data['qq']=$this->_post('qq');
			$data['sex']=$this->_post('sex');
			$data['age']=$this->_post('age');
 			//如果会员卡不为空[更新]
			if($info){
				$update['wecha_id']=$data['wecha_id'];
				$update['token']=$data['token'];
				unset($data['wecha_id']);
				unset($data['token']);
				if($sql->where($update)->save($data)){
					echo 1;
				}else{
					echo 0;
				}
			}else{
				//还没有会员卡，领卡
				$card=M('Member_card_create')->field('id,number')->where("token='".$this->_get('token')."' and wecha_id = ' '")->find();
				//如果商家还有会员卡，可以领
					if($card!=false){
						//微信与会员卡绑定
						$card_up=M('Member_card_create')->where(array('id'=>$card['id']))->save(array('number'=>$card['number'],'wecha_id'=>$data['wecha_id']));
						echo 2;exit;
					}else{
						//商家没有了会员卡
						$token=M('wxuser')->field('uid')->where(array('token'=>$data['wecha_id']))->find();
						M('User')->where(array('id'=>$token['uid']))->setField(array('card_create_status'=>0));
						echo 3;exit;
					}
				if($sql->add($data)){
					//查询会员卡
					
				}else{
					echo 0;
				}
			
			}
	}else{		
		$this->display();		
	}
	*/
Log::write("+++++++++++++++++++++end");
    } //end function index
} // end class UserinfoAction

?>
