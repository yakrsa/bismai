<?php
class UsersAction extends BaseAction{
	public function index(){
		header("Location: /");
	}

	public function checklogin(){
		$db=D('Users');
		$username=$this->_post('username');

		$where['username']=$this->_post('username');
		
		// if($db->create()==false)
		// $this->error($db->getError());
		$pwd=$this->_post('password','trim,md5');
		$res=$db->where($where)->find();
		if($pwd===$res['password']){
	       	#	if($res['status']==0){
		#		echo 3;
		#		$this->error('请联系在线客户，为你人工审核帐号');
		#		exit;
		#	}

			session('uid',$res['id']);
			session('gid',$res['gid']);
			session('uname',$res['username']);
			$info=M('user_group')->find($res['gid']);
			session('diynum',$res['diynum']);
			session('connectnum',$res['connectnum']);
			session('activitynum',$res['activitynum']);
			session('gongzhongnum',$res['gongzhongnum']);
			session('viptime',$res['viptime']);
			session('gname',$info['name']);
			$tt=getdate();
                        $data['id']=$res['id'];
			$data['lasttime']=date("Y-m-d H:i:s",time());
			if($tt['mday']===1){
				$data['id']=$res['id'];
				$data['imgcount']=0;
				$data['textcount']=0;
				$data['musiccount']=0;
				$data['activitynum']=0;
				$data['gongzhongnum']=0;
			}
			#$db->data($data);
			$db->save($data);
                        $this->success('登录成功',U('Index/index'));
			#$this->success($res['id']);
			 
			echo 1;
		}else{
				echo 2;
				#$this->ajaxReturn($username.$res['id'] . $res['username'],U('Index/login'),0);
		}
	}
	
	
	public function checkreg(){
	         $db=D('Users');
	         $vcode              =$this->_post('captcha','intval,md5',0);
		 $ewhere['email']    =$this->_post('email','trim');
		 $uwhere['username'] =$this->_post('username','trim');
		 $uinfo=$db->where($uwhere)->find();	
		  if($uinfo == true) {echo 7; exit;}
		 
		   $einfo=$db->where($ewhere)->find();
		 if($einfo == true) {echo 6; exit;}
		 if($vcode != $_SESSION['verify']){
		 	echo 5; exit;
		 }
		$authwhere['code']=$this->_post('authcode','trim');
		$authwhere['status']=0;
		$authcodeDB=D('Authcode');
		$authcode=$authcodeDB->where($authwhere)->find();
		if($authcode == false){echo 8; exit;}

		$usergroupDB=D('User_group');
		$ugwhere['id'] = $authcode['level'];
		$info=$usergroupDB->where($ugwhere)->find();
		$gid = $info['id'];
		$viptime= time()+30*$info['expdate']*86400;
		
		$user['username']=$this->_post('username','trim');
		$user['email']=$this->_post('email','trim');
		$user['gid']=$gid;
		$user['viptime']=$viptime;
		$user['password']=md5($this->_post('password'));
		$user['createip']=$_SERVER['REMOTE_ADDR'];
		$user['lastip']=$_SERVER['REMOTE_ADDR'];
		$user['authcode']=$this->_post('authcode','trim');
		$user['createtime']=date("Y-m-d H:i:s",time());
		$user['lasttime']=date("Y-m-d H:i:s",time());
		$user['status']=1;
		$user['city']=$this->_post('city','trim');
		$user['province']=$this->_post('province','trim');
		$user['qq']=$this->_post('qq','trim');
		$user['tusername']=$this->_post('tusername','trim');
		$user['mobile']=$this->_post('mobile','trim');
		$user['areaid']=$this->_post('areaid','trim');
		$db->data($user);
		
			$id=$db->add();
			if($id){				
			#	if(!C('ischeckuser')){
			#		 echo 4; exit;
			#			}
			#	$gid = $info['id'];
			#	$viptime=date('Y-m-d',strtotime('+ '+$info['expdate'] +' month'));
				session('uid',$id);
				session('gid',$gid);
				session('uname',$_POST['username']);
				session('diynum',0);
				session('connectnum',0);
				session('activitynum',0);
				session('gongzhongnum',0);
				session('gname',$info.name);
				
		#update authcode status=0
				$data['id']=$authcode['id'];
				$data['status']=1;
				$data['usetime']=date("Y-m-d H:i:s",time());
				$usedauthcode=M(Authcode);
				$usedauthcode->data($data);
				$usedauthcode->save();

			        echo 1; exit;	
				 
			}else{
			         echo 2; exit;
				 
			}
			 
	}
	
	public function getpass(){
	        $where['username'] = $this->_post('username','trim');
		$where['email'] = $to = $this->_post('email','trim');
		$res = M('Users')->field('id')->where($where)->select();
		 
	       
		if($res[0] == false) 
		{
		echo 1;
		 
		exit; 
		}
		 
		if($res[0] == true) {
		        $data['id'] = $res[0]['id'];
			$data['pid'] = md5($where['username'].$where['email'].time());
			
			if(M('Users')->save($data)){
                                 require_once( CORE."./common/class.smtp.php" );
				 require_once( CORE."./common/class.phpmailer.php" );
								 
				  $mail = new PHPMailer( );
				  $mail->CharSet = 'utf-8';
				  $mail->Encoding = "base64";
				  $mail->Port = C('email_port');
				 			
				 if ( C('email') == true )
				  {
				   $mail->IsSMTP( );
				  }
				  else
				  {
				   $mail->IsMail( );
				  }
				 
				  $mail->Host = C('email_server'); 
				  $mail->SMTPAuth = TRUE;
				  $mail->Username = C('email_user');
				  $mail->Password = C('email_pwd');
				  $mail->From = C('email_user');
				  $mail->FromName = C('site_name');
				  $mail->AddAddress( $to );
				  $mail->IsHTML( TRUE );
				  $mail->Subject = C('pwd_email_title');
				  $subject = C('pwd_email_title');
		                  $code = C('site_url').U('Index/setpass',array('pid'=>$data['pid']));
		                  $fetchcontent = C('pwd_email_content');
		                  $fetchcontent = str_replace('{username}',$where['username'],$fetchcontent);
		                  $fetchcontent = str_replace('{time}',date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),$fetchcontent);
				  $fetchcontent = str_replace('{getip}',get_client_ip(),$fetchcontent); 
				  $fetchcontent = str_replace('{sitename}',C('site_name'),$fetchcontent);
				  $fetchcontent = str_replace('{siteurl}',C('site_url'),$fetchcontent);
		                  $fetchcontent = str_replace('{code}',"<a href='$code' target=_blank>$code</a>",$fetchcontent);
				  $fetchcontent = str_replace('{pre}',"<br>",$fetchcontent);
				  
		                  $body=$fetchcontent;
				  $mail->Body = $body;			
                                  $mail->Send( ); 
 
			 echo 2;
			 
			 exit; 
			 
			}else{
			 echo 3;
			 exit;
				 
			}
		}
            	
	}
	
	public function setpass(){
	        $where['id']= $uid = $this->_post('uid');
		 
		$res=M('Users')->field('id,username')->where($where)->select();
		 
		
                
		$pwd=$this->_post('password');
		if($pwd!=false){
			$data['password']=md5($pwd);
			$data['pid']     ='';
			$data['id']=  $uid;
			if(M('Users')->save($data)){
			 echo 2;
			 
			 exit; 
			 
			}else{
			 echo 3;
			 exit;
				 
			}
		} 
	}
	public function checkpwd(){

		$where['username']=$this->_post('username');
		$where['email']=$this->_post('email');
		$db=D('Users');
		$list=$db->where($where)->find();
		if($list==false) $this->error('邮箱和帐号不正确',U('Index/regpwd'));
		
		$smtpserver = C('email_server'); 
		$port = C('email_port');
		$smtpuser = C('email_user');
		$smtppwd = C('email_pwd');
		$mailtype = "TXT";
		$sender = C('email_user');
		$smtp = new Smtp($smtpserver,$port,true,$smtpuser,$smtppwd,$sender); 
		$to = $list['email']; 
		$subject = C('pwd_email_title');
		$code = C('site_url').U('Index/resetpwd',array('uid'=>$list['id'],'code'=>md5($list['id'].$list['password'].$list['email']),'resettime'=>time()));
		$fetchcontent = C('pwd_email_content');
		$fetchcontent = str_replace('{username}',$where['username'],$fetchcontent);
		$fetchcontent = str_replace('{time}',date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),$fetchcontent);
		$fetchcontent = str_replace('{code}',$code,$fetchcontent);
		$body=$fetchcontent;
		//$body = iconv('UTF-8','gb2312',$fetchcontent);
		$send=$smtp->sendmail($to,$sender,$subject,$body,$mailtype);
		$this->success('请访问你的邮箱 '.$list['email'].' 验证邮箱后登录!<br/>');
		
	}
	
	public function resetpwd(){
		$where['id']=$this->_post('uid','intval');
		$where['password']=$this->_post('password','md5');
		if(M('Users')->save($where)){
			$this->success('修改成功，请登录！',U('Index/login'));
		}else{
			$this->error('密码修改失败！',U('Index/index'));
		}
	} 
	
}
