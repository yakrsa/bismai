<?php
class BaseAction extends Action
{
    protected function _initialize()
    {
        define('RES', THEME_PATH . 'common');
        define('STATICS', TMPL_PATH . 'Static');
        $this->assign('action', $this->getActionName());
		import("@.ORG.Input");
    }
    
	protected function _upload($name = '')
	{
		$name = $name ? $name : MODULE_NAME;
		$savePath = './Data/attachments/'.$name.'/';
		if(!is_dir($savePath))
		{
            if(is_dir(base64_decode($savePath)))
			{
                $savePath =	base64_decode($savePath);
            }
			else
			{
                if(!mkdir($savePath))
				{
                    $this->error  =  '上传目录'.$savePath.'不存在';
                    return false;
                }
            }
		}
		import("@.ORG.UploadFile");
		$upload = new UploadFile();
		$upload->maxSize = 3292200;
		$upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
		$upload->savePath = $savePath.date("Ymd",time()).'/';
		$upload->thumb = true;
		$upload->imageClassPath = '@.ORG.Image';
		$upload->thumbPrefix = 'm_';
		$upload->thumbMaxWidth = '720';
		$upload->thumbMaxHeight = '400';
		$upload->saveRule = uniqid;
		$upload->thumbRemoveOrigin = false;
		if (!$upload->upload())
		{
			$this->error($upload->getErrorMsg());
		}
		else
		{
			$uploadList = $upload->getUploadFileInfo();
			return $uploadList;
		}
	}
    
    protected function all_insert($name = '', $back = '/index')
    {
        $name = $name ? $name : MODULE_NAME;
        $db   = D($name);
        if ($db->create() === false) {
            $this->error($db->getError());
        } else {
            $id = $db->add();
            if ($id) {
                $m_arr = array(
                    'Img',
                    'Text',
                    'Voiceresponse',
                    'Ordering',
                    'Lottery',
                    'Host',
					'Product',
					'Selfform',
					'Marrycard',
					'Goldegg',
					'Panoramic',
					'Wreservation'
                );
                if (in_array($name, $m_arr)) {
                    $data['pid']     = $id;
                    $data['module']  = $name;
                    $data['token']   = session('token');
                    $data['keyword'] = $_POST['keyword'];
                    M('Keyword')->add($data);
                }
                $this->success('操作成功', U(MODULE_NAME . $back));
            } else {
                $this->error('操作失败', U(MODULE_NAME . $back));
            }
        }
    }

    protected function insert($name = '', $back = '/index')
    {
        $name = $name ? $name : MODULE_NAME;
        $db   = D($name);
        if ($db->create() === false) {
            $this->error($db->getError());
        } else {
            $id = $db->add();
            if ($id == true) {
                $this->success('操作成功', U(MODULE_NAME . $back));
            } else {
                $this->error('操作失败', U(MODULE_NAME . $back));
            }
        }
    }

    protected function save($name = '', $back = '/index')
    {
        $name = $name ? $name : MODULE_NAME;
        $db   = D($name);
        if ($db->create() === false) {
            $this->error($db->getError());
        } else {
            $id = $db->save();
            if ($id == true) {
                $this->success('操作成功', U(MODULE_NAME . $back));
            } else {
                $this->error('操作失败', U(MODULE_NAME . $back));
            }
        }
    }

    protected function all_save($name = '', $back = '/index')
    {
        $name = $name ? $name : MODULE_NAME;
        $db   = D($name);
        if ($db->create() === false) {
            $this->error($db->getError());
        } else {
            $id = $db->save();
            if ($id) {
                $m_arr = array(
                    'Img',
                    'Text',
                    'Voiceresponse',
                    'Ordering',
                    'Lottery',
                    'Host',
					'Product',
					'Selfform',
					'Marrycard',
					'Goldegg',
					'Panoramic'
                );
                if (in_array($name, $m_arr)) {
                    $data['pid']    = $_POST['id'];
                    $data['module'] = $name;
                    $data['token']  = session('token');
                    $da['keyword']  = $_POST['keyword'];
                    M('Keyword')->where($data)->save($da);
                }
                $this->success('操作成功', U(MODULE_NAME . $back));
            } else {
                $this->error('操作失败', U(MODULE_NAME . $back));
            }
        }
    }
    
    protected function all_del($id, $name = '', $back = '/index')
    {
        $name = $name ? $name : MODULE_NAME;
        $db   = D($name);
        if ($db->delete($id)) {
            $this->ajaxReturn('操作成功', U(MODULE_NAME . $back));
        } else {
            $this->ajaxReturn('操作失败', U(MODULE_NAME . $back));
        }
    }
	
	protected function order_pay($payinfo, $wecha_id, $token, $name = '', $back = '')
	{
		$name = $name ? $name : "Product";
		$back = U($name."/my",array('token'=>$token,'wecha_id'=>$wecha_id));
		$pay_m_alipay_config = M('Pay_m_alipay_config')->where(array('token'=>$token))->find();
		if ($pay_m_alipay_config['open'] != 1){
			$this->error('商家还未配置支付宝！', U($name . $back));
		}
		if (empty($payinfo)) {
			$this->error('订单不能为空', U($name . $back));
		} else {
			$order = M('Product_cart')->where(array('id'=>$payinfo['id']))->find();
			$this->do_order_pay($order);
		}
	}
	
	protected function do_order_pay($order)
	{
		$id                      = $order['id'];
		$order = M('Product_cart')->where(array('id'=>$id))->find();
        $product_cart_list_model = M('product_cart_list')->where(array(
			'cartid' => $id
		))->find();
        $product_model           = M('product')->where(array(
			'id' => $product_cart_list_model['productid']
		))->find();
		$this->redirect(U('Pay_m_alipay/dopay',array('token'=>$order['token'],'wecha_id'=>$order['wecha_id'],'success'=>'','price'=>$order['price'],'ordername'=>$product_model['name'],'order_id'=>$order['id'],'out_trade_no'=>$order['sn'],'productid'=>$product_cart_list_model['productid'])));
	}

	/*
	 *sms_plat
	 *短信接口
	*/
	protected function sendSMS($user, $pass, $phone, $content)
	{
		$sms_plat = file_get_contents('http://api.smsbao.com/sms?u='.$user.'&p='.$pass.'&m='.$phone.'&c='.urlencode($content));
	}
	
	/**
	 * 系统邮件发送函数
	 * @param string $to    接收邮件者邮箱
	 * @param string $name  接收邮件者名称
	 * @param string $subject 邮件主题 
	 * @param string $body    邮件内容
	 * @param string $attachment 附件列表
	 * @return boolean 
	 */
	protected function sendEMAIL($to, $name, $subject = '', $body = '', $attachment = null, $config = array(), $ssl)
	{
		vendor('PHPMailer.class#phpmailer'); //从PHPMailer目录导class.phpmailer.php类文件
		$mail             = new PHPMailer(); //PHPMailer对象
		$mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
		$mail->IsSMTP();  // 设定使用SMTP服务
		$mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
												   // 1 = errors and messages
												   // 2 = messages only
		$mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
		if ($ssl) {
			$mail->SMTPSecure = 'ssl';                    // 使用安全协议
		} else {
			$mail->SMTPSecure = '';                       // 不使用安全协议
		}
		$mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
		$mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
		$mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
		$mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
		$mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
		$replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
		$replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
		$mail->AddReplyTo($replyEmail, $replyName);
		$mail->Subject    = $subject;
		$mail->MsgHTML($body);
		$mail->AddAddress($to, $name);
		if(is_array($attachment)){ // 添加附件
			foreach ($attachment as $file){
				is_file($file) && $mail->AddAttachment($file);
			}
		}
		return $mail->Send() ? true : $mail->ErrorInfo;
	}
}
?>