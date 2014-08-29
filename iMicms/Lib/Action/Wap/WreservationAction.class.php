<?php
class WreservationAction extends BaseAction{
	public function _initialize(){
		parent::_initialize();
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if(!strpos($agent,"MicroMessenger")) {
		//FIXME
		//  echo '此功能只能在微信浏览器中使用';exit;
		}
	}

	public function index(){
		$token = $this->_get('token','trim');
		$wecha_id = $this->_get('wecha_id','trim');

		$id=$this->_get('id','trim');
		if($token==false || $id==false){
			echo '活动不存在';exit;
		}
		$where['token']=$token;
		$tpl = D('Wxuser')->where($where)->find();
		$info=M('Wreservation')->where(array('token'=>$token,'id'=>$id))->find();
		if(!$info){
			echo '活动不存在';exit;
		}
		M('Wreservation')->where(array('token'=>$token,'id'=>$id))->setInc('click');

		$sum = M('wreservation_list')->where(array("wid"=>$id))->sum('num');

		$lastnum = -1;
		if($info["maxpeople"]>0 && $info["maxpeople"]>=$sum){
			$lastnum = (int)($info["maxpeople"] - $sum);
		}
		// $this->assign('Wreservation',$Wreservation_list);

		$deadline = strtotime($info['deadline']);
		$isdeadline = (time()-$deadline)>0?1:0;//1:已到期 0:未到期
		if($deadline || $info['maxpeople']){
			$info['limit'] = ture;
		}
		$deadlineStr = null;
		if($deadline){
			$deadlineStr = date('Y年m月d日', $deadline);
		}
		if(!($info['maxpeople']>0)){
			$info['maxpeople'] = null;
		}

		$this->assign('deadlineStr',$deadlineStr);
		if($deadline)
			$this->assign('isdeadline',$isdeadline);
		$this->assign('lastnum',$lastnum);
		$this->assign('wecha_id',$wecha_id);
		$this->assign('token',$token);

		$this->info = $info;
		$this->tpl = $tpl;

		$player = M('wreservation_list')->where(array("wid"=>$id, "wechatid"=>$wecha_id))->find();
		if($player){
			$this->assign('player',$player);
			$this->display("index1_info");
		}
		else{
			$this->display("index1");
		}
	}

	public function join(){
		if(IS_POST){
			$data['wechatid'] = $this->_post('wecha_id','trim',"");
			$data['token'] = $this->_post('token','trim',"");
			$data['wid'] = (int)$this->_post('wid','trim',"-1");
			$data['truename'] = $this->_post('truename','trim',"");
			$data['phone'] = $this->_post('phone','trim',"");
			$data['num'] = (int)$this->_post('num','trim',"1");
			$data['remark'] = $this->_post('info','htmlspecialchars',"");

			$rsarr=array('errno'=>1,'msg'=>'服务器忙，请稍候再试！','token'=>$data['token'],'wecha_id'=>$data['wechatid']);

			if($data['wechatid']){
				$follower = D("wechat_group_list")->where(array('openid'=>$data['wechatid']))->find();
				if(!$follower){
					$rsarr['errno'] = 1;
					$rsarr['msg'] = "你还未加我的关注哟！";
					echo json_encode($rsarr);
					exit();
				}
			}
			else{
				$rsarr['errno'] = 1;
				$rsarr['msg'] = "必须从我发给你的图文点进来我才知道你是谁哟！";
				echo json_encode($rsarr);
				exit();
			}

			$wreservation=M('Wreservation')->where(array('id'=>$data['wid']))->find();
			if(!$wreservation){
				$rsarr['errno'] = 1;
				$rsarr['msg'] = "活动不存在";
				echo json_encode($rsarr);
				exit();
			}
			else{
				if($wreservation["status"]!=0){
					$rsarr['errno'] = 1;
					$rsarr['msg'] = "活动已停止";
					echo json_encode($rsarr);
					exit();
				}
			}

			if($data['wechatid']==""||$data['wid']==-1||$data['truename']==""||$data['phone']==""){
				$rsarr['errno'] = 1;
				$rsarr['msg'] = "缺少必要信息";
				echo json_encode($rsarr);
				exit();
			}

			$redata = M('wreservation_list')->where(array("wechatid"=>$data['wechatid'], "wid"=>$data['wid']))->find();
			if($redata){
				$rsarr['errno'] = 1;
				$rsarr['msg'] = "你已经参加过了";
				echo json_encode($rsarr);
				exit();
			}

			// if($wreservation['2014-08-28'])
			if($wreservation['maxpeople']>0){
				$sum = M('wreservation_list')->where(array("wid"=>$data['wid']))->sum('num');
				if($sum+$data['num']>$wreservation['maxpeople']){
					$rsarr['errno'] = 1;
					$rsarr['msg'] = "参加人数已满！";
					echo json_encode($rsarr);
					exit();
				}
			}


			$data['create_time'] = time();
			$addrs = M('wreservation_list')->data($data)->add();
			$rsarr['errno'] = 0;
			$rsarr['msg'] = "谢谢您的参与！";
			echo json_encode($rsarr);
			exit();

			echo json_encode($rsarr);
		}
	}


	public function quit(){
		if(IS_POST){
			$data['wechatid'] = $this->_post('wecha_id','trim',"");
			$data['token'] = $this->_post('token','trim',"");
			$data['wid'] = (int)$this->_post('wid','trim',"-1");

			$rsarr=array('errno'=>1,'msg'=>'服务器忙，请稍候再试！','token'=>$data['token'],'wecha_id'=>$data['wechatid']);

			if(!$data['wechatid']){
				$rsarr['errno'] = 1;
				$rsarr['msg'] = "必须从我发给你的图文点进来我才知道你是谁哟！";
				echo json_encode($rsarr);
				exit();
			}

			$wreservation=M('Wreservation')->where(array('id'=>$data['wid']))->find();
			if(!$wreservation){
				$rsarr['errno'] = 1;
				$rsarr['msg'] = "活动不存在";
				echo json_encode($rsarr);
				exit();
			}

			if($data['wechatid']==""||$data['wid']==-1){
				$rsarr['errno'] = 1;
				$rsarr['msg'] = "缺少必要信息";
				echo json_encode($rsarr);
				exit();
			}

			$where["wid"] = $data["wid"];
			$where["wechatid"] = $data["wechatid"];
			M('wreservation_list')->where($where)->delete();
			$rsarr['errno'] = 0;
			$rsarr['msg'] = "你已成功退出活动";

			echo json_encode($rsarr);
		}

	}

}
?>