<?php
class AlipayAction extends UserAction{
	public function index(){
		if (C('agent_version')){
			$group=M('User_group')->field('id,name,price')->where('price>0 AND agentid='.$this->agentid)->select();
		}else {
			$group=M('User_group')->field('id,name,price')->where('price>0')->select();
		}
		$user=M('User_group')->field('price')->where(array('id'=>session('gid')))->find();
		$this->assign('group',$group);
		$this->assign('user',$user);
		$this->display();
	}
	public function redirectPost(){
		if($this->_post('price')==false||$this->_post('uname')==false)$this->error('价格和用户名必须填写');
		//price ,uname,uid,groupid,num 月
		$url=str_replace('.cn','.com',C('site_url'));
		header('Location:'.$url.'/index.php?g=User&m=Alipay&a=post&price='.$this->_post('price').'&uname='.$this->_post('uname').'&uid='.session('uid').'&groupid='.$this->_post('group').'&num='.$this->_post('num'));
	}
	public function post(){
		if($this->_post('price')==false||$this->_post('uname')==false)$this->error('价格和用户名必须填写');
		if($this->_post('payment')==0){
			import("@.ORG.Alipay.AlipaySubmit");
			//支付类型
			$payment_type = "1";
			//必填，不能修改
			//服务器异步通知页面路径
			$notify_url = C('site_url').U('User/Alipay/notify');
			//需http://格式的完整路径，不能加?id=123这类自定义参数
			//页面跳转同步通知页面路径
			$return_url = C('site_url').U('User/Alipay/return_url');
			//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
			//卖家支付宝帐户
			$seller_email = trim(C('alipay_name'));
			//商户订单号
			$out_trade_no = session('uname').time();
			//商户网站订单系统中唯一订单号，必填
			//订单名称
			$subject ='充值vip'.$this->_post('group').'会员'.$this->_post('num').'个月';
			//必填
			//付款金额
			$total_fee =(int)$_POST['price'];
			//必填
			//商品数量
			$quantity = "1";
			$logistics_fee = "0.00";
			//必填，即运费
			//物流类型
			$logistics_type = "EXPRESS";
			//必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
			//物流支付方式
			$logistics_payment = "SELLER_PAY";
			//必填，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
			//订单描述
			$body = $subject;
			$data=M('Indent')->data(
					array('uid'=>session('uid'),'title'=>$subject,'uname'=>$this->_post('uname'),'gid'=>$this->_post('gid'),'create_time'=>time(),'indent_id'=>$out_trade_no,'price'=>$total_fee))->add();
			$show_url = rtrim(C('site_url'),'/');
			//构造要请求的参数数组，无需改动
			$parameter = array(
					"service" => "create_partner_trade_by_buyer",
					"partner" =>trim(C('alipay_pid')),
					"payment_type"	=> $payment_type,
					"notify_url"	=> $notify_url,
					"return_url"	=> $return_url,
					"seller_email"	=> $seller_email,
					"out_trade_no"	=> $out_trade_no,
					"subject"	=> $subject,
					"price"	=> $total_fee,
					"quantity"	=> $quantity,
					"logistics_fee"	=> $logistics_fee,
					"logistics_type"	=> $logistics_type,
					"logistics_payment"	=> $logistics_payment,
					"body"	=> $body,
					"show_url"	=> $show_url,
					"_input_charset"	=> trim(strtolower(strtolower('utf-8')))
			);
			//建立请求
			$alipaySubmit = new AlipaySubmit($this->setconfig());
			$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
			echo $html_text;

		}else{
			import("@.ORG.Tenpay.tenpay");
						/* 获取提交的订单号 */
			$tenpay_config['out_trade_no']=session('uname').time();
			/* 获取提交的备注信息 */
			$tenpay_config['remarkexplain']=$tenpay_config['product_name'];
			/* 商品价格（包含运费），以分为单位 */
			$tenpay_config['total_fee']=(int)$_POST['price']*100;
			//$tenpay_config['total_fee']=(int)$_POST['price'];
			/* 商品名称 */
			$tenpay_config['desc']='充值vip'.$this->_post('group').'会员'.$this->_post('num').'个月';

			$tenpay_config['return_url']=C('site_url').U('User/Alipay/tenpay_return_url');
			
			$tenpay_config['notify_url']=C('site_url').U('User/Alipay/tenpay_notify');
			
			$tenpay_config['partner']=C('partner');
			
			$tenpay_config['tenpay_name']=C('tenpay_name');
			
			$tenpay_config['key']=c('key');
			
			$data=M('Indent')->data(
					array('uid'=>session('uid'),'title'=>$tenpay_config['desc'],'uname'=>$this->_post('uname'),'gid'=>$this->_post('gid'),'create_time'=>time(),'indent_id'=>$tenpay_config['out_trade_no'],'price'=>(int)$_POST['price']))->add();
				
			//建立请求
			$tenpaySubmit=new TenpaySubmit($tenpay_config);
			$html_text = $tenpaySubmit->buildRequestForm("post", "确认");
			echo $html_text;
		}
	}
	public function tenpay_return_url(){
		import("@.ORG.Tenpay.payReturnUrl");
		$payreturnurl=new payReturnUrl();
		$result=$payreturnurl->getresult();
		if($result!=null){
			if($result['trade_state'] == '0') {
				$indent=M('Indent')->field('id,price')->where(array('index_id'=>$result['out_trade_no']))->find();
				if($indent!==false){
					//$back=M('Users')->where(array('id'=>$indent['uid']))->setInc('money',$indent['price']);
					$back=M('Indent')->where(array('id'=>$indent['id']))->setField('status',1);
					if($back!=false){
						$this->success('充值成功',U('Home/Index/index'));
					}else{
						$this->error('充值失败,请在线客服,为您处理',U('Home/Index/index'));
					}
				}else{
					$this->error('订单不存在',U('Home/Index/index'));
     			}
			}else {
				$this->error('充值失败 ,请在线客服,为您处理',U('Home/Index/index'));
			}
		}else{
			$this->error('充值失败 ,请在线客服,为您处理',U('Home/Index/index'));
		}
	}
	public function tenpay_notify(){
		import("@.ORG.Tenpay.payNotifyUrl");
		$paynotifyurl=new payNotifyUrl();
		$tenpay_config['partner']=C('partner');
		$tenpay_config['tenpay_name']=C('tenpay_name');
		$tenpay_config['key']=c('key');
		$result=$paynotifyurl->getresult($tenpay_config);
		if($result!=null){
			if($result['trade_state'] == '0') {
				$indent=M('Indent')->field('id,price')->where(array('index_id'=>$result['out_trade_no']))->find();
				if($indent!==false){
					//$back=M('Users')->where(array('id'=>$indent['uid']))->setInc('money',$indent['price']);
					$back=M('Indent')->where(array('id'=>$indent['id']))->setField('status',1);
					if($back!=false){
						$this->success('充值成功',U('Home/Index/index'));
					}else{
						$this->error('充值失败,请在线客服,为您处理',U('Home/Index/index'));
					}
				}else{
					$this->error('订单不存在',U('Home/Index/index'));
				}
			}else {
				$this->error('充值失败 ,请在线客服,为您处理',U('Home/Index/index'));
			}
		}else{
			$this->error('充值失败 ,请在线客服,为您处理',U('Home/Index/index'));
		}
		
	}
	public function setconfig(){
		$alipay_config['partner']		= trim(C('alipay_pid'));
		//安全检验码，以数字和字母组成的32位字符
		$alipay_config['key']			= trim(C('alipay_key'));
		//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
		//签名方式 不需修改
		$alipay_config['sign_type']    = strtoupper('MD5');
		//字符编码格式 目前支持 gbk 或 utf-8
		$alipay_config['input_charset']= strtolower('utf-8');
		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		$alipay_config['cacert']    = getcwd().'\\PigCms\\Lib\\ORG\\Alipay\\cacert.pem';
		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$alipay_config['transport']    = 'http';		
		return $alipay_config;
	}
	public function add(){
		$this->index();
	}
	//同步数据处理
	public function return_url (){
		import("@.ORG.Alipay.AlipayNotify");
		$alipayNotify = new AlipayNotify($this->setconfig());
		$verify_result = $alipayNotify->verifyReturn();	
		if($verify_result) {
			$out_trade_no = $this->_get('out_trade_no');
			//支付宝交易号
			$trade_no =  $this->_get('trade_no');
			//交易状态
			$trade_status =  $this->_get('trade_status');
			if( $this->_get('trade_status') == 'TRADE_FINISHED' ||  $this->_get('trade_status') == 'TRADE_SUCCESS') {
				$indent=M('Indent')->where(array('indent_id'=>$out_trade_no))->find();
				if($indent!=false){
					if($indent['status']==1){$this->error('该订单已经处理过,请勿重复操作');}
					M('Users')->where(array('id'=>$indent['uid']))->setInc('money',intval($indent['price']));
					M('Users')->where(array('id'=>$indent['uid']))->setInc('moneybalance',intval($indent['price']));
					$back=M('Indent')->where(array('id'=>$indent['id']))->setField('status',1);
					if($back!=false){
						$month=intval($indent['month']);
						//检查费用
						$groupid=intval($indent['gid']);
						$thisGroup=M('User_group')->where(array('id'=>$groupid))->find();
						$needFee=intval($thisGroup['price'])*$month;
						$moneyBalance=$this->user['moneybalance']+$indent['price'];
						if ($needFee<$moneyBalance){
							//
							$users_db=D('Users');
							$users_db->where(array('id'=>$indent['uid']))->save(array('viptime'=>$this->user['viptime']+$month*30*24*3600,'status'=>1,'gid'=>$indent['gid']));
							//
							$gid=$indent['gid']+1;
							$functions=M('Function')->where('gid<'.$gid)->select();
							$str='';
							if ($functions){
								$comma='';
								foreach ($functions as $f){
									$str.=$comma.$f['funname'];
									$comma=',';
								}
							}
							//
							$token_open_db=M('Token_open');
							$wxusers=M('Wxuser')->where(array('uid'=>$indent['uid']))->select();
							if ($wxusers){
								foreach ($wxusers as $wxu){
									$token_open_db->where(array('token'=>$wxu['token']))->save(array('queryname'=>$str));
								}
							}
							//
							$spend=0-$needFee;
							M('Indent')->data(array('uid'=>session('uid'),'month'=>$month,'title'=>'购买服务','uname'=>$this->user['username'],'gid'=>$groupid,'create_time'=>time(),'indent_id'=>$indent['id'],'price'=>$spend,'status'=>1))->add();
							M('Users')->where(array('id'=>$indent['uid']))->setDec('moneybalance',intval($needFee));
							//
							$this->success('充值成功并购买成功',U('User/Index/index'));
						}else{
							$this->success('充值成功但您的余额不足',U('User/Index/index'));
						}
					}else{
						$this->error('充值失败,请在线客服,为您处理',U('User/Index/index'));
					}
				}else{
					$this->error('订单不存在',U('User/Index/index'));

				}
			}else {
			  $this->error('充值失败，请联系官方客户');
			}
		}else {
			$this->error('不存在的订单');
		}
	}
	public function notify(){
		import("@.ORG.Alipay.alipay_notify");
		$alipayNotify = new AlipayNotify($this->setconfig());
		$html_text = $alipaySubmit->buildRequestHttp($parameter);
				
	}
	
}



?>