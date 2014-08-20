<?php
class IndexAction extends UserAction{
	//公众帐号列表
	public function index(){
		 
		$this->display();
	}
	public function info(){
		 
		$this->display();
	}
	public function packageintr(){
		 
		$this->display();
	}
	
        public function tools(){
		 
		$db=M('Tools');
		
		$info=$db->where('sort<14')->order('sort asc')->select();
		
              	$info1=$db->where('sort>13')->order('sort asc')->select();
		 
		$this->assign('info',$info);
		$this->assign('info1',$info1);
		 
		$this->display();
	}	
	public function pic(){
	        $month=$this->_get('month');
		if(!$month) $month = date("m",time());  
		$this->assign('month',$month);
		$this->display();
	}
	public function chat(){ 
	$month=$this->_get('month');
	$yy = date("Y",time());
	$xml = "<?xml version='1.0' encoding='utf-8'?>
       <chart caption='".$yy."-".$month."月请求曲线' subcaption=' ' lineThickness='4' showValues='0' formatNumberScale='0' anchorRadius='4'   divLineAlpha='15' divLineColor='666666' divLineIsDashed='1' showAlternateHGridColor='1' alternateHGridColor='666666' shadowAlpha='40' labelStep='2' numvdivlines='5' chartRightMargin='35' bgColor='FFFFFF,FFFFFF' bgAngle='270' bgAlpha='10,10' alternateHGridAlpha='5'  legendPosition ='RIGHT ' baseFontSize='12' baseFont='Microsoft YaHei,Helvitica,Verdana,Arial,san-serif' canvasBorderThickness='1' canvasBorderColor='888888' showShadow='1' animation='1' showBorder='0' showToolTip='1' adjustDiv='1' setAdaptiveYMin='1' defaultAnimation='1' ><categories ><category label='1日' /><category label='2日' /><category label='3日' /><category label='4日' /><category label='5日' /><category label='6日' /><category label='7日' /><category label='8日' />
       <category label='9日' /><category label='10日' /><category label='11日' /><category label='12日' />
       <category label='13日' /><category label='14日' /><category label='15日' /><category label='16日' />
       <category label='17日' /><category label='18日' /><category label='19日' /><category label='20日' />
       <category label='21日' /><category label='22日' /><category label='23日' /><category label='24日' />
       <category label='25日' /><category label='26日' /><category label='27日' /><category label='28日' />
       <category label='29日' /><category label='30日' /></categories>
       <dataset seriesName='文本统计' color='3d87c9' anchorBorderColor='3d87c9' anchorBgColor='ffffff'>
       <set value='3' /><set value='1' /><set value='3' /><set value='5' /><set value='3' /><set value='2' />
       <set value='1' /><set value='5' /><set value='8' /><set value='10' /><set value='20' /><set value='3' />
       <set value='12' /><set value='14' /><set value='15' /><set value='12' /><set value='11' /><set value='23' />
       <set value='11' /><set value='22' /><set value='11' /><set value='45' /><set value='50' /><set value='110' />
       <set value='11' /><set value='23' /><set value='45' /><set value='22' /><set value='10' /><set value='60' />
       </dataset>
       <dataset seriesName='图文请求数' color='66cc00' anchorBorderColor='66cc00' anchorBgColor='ffffff'>
       <set value='10' /><set value='20' /><set value='30' /><set value='20' /><set value='10' /><set value='10' />
       <set value='20' /><set value='40' /><set value='60' /><set value='80' /><set value='70' /><set value='10' />
       <set value='10' /><set value='20' /><set value='40' /><set value='50' /><set value='60' /><set value='60' />
       <set value='10' /><set value='23' /><set value='45' /><set value='66' /><set value='88' /><set value='90' />
       <set value='120' /><set value='30' /><set value='10' /><set value='40' /><set value='80' /><set value='90' />
       </dataset>
       <dataset seriesName='语音请求数' color='ffcc00' anchorBorderColor='ffcc00' anchorBgColor='ffffff'>
       <set value='10' /><set value='20' /><set value='30' /><set value='40' /><set value='20' /><set value='40' />
       <set value='10' /><set value='20' /><set value='30' /><set value='40' /><set value='20' /><set value='40' />
       <set value='10' /><set value='20' /><set value='30' /><set value='40' /><set value='20' /><set value='40' />
       <set value='10' /><set value='20' /><set value='30' /><set value='40' /><set value='20' /><set value='40' />
       <set value='10' /><set value='20' /><set value='30' /><set value='40' /><set value='20' /><set value='40' />
       </dataset>
       <dataset seriesName='总请求数' color='cc66ff' anchorBorderColor='cc66ff' anchorBgColor='ffffff'>
       <set value='110' /><set value='11' /><set value='60' /><set value='60' /><set value='20' /><set value='90' />
       <set value='10' /><set value='20' /><set value='60' /><set value='40' /><set value='40' /><set value='30' />
       <set value='20' /><set value='20' /><set value='60' /><set value='30' /><set value='70' /><set value='80' />
       <set value='30' /><set value='20' /><set value='60' /><set value='20' /><set value='80' /><set value='70' />
       <set value='40' /><set value='20' /><set value='60' /><set value='10' /><set value='90' /><set value='10' />
       </dataset><styles>
    <definition>
      <style name='CaptionFont' type='font' size='12'/>
    </definition>
    <application>
      <apply toObject='CAPTION' styles='CaptionFont' />
      <apply toObject='SUBCAPTION' styles='CaptionFont' />
    </application>
  </styles>
  </chart>";
     echo $xml;
     }
     
 public function chatuser(){     
    $month=$this->_get('month');
    $yy = date("Y",time());
  $xml = "<?xml version='1.0' encoding='utf-8'?>
<chart caption='".$yy."-".$month."月用户曲线' subcaption=' ' lineThickness='4' showValues='0' formatNumberScale='0' anchorRadius='4'   divLineAlpha='15' divLineColor='666666' divLineIsDashed='1' showAlternateHGridColor='1' alternateHGridColor='666666' shadowAlpha='40' labelStep='2' numvdivlines='5' chartRightMargin='35' bgColor='FFFFFF,FFFFFF' bgAngle='270' bgAlpha='10,10' alternateHGridAlpha='5'  legendPosition ='RIGHT ' baseFontSize='12' baseFont='Microsoft YaHei,Helvitica,Verdana,Arial,san-serif' canvasBorderThickness='1' canvasBorderColor='888888' showShadow='1' animation='1' showBorder='0' showToolTip='1' adjustDiv='1' setAdaptiveYMin='1' defaultAnimation='1' ><categories >
<category label='1日' /><category label='2日' /><category label='3日' /><category label='4日' />
<category label='5日' /><category label='6日' /><category label='7日' /><category label='8日' />
<category label='9日' /><category label='10日' /><category label='11日' /><category label='12日' />
<category label='13日' /><category label='14日' /><category label='15日' /><category label='16日' />
<category label='17日' /><category label='18日' /><category label='19日' /><category label='20日' />
<category label='21日' /><category label='22日' /><category label='23日' /><category label='24日' />
<category label='25日' /><category label='26日' /><category label='27日' /><category label='28日' />
<category label='29日' /><category label='30日' /></categories>
<dataset seriesName='关注数' color='99ccff' anchorBorderColor='99ccff' anchorBgColor='ffffff'>
<set value='3' /><set value='1' /><set value='3' /><set value='5' /><set value='7' /><set value='1' />
<set value='2' /><set value='5' /><set value='1' /><set value='5' /><set value='6' /><set value='8' />
<set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' />
<set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' />
<set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' />
</dataset>
<dataset seriesName='取消关注数' color='d3d3d3' anchorBorderColor='d3d3d3' anchorBgColor='ffffff'>
<set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' />
<set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' />
<set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' />
<set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' />
<set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' />
</dataset>
<dataset seriesName='净增长数' color='cc0000' anchorBorderColor='cc0000' anchorBgColor='ffffff'>
<set value='0' /><set value='1' /><set value='2' /><set value='4' /><set value='0' /><set value='0' />
<set value='0' /><set value='0' /><set value='2' /><set value='5' /><set value='0' /><set value='0' />
<set value='0' /><set value='0' /><set value='1' /><set value='1' /><set value='0' /><set value='0' />
<set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' />
<set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' /><set value='0' />
</dataset><styles>
    <definition>
      <style name='CaptionFont' type='font' size='12'/>
    </definition>
    <application>
      <apply toObject='CAPTION' styles='CaptionFont' />
      <apply toObject='SUBCAPTION' styles='CaptionFont' />
    </application>
  </styles>
</chart>";
     echo $xml;
     }
	public function acount(){
		$where['uid']=session('uid');
		$gid = session('gid');
		$group=D('User_group')->select();
		foreach($group as $key=>$val){
			$groups[$val['id']]['did']=$val['diynum'];
			$groups[$val['id']]['cid']=$val['connectnum'];
		}
		unset($group);
		$db=M('Wxuser');
		$count=$db->where($where)->count();
		$priv = "/index.php?g=User&m=Index&a=add";
		//$dbs=M('User_group');
		//$gongzhongnum = $dbs->where(array('id'=>$gid))->select();
		$userg=M('User_group')->field('gongzhongnum,name')->find($gid); 
		 
		$gn = intval($userg['gongzhongnum']);
		if($count>=$gn) $priv = "javascript:alert('配额不足，请升级！');";
		$page=new Page($count,25);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('info',$info);
		$this->assign('userg',$userg);
		$this->assign('group',$groups);
		$this->assign('total',$count);
		$this->assign('priv',$priv);
		$this->assign('page',$page->show());
		$this->display();
	}
	
	public function user(){
		$where['id']=session('uid');
		$gid = session('gid');
		 
		$db=M('Users');
		$info=$db->where($where)->field('tusername,mobile,qq,email')->select();
		 
		 
		$this->assign('info',$info[0]);
		 
		$this->display();
	}
	//添加公众帐号
	public function add(){
		$this->display();
	}
	public function edit(){
		$id=$this->_get('id','intval');
		$where['uid']=session('uid');
		$res=M('Wxuser')->where($where)->find($id);
		$data=M('Diymen_set')->where(array('token'=>$_SESSION['token']))->find();
		$res['appid']=$data['appid'];
		$res['appsecret']=$data['appsecret'];
	
		$this->assign('info',$res);
		$this->display();
	}
	
	public function del(){
	        $forward = $this->_get('forward','');
		switch($forward){
                case 'acount':
	              $back = "/index.php?g=User&m=Index&a=".$forward;
                break;
		
		default: $back = "/index.php?g=User&m=Index&a=acount";
		 }
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		 
		if(D('Wxuser')->where($where)->delete()){
			 $this->success('操作成功',$back);
			 	
		}else{
			$this->error('操作失败',$back);
		}
	}
	
	public function upsave(){
		$this->all_save('Wxuser','/index.php?g=User&m=Index&a=acount');
	}
	
	public function insert(){
	        $_POST['token']= substr(md5($_POST['wxid']),8,16);
		$this->all_insert('Wxuser','/index.php?g=User&m=Index&a=acount');
		$this->addfc();
	}
	
	//功能
	public function autos(){
		$this->display();
	}
	
	public function addfc(){
		$token_open=M('Token_open');
		$open['uid']=session('uid');
		$open['token']=substr(md5($_POST['wxid']),8,16);
		$gid=session('gid');
		$fun=M('Function')->field('funname,gid,isserve')->where('`gid` <= '.$gid)->select();
		foreach($fun as $key=>$vo){
			$queryname.=$vo['funname'].',';
		}
		$open['queryname']=rtrim($queryname,',');
		$token_open->data($open)->add();
	}
	
	public function usersave(){
	        $where['id']=session('uid');
		$res=M('Users')->field('password')->where($where)->select();
		 
	        $old_pwd=$this->_post('old_password');
		if(md5($old_pwd) != $res[0]['password']) 
		{
		echo '原密码不正确!';
		//header("Location: U('Index/useredit')");
		exit; 
		}
		$pwd=$this->_post('password');
		if($pwd!=false){
			$data['password']=md5($pwd);
			$data['id']=$_SESSION['uid'];
			if(M('Users')->save($data)){
			 echo '密码修改成功！';
			 $url = U('Index/useredit');
			  
			 //$this->success('密码修改成功！',U('Index/index'));
			}else{
			 echo '密码修改失败！';
				//$this->error('密码修改失败！',U('Index/index'));
			}
		}else{
		 echo '新密码不能为空!';
		 exit;
			//$this->error('密码不能为空!',U('Index/useredit'));
		}
	}
	
	public function usersaves(){
	        $where['id']=session('uid');
		 
		 
	         $data['tusername']=$this->_post('tusername');
		 $data['id']=$_SESSION['uid'];
		 $data['qq']=$this->_post('qq');
		 $data['mobile']=$this->_post('mobile');
		 $data['email']=$this->_post('email');
			 
			
			if(M('Users')->save($data)){
			 
			
			  
			  $this->success('修改成功！',U('Index/user'));
			}else{
			// echo '修改失败！';
				 $this->error('修改失败！',U('Index/user'));
			}
		 
	}
    //余额续费
    public function pay()
    {
        $userinfo = M('Users')->where(array(
            'id' => session('uid')
        ))->find();
        $group    = M('User_group')->field('id,name,price')->where('price > 0')->select();
        $user     = M('User_group')->field('price')->where(array(
            'id' => session('gid')
        ))->find();
        $viptime  = $userinfo['viptime'];
        $money    = $userinfo['money'];
        $gid      = $userinfo['gid'];
        $this->assign('group', $group);
        $this->assign('user', $user);
        $this->assign('viptime', $viptime);
        $this->assign('money', $money);
        $this->assign('gid', $gid);
        $this->display();
    }
    
    public function dopay()
    {
        $userinfo = M('Users')->where(array(
            'id' => session('uid')
        ))->find();
        $money    = $userinfo['money'];
        $viptime  = $userinfo['viptime'];
        $price    = intval($_POST['price']);
        $num      = intval($_POST['num']);
        $vip      = strtotime("+" . $num . " month", $viptime);
        if ($money < $price) {
            $this->error("余额不足，请充值！", U('Alipay/index'));
        } else {
            $mback = M('Users')->where(array(
                'id' => session('uid')
            ))->setDec('money', $price);
            $vback = M('Users')->where(array(
                'id' => session('uid')
            ))->setField('viptime', $vip);
            if ($mback != false && $vback != false) {
                $this->success('续费成功！', U('Index/index'));
            } else {
                $this->error('操作失败！请联系管理员', U('Index/index'));
            }
        }
    }
    
    public function pay_history()
    {
        $this->display();
    }
    
    public function sms_plat()
    {
        $id           = $this->_get('id', 'intval');
        $where['uid'] = session('uid');
		$where['token']=session('token');
        $res          = M('Wxuser')->where($where)->find($id);
        if (IS_POST) {
            $row['sms_plat_status']     = $this->_post('sms_plat_status');
            $row['sms_plat_reply']      = $this->_post('sms_plat_reply');
            $row['sms_plat_user']       = $this->_post('sms_plat_user');
            $row['sms_plat_pass']       = $this->_post('sms_plat_pass');
            $row['sms_plat_order_feed'] = $this->_post('sms_plat_order_feed');
            $row['sms_plat_pay_feed']   = $this->_post('sms_plat_pay_feed');
            if ($res) {
                $where = array(
                    'token' => $this->token
                );
                M('Wxuser')->where($where)->save($row);
                $this->success('设置成功', U('sms_plat', $where));
            } else {
                $this->error('设置失败', U('sms_plat', $where));
            }
        } else {
            $this->assign('info', $res);
            $this->display();
        }
    }
    
    public function smtp_plat()
    {
        $id           = $this->_get('id', 'intval');
        $where['uid'] = session('uid');
		$where['token']=session('token');
        $res          = M('Wxuser')->where($where)->find($id);
        if (IS_POST) {
            $row['smtp_plat_status']     = $this->_post('smtp_plat_status');
            $row['smtp_plat_host']       = $this->_post('smtp_plat_host');
            $row['smtp_plat_port']       = $this->_post('smtp_plat_port');
            $row['smtp_plat_send']       = $this->_post('smtp_plat_send');
            $row['smtp_plat_pass']       = $this->_post('smtp_plat_pass');
            $row['smtp_plat_reply']      = $this->_post('smtp_plat_reply');
            $row['smtp_plat_ssl']        = $this->_post('smtp_plat_ssl');
            $row['smtp_plat_order_feed'] = $this->_post('smtp_plat_order_feed');
            $row['smtp_plat_pay_feed']   = $this->_post('smtp_plat_pay_feed');
            if ($res) {
                $where = array(
                    'token' => $this->token
                );
                M('Wxuser')->where($where)->save($row);
                $this->success('设置成功', U('smtp_plat', $where));
            } else {
                $this->error('设置失败', U('smtp_plat', $where));
            }
        } else {
            $this->assign('info', $res);
            $this->display();
        }
    }
}
?>
