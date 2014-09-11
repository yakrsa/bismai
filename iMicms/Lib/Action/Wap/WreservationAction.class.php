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
		$from = $this->_get('from','trim');

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
		if(($deadline && $deadline>0) || $info['maxpeople']){
			$info['limit'] = ture;
		}
		$deadlineStr = null;
		if($deadline && $deadline>0){
			$deadlineStr = date('Y年m月d日', $deadline);
		}
		if(!($info['maxpeople']>0)){
			$info['maxpeople'] = null;
		}

		$this->assign('deadlineStr',$deadlineStr);
		if($deadline && $deadline>0)
			$this->assign('isdeadline',$isdeadline);
		$this->assign('lastnum',$lastnum);
		$this->assign('wecha_id',$wecha_id);
		$this->assign('token',$token);

		$this->info = $info;
		$this->tpl = $tpl;

		$this->assign('from',$from);
		if($from && $from == "event"){
			$player = M('wreservation_list')->where(array("wid"=>$id, "wechatid"=>$wecha_id))->find();
			if($player){
				$this->assign('player',$player);
				// $this->display("index1_info");
			}
		}
		$this->display("index1");

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
				// $follower = D("wechat_group_list")->where(array('openid'=>$data['wechatid'],'token'=>$data['token']))->find();
				// if(!$follower){
				// 	$rsarr['errno'] = 1;
				// 	$rsarr['msg'] = "你还未加我的关注哟！";
				// 	echo json_encode($rsarr);
				// 	exit();
				// }

		        $where = array('token'=>$data['token']);
		        $wxUser = M('Wxuser')->where($where)->find();
		        $access_token = $this->get_access_token($wxUser);
				$url = 'https://api.weixin.qq.com/cgi-bin/user/info?openid='.$data['wechatid'].'&access_token='.$access_token;
				$classData = json_decode($this->curlGet($url));
            	if($classData->errcode){
			        $access_token = $this->get_access_token($wxUser, false);
					$url = 'https://api.weixin.qq.com/cgi-bin/user/info?openid='.$data['wechatid'].'&access_token='.$access_token;
					$classData = json_decode($this->curlGet($url));
            	}

				if ($classData->subscribe == 1){
				    $data['nickname'] = str_replace("'", '', $classData->nickname);
				    $data['sex'] = $classData->sex;
				    $data['city'] = $classData->city;
				    $data['province'] = $classData->province;
				    $data['headimgurl'] = $classData->headimgurl;
				    $data['subscribe_time'] = $classData->subscribe_time;
				}
				else{
					$rsarr['errno'] = 1;
					$rsarr['msg'] = "你还未加我的关注哟！";
					echo json_encode($rsarr);
					exit();
				}
			}
			else{
				$rsarr['errno'] = 1;
				$rsarr['msg'] = "只有从我发给你的图文点进来才能报名哟！";
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

			if($wreservation['maxpeople']>0){
				$sum = M('wreservation_list')->where(array("wid"=>$data['wid']))->sum('num');
				if($sum+$data['num']>$wreservation['maxpeople']){
					$rsarr['errno'] = 1;
					$rsarr['msg'] = "参加人数已满！";
					echo json_encode($rsarr);
					exit();
				}
			}

			if($wreservation['maxpeople']>0){
				$sum = M('wreservation_list')->where(array("wid"=>$data['wid']))->sum('num');
				if($sum+$data['num']>$wreservation['maxpeople']){
					$rsarr['errno'] = 1;
					$rsarr['msg'] = "参加人数已满！";
					echo json_encode($rsarr);
					exit();
				}
			}

			$isdeadline = -1;
			$deadline = strtotime($wreservation['deadline']);
			if($deadline && $deadline>0){
				$isdeadline = (time()-$deadline)>0?1:0;//1:已到期 0:未到期
			}
			if($isdeadline==1){
				$rsarr['errno'] = 1;
				$rsarr['msg'] = "参加期限已到！";
				echo json_encode($rsarr);
				exit();
			}

			$data['create_time'] = time();
			$addrs = M('wreservation_list')->data($data)->add();
			$rsarr['errno'] = 0;
			$rsarr['msg'] = "谢谢您的参与！";
			echo json_encode($rsarr);
			exit();
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

    /* 140909 */
    function get_access_token($wxUser, $isCache=true){
        $wxid = $wxUser['wxid'];
        $access_token = cache($wxid.'weixin_access_token');
        if($access_token && $isCache) {
            return $access_token;
        }
        else {
            $url_get = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$wxUser['appid'].'&secret='.$wxUser['appsecret'];
            $ch1 = curl_init();
            $timeout = 5;
            curl_setopt($ch1, CURLOPT_URL, $url_get);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
            $accesstxt = curl_exec($ch1);
            curl_close ($ch1);

            $access = json_decode($accesstxt, true);
            if (!$access->errmsg){
                cache($wxid.'weixin_access_token', $access['access_token'], $access['expires_in']);
                return $access['access_token'];
            }else{
            	return false;
            }
        }
    }
    function curlGet($url){
        $ch = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $temp = curl_exec($ch);
        return $temp;
    }

}
?>