<?php
function strExists($haystack, $needle)
{
	return !(strpos($haystack, $needle) === FALSE);
}
class IndexAction extends BaseAction{
        private $home;	//微官网信息
	private $tpl;	//微信公共帐号信息
	private $info;	//分类信息
	private $wecha_id;
	private $panel;
	private $panels;
	private $estates;
	private $copyright;
	private $copyid;
	public function _initialize(){
		parent::_initialize();
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		//MicroMessenger
		if(!strpos($agent,"Mobile")) {
			 //echo '此功能只能在微信、易信浏览器中使用';exit;
		}
		 
		 
		$where['token']=$this->_get('token','trim');
		$tpl    = D('Wxuser')->where($where)->find();
		$home   = D('Home')->where($where)->find();
		$estate = D('Estate')->where($where)->find();
		$carr = array("1"=>"#d87570","2"=>"#bc4040","3"=>"#6f9e98","4"=>"#b2cebf",
		              "5"=>"#d87570","6"=>"#bc4040","7"=>"#6f9e98","8"=>"#b2cebf",
			      "9"=>"#d87570","10"=>"#bc4040","11"=>"#6f9e98","12"=>"#b2cebf",
			      "13"=>"#d87570","14"=>"#bc4040","15"=>"#6f9e98","16"=>"#b2cebf");
		$carrs = array("1"=>"_C0 _L0","2"=>"_C1","3"=>"_C2","4"=>"_C3",
		              "5"=>"_C0 _L1","6"=>"_C1","7"=>"_C2","8"=>"_C3",
			      "9"=>"_C0 _L2","10"=>"_C1","11"=>"_C2","12"=>"_C3",
			      "13"=>"_C0 _L3","14"=>"_C1","15"=>"_C2","16"=>"_C3");	      
		               
		//dump($where);
		$info=M('Classify')->where(array('token'=>$this->_get('token'),'status'=>1))->order('sorts asc')->select();
		$gid=D('Users')->field('gid')->find($tpl['uid']);
		if (isset($_GET['wecha_id'])&&$_GET['wecha_id']){
			$_SESSION['wecha_id']=$_GET['wecha_id'];
			$this->wecha_id=$this->_get('wecha_id');
			$this->assign('wecha_id',$this->wecha_id);
		}
		if (isset($_SESSION['wecha_id'])){
			$this->wecha_id=$_SESSION['wecha_id'];
		}
		/*
		$copy=D('user_group')->field('iscopyright')->find($gid['gid']);	//查询用户所属组
		$this->copyright=$copy['iscopyright'];
		*/
		$this->copyright=$tpl['copyright'];
		$this->copyid   =$tpl['copyid'];
		$this->namecolor=$tpl['namecolor'];
		$this->wecha_id=$this->_get('wecha_id');
		$this->panel=$carr; 
		$this->panels=$carrs; 
		$this->estates=$estate; 
		$this->info=$info;
		$this->tpl=$tpl;
		$this->home=$home;
	}
	
	
	public function classify(){
		$this->assign('info',$this->info);
		
		$this->display($this->tpl['tpltypename']);
	}
	public function indexdata(){
	
	        $data['token']=$this->_get('token');
		$info=M('Estate')->where($data)->find();
		$mapurl = "http://st.map.soso.com/api?size=279*75¢er=".$info['lng'].",".$info['lat']."&zoom=14&markers=".$info['lng'].",".$info['lat'].",1";
		$t = array('issue'=>1,
		           'startTime'=>$info['create_time'],
			   'endTime'=>$info['create_time'],
			   'banner'=>$info['banner'],
			   'video'=>array('pic'=>'','vid'=>0,'width'=>0,'height'=>0,'title'=>''),
			   'sellInfo'=>stripslashes($info['estate_desc']),
			   'map'=>array('pic'=>$mapurl,'addr'=>$info['place'],'latlng'=>array('lat'=>$info['lat'],'lng'=>$info['lng'])),
			   'intro'=>array('title'=>'项目简介','detail'=>stripslashes($info['object_desc'])),
			   'traffic'=>array('title'=>'交通配套','detail'=>stripslashes($info['traffic_desc']))
			   );
	        $result = json_encode($t);
                $result =   str_replace('},"sellInfo":"','},"sellInfo":["',$result);
		$result =   str_replace('","detail":"','","detail":["',$result);
		$result =   str_replace('","map":','"],"map":',$result);
		$result =   str_replace('},"traffic"',']},"traffic"',$result);
		$result =   "renderData(".$result.");";  
		$result =   str_replace('}})',']}})',$result); 
		
		echo $result;
	     }
	
	public function lpindex(){
	
	        $data['token']=$this->_get('token');
		$info=M('Estate')->where($data)->find();
		
		
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('info',$info);
		
		$this->display();
	}
	
	public function lpjj(){
	
	        $data['token']=$this->_get('token');
		$info=M('Estate')->where($data)->find();
		
		
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('info',$info);
		
		$this->display();
	}
	
	public function xcdata(){
	        $data['token']=$this->_get('token');
		 
		$list=M('Estate_album')->where($data)->order('sort desc')->limit(9)->select();
		$t = array();
		$imglist = array();
		$dbhouse=M('Estate_album_list');
		for($i=0;$i<count($list);$i++){
		 $lmit = round($list[$i]['anum']/2);
		 $imglistsp1[$i] = $dbhouse->where(array('token'=>$this->_get('token'),'pid'=>$list[$i]['id']))->order('pid asc,sort asc')->limit($lmit)->select();	
		 $imglistsp21[$i] = $dbhouse->where(array('token'=>$this->_get('token'),'pid'=>$list[$i]['id']))->order('pid asc,sort asc')->limit($lmit,1)->select();	
		 $imglistsp22[$i] = $dbhouse->where(array('token'=>$this->_get('token'),'pid'=>$list[$i]['id']))->order('pid asc,sort asc')->limit($lmit+1,$list[$i]['anum']-$lmit-1)->select();	
		 
		 }
		 
		 for($j=0;$j<count($list);$j++){
		   $imgasp1[$j][]  = array('type'=>'title','title'=>$list[$j]['title'],'subTitle'=>$list[$j]['title']);
		 
		   for($m=0;$m<count($imglistsp1[$j]);$m++)
		   {
		    $imgasp1[$j][] = array('type'=>'img','name'=>$imglistsp1[$j][$m]['title'],'img'=>$imglistsp1[$j][$m]['picurl'],'size'=>$imglistsp1[$j][$m]['imgsize']);
		    
		   }
		  }
		   for($j=0;$j<count($list);$j++){
		   for($m=0;$m<count($imglistsp21[$j]);$m++)
		   {
		    $imgasp21[$j][] = array('type'=>'img','name'=>$imglistsp21[$j][$m]['title'],'img'=>$imglistsp21[$j][$m]['picurl'],'size'=>$imglistsp21[$j][$m]['imgsize']);
		    
		   }
		   $imgasp21[$j][] = array('type'=>'text','content'=>$list[$j]['info']);
		  }
		   for($j=0;$j<count($list);$j++){
		   for($m=0;$m<count($imglistsp22[$j]);$m++)
		   {
		    $imgasp21[$j][] = array('type'=>'img','name'=>$imglistsp22[$j][$m]['title'],'img'=>$imglistsp22[$j][$m]['picurl'],'size'=>$imglistsp22[$j][$m]['imgsize']);
		   
		   }
		  }
		 
		foreach($list as $k=>$v){
		  $t[] = array(
		  'title'=>$v['title'],
		  'ps1'=>$imgasp1[$k],
                  'ps2'=>$imgasp21[$k]		  
		  );
		
		}
		 $result = json_encode($t);
		 $result = str_replace('size":"[','size":[',$result);
		 $result = str_replace('450]"','450]',$result);
		 echo  "showPics(".$result.");";
		}
	public function hxdata(){	
		$data['token']=$this->_get('token');
		 
		$list=M('Estate_house')->where($data)->order('sort asc')->limit(9)->select();
		 
		 
		$roomslist = $house360list = $t = array();
		$dbhouse=M('Estate_house_list');
		$house360db=M('Estate_house360');
		
		for($i=0;$i<count($list);$i++){
		 
		 $roomslist[$i] = $dbhouse->where(array('token'=>$this->_get('token'),'pid'=>$list[$i]['id']))->order('pid asc,sort asc')->select();	
		 $house360list[$i] = $house360db->where(array('token'=>$this->_get('token'),'pid'=>$list[$i]['id']))->order('id desc')->select();	
		 
		 }
		 
		 
		 
		 for($j=0;$j<count($list);$j++){
		   $pics = $namesp1 = $full3d =array();
		  
		   for($r=1;$r<=count($roomslist[$j]);$r++){
		   if($roomslist[$j][$r]['picurl'])  $pics[]  = array('img'=>$roomslist[$j][$r]['picurl'],'width'=>960,'height'=>960,'name'=>$roomslist[$j][$r]['title']);
		    } 
		   $namesp1[]  = array('id'=>$list[$j]['id'],'name'=>$list[$j]['title'],'desc'=>$list[$j]['categoryname'],'rooms'=>$list[$j]['fang'].'房'.$list[$j]['ting'].'厅','floor'=>$list[$j]['floor_num'],'area'=>$list[$j]['area'],'simg'=>$roomslist[$j][0]['picurl'],'bimg'=>$roomslist[$j][0]['picurl'],'width'=>1600,'height'=>1600,'dtitle'=>"建筑面积：".$list[$j]['area'],'dlist'=>$list[$j]['info']);
		 
		   for($m=0;$m<count($house360list[$j]);$m++)
		   {
		     $xmlfile =  CVS_ROOT."/Data/upload/".$data['token']."/".$data['token']."-".$house360list[$j][$m]['id'].".xml"; 
		     if(file_exists($xmlfile)) $full3d[]  = array('name'=>$house360list[$j][$m]['title'],'list'=>array(array('name'=>$house360list[$j][$m]['title'],'url'=>'index.php?g=Wap&m=Index&a=view3d&pid='.$house360list[$j][$m]['pid'].'&id='.$house360list[$j][$m]['id'].'&token='.$data['token'])),'bimg'=>rtrim(C('site_url'),'/').'/tpl/static/images/bg_3.jpg');
		   
		    }
		   $ts[] = array(
		  
		  $namesp1,
                  'pics'=>$pics,
                  'full3d'=>$full3d
		  );
		  } 
		  
		  
		 
		  
		  
		  $t  = array('banner'=>$this->estates['house_banner'], 'rooms'=>$ts);
		 
		  
		$result =  json_encode($t); 
		$result = str_replace('[{"0":','',$result);
		$result = str_replace('{"0":','',$result);
		$result = str_replace('"dtitle":','"dtitle":[',$result);
		$result = str_replace('","dlist":"','"],"dlist":["',$result);
		$result = str_replace('}],"pics"','],"pics"',$result);
		$result = str_replace('}],"full3d":[]}]}','}]}]}',$result);
		$result = str_replace('}],"full3d":[]}','}]}',$result);
		$result = str_replace('"pics":[],','',$result);
		$result = str_replace(',[{"id":"',',{"id":"',$result);  
		echo "showRooms(".$result.");";
		 
	 }
	 
	 public function review(){
	 $data['token']=$this->_get('token');
	 
	 $list=M('Estate_expert')->where($data)->order('sort desc')->select();
	 $this->assign('wecha_id',$this->wecha_id);
	 $this->assign('res',$list);		 
	 $this->assign('gtoken',$data['token']);
	 $this->display();
	}	
 
	 public function impressdata(){
	 $data['token']=$this->_get('token');
	 $lists = array();
	 $total = 0;
	 $list=M('Estate_impress')->where($data)->order('comment desc')->select();
	 for($i=0;$i<count($list);$i++){
	 $total +=$list[$i]['comment'];
	 $lists[] = array('content'=>$list[$i]['title'],'count'=>$list[$i]['comment'],'id'=>$list[$i]['id']);
	  }
	 $t = array('msg'=>'ok',
	             'ret'=>0,
		     'user'=>array('content'=>$list[0]['title'],'count'=>$list[0]['comment'],'id'=>$list[0]['id']),
		     'top'=>$lists,
		     'sum'=>$total);
		     echo "reviewResult(".json_encode($t).");";
	  }
	 public function reviewdata(){
	 echo "renderProList([{\"name\":\"\u674e**\",\"title\":\"***\u5730\u4ea7\u90e8\u8d1f\u8d23\u4eba\",\"photo\":\"http:\/\/www.weimob.com\/templates\/kindeditor\/attached\/48\/ac\/3f\/image\/20131013\/20131013181042_67828.jpg\",\"intro\":\"\u5168\u7403\u57ce\u5e02\u4e0e\u5730\u4ea7\u7814\u7a76\u9662\u7814\u7a76\u5458\u3001\u5168\u56fd\u4e3b\u6d41\u5a92\u4f53\u8054\u76df\u5e38\u52a1\u59d4\u5458\uff0c\u4e2d\u56fd\u5546\u4e1a\u5730\u4ea7\u5341\u5927\u64cd\u76d8\u624b\u3002\u6df1\u5733\u7279\u533a\u62a5\u5730\u4ea7\u56e2\u961f\u66fe\u83b7 \u201c2008\u5e74\u9996\u5c4a\u4e2d\u56fd\u623f\u5730\u4ea7\u4e3b\u6d41\u5a92\u4f53\u521b\u65b0\u5927\u5956\u201d\u3001\u201c2009\u4e2d\u56fd\u57ce\u5e02\u5341\u4f73\u5730\u4ea7\u4f20\u5a92\u201d\u79f0\u53f7\u3002\",\"reviewTitle\":\"\u5347\u503c\u6f5c\u529b\u5de8\u5927\u7684\u6d77\u666f\u623f\",\"reviewDesc\":\"\u8be5\u9879\u76ee\u4f4d\u4e8e\u5a01\u6d77\u91d1\u7ebf\u9876\u533a\u57df\uff0c\u4e3b\u63a8\u9ad8\u5c42\u548c\u4e00\u7ebf\u770b\u6d77\u6d0b\u623f\uff0c\u9762\u79ef\u9002\u5408\u6539\u5584\u6027\u8d2d\u623f\u8005\uff0c\u4e5f\u662f\u672a\u6765\u6295\u8d44\u7684\u9ec4\u91d1\u5730\u5757\uff0c\u672a\u6765\u5347\u503c\u6f5c\u529b\u975e\u5e38\u5927\u3002\n\u5b9e\u529b\u96c4\u539a\uff0c\u54c1\u724c\u5f00\u53d1\u5546\uff0c\u9879\u76ee\u6240\u5f81\u4f4d\u7f6e\u662f\u5a01\u6d77\u7684\u9ec4\u91d1\u5730\u6bb5\uff0c\u6d77\u666f\u8d44\u6e90\u975e\u5e38\u4e30\u5bcc\u3002\"}]);";
	 }
	 public function lphx(){
	
	        $data['token']=$this->_get('token');
		$info=M('Estate')->where($data)->find();
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('info',$info);
		$this->assign('gtoken',$data['token']);
		$this->display();
	}
	 public function picfull(){
	          $data['pid']   = $this->_get('pid'); 
		$data['id']    = $this->_get('id');   
		$data['token']=$this->_get('token');
		 
		
		$info=M('Estate_house360')->where($data)->find(); 
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('info',$info);
		$this->assign('gtoken',$data['token']);
		$this->display();
	} 
	
	 public function view3d(){
	        $data['pid']=$this->_get('pid');
	        $data['id']=$this->_get('id');
	        $data['token']=$this->_get('token');
		$info=M('Estate_house360')->where($data)->find();
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('info',$info);
		$this->assign('id',$data['id']);
		$this->assign('gtoken',$data['token']);
		$this->display();
	} 
	
	public function Panorama(){
	        
	        $data['id']=$this->_get('id');
	        $data['token']=$this->_get('token');
		$info=M('Panorama_house360')->where($data)->find();
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('info',$info);
		$this->assign('id',$data['id']);
		$this->assign('gtoken',$data['token']);
		$this->display();
	} 
	 public function picroll(){
	
	        $data['token']=$this->_get('token');
		$info=M('Estate')->where($data)->find();
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('info',$info);
		$this->assign('gtoken',$data['token']);
		$this->display();
	} 
	public function lpxc(){
	
	        $data['token']=$this->_get('token');
		$info=M('Estate')->where($data)->find();
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('info',$info);
		$this->assign('gtoken',$data['token']);
		$this->display();
	}
	
	 public function company(){
	
	        $where['token']=$this->_get('token','trim');
		$db=D('Img');
		$p=$this->_get('p','intval',0);
		if($p) $p-=1;
		 
		$res=$db->where($where)->order('id DESC')->limit($p.',99')->select();
		 
		$count=$db->where($where)->count();
		if(!$count) $this->assign('notice','还没有任何信息');
		$p+=1;
		
		 
		$this->assign('gtoken',$this->_get('token'));
		$this->assign('wecha_id',$this->wecha_id);	//参数一定要传递
		$this->assign('page',(ceil($count/99)));
		$this->assign('p',$p);
		$this->assign('info',$this->info);
		$this->assign('res',$res); 
		$this->display();
	}
	public function index(){
	
		$where['token']=$this->_get('token');
		
		$wheres['token']  =$this->_get('token');
		$wheres['display']=1;
		$data['username']  = $this->_get('token');
		$UserDB = D('Plugmenu');
		
		$SDB = M('Selfform');
		
		$ssid=$SDB->where($where)->order('id desc')->find();
		 
	         $Page->firstRow = 0;
		 $Page->listRows = 4;
	         $Tpl = $this->tpl;
		 $model =  $Tpl['tpltypeid'];
		 $tplname = "index".$model;
	         $flash=M('Flash')->where($where)->select();
		 $count=count($flash);
		$list = $UserDB->where($wheres)->order('oid ASC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$list2 = $UserDB->where($wheres)->order('oid ASC')->limit(0,2)->select();
		$list3 = $UserDB->where($wheres)->order('oid ASC')->limit(2,2)->select();
		 
		$mb=M('Users')->where($data)->field('mobile')->find();
		if(!$mb['mobile']) $mb['mobile'] = C('telephone');
		
		$this->assign('gtoken',$this->_get('token'));
		$this->assign('mb',$mb['mobile']);
		$this->assign('plugmenu',$list);
		$this->assign('plugmenu2',$list2);
		$this->assign('plugmenu3',$list3);
		$this->assign('flash',$flash);
		$this->assign('sid',$ssid['id']);
        $this->assign('wechat_id',$this->wecha_id);
		$this->assign('num',$count);
		$this->assign('info',$this->info);
		$this->assign('tpl',$this->tpl);
		$this->assign('home',$this->home);
		$this->assign('panels',$this->panels);
		$this->assign('panel',$this->panel);
		$this->assign('wecha_id',$this->wecha_id);		
		$this->assign('copyright',$this->copyright);
		$this->assign('copyid',$this->copyid);
		$this->assign('namecolor',$this->namecolor);
		
	 
		//$this->display($this->tpl['tpltypename']);
		 $this->display($tplname);
	}
	
	
	public function house(){
		$where['token']=$this->_get('token');
		
		$wheres['token']  =$this->_get('token');
		$wheres['display']=1;
		
		$data['username']  = $this->_get('token');
		$UserDB = D('Plugmenu');
		
		$SDB = M('Selfform');
		
		$ssid=$SDB->where($where)->order('id desc')->find();
		 
	         $Page->firstRow = 0;
		 $Page->listRows = 4;
	         $Tpl = $this->tpl;
		 $model =  40;
		 $tplname = "index".$model;
	         $flash=M('Flash')->where($where)->select();
		 $count=count($flash);
		$list = $UserDB->where($wheres)->order('oid ASC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$mb=M('Users')->where($data)->field('mobile')->find();
		if(!$mb['mobile']) $mb['mobile'] = C('telephone');
		 
		$this->assign('gtoken',$this->_get('token'));
		$this->assign('mb',$mb['mobile']);
		$this->assign('plugmenu',$list);
		$this->assign('flash',$flash);
		$this->assign('sid',$ssid['id']);
		 
		$this->assign('num',$count);
		$this->assign('info',$this->info);
		$this->assign('tpl',$this->tpl);
		$this->assign('home',$this->home);
		$this->assign('panels',$this->panels);
		$this->assign('panel',$this->panel);
		$this->assign('wecha_id',$this->wecha_id);		
		$this->assign('copyright',$this->copyright);
		$this->assign('namecolor',$this->namecolor);  
		$this->display($tplname);
	}
	public function lists(){
		$where['token']=$this->_get('token','trim');
		$db=D('Img');
		$p=$this->_get('p','intval',0);
		if($p) $p-=1;
		$where['classid']=$this->_get('classid','intval');
		$res=$db->where($where)->order('sorts ASC')->limit($p.',99')->select();
		
		$count=$db->where($where)->count();
		if(!$count) $this->assign('notice','还没有任何信息');
		$p+=1;
		
		$wheres['token']  =$this->_get('token');
		$wheres['display']=1;
		$UserDB = D('Plugmenu');
		$list = $UserDB->where($wheres)->order('oid ASC')->select();
		
		 
		
		$Tpl = $this->tpl;
		$model  =  $Tpl['tpllistid'];
		$menuid =  $Tpl['menuid'];
		$tplname = "list".$model;
		if($menuid) $tplname = "list".$model."-".$menuid;
		$this->assign('plugmenu',$list);
		$this->assign('gtoken',$this->_get('token'));
		$this->assign('wecha_id',$this->wecha_id);	//参数一定要传递
		$res=$this->convertLinks($res);
		$this->assign('page',(ceil($count/99)));
		$this->assign('p',$p);
		$this->assign('info',$this->info);
		$this->assign('home',$this->home);
		$this->assign('tpl',$this->tpl);
		$this->assign('res',$res);
		$this->assign('menuid',$menuid);
		$this->assign('copyright',$this->copyright);
		//$this->display($this->tpl['tpllistname']);
		$this->display($tplname);
	}
	
	public function content(){
		$db=M('Img');
		$where['token']=$this->_get('token','trim');
		$where['id']=array('neq',(int)$_GET['id']);
		$lists=$db->where($where)->limit(99)->order('uptatetime')->select();
		$where['id']=$this->_get('id','intval');
		$res=$db->where($where)->find();
		
		$wheres['token']  =$this->_get('token');
		$wheres['display']=1;
		$UserDB = D('Plugmenu');
		$list = $UserDB->where($wheres)->order('oid ASC')->select();
		
		$Tpl = $this->tpl;
		$model  =  $Tpl['tplcontentid'];
		$menuid =  $Tpl['menuid'];
		$tplname = "detail".$model;
		if($menuid) $tplname = "detail".$model."-".$menuid;
		//echo $tplname;exit;
		$this->assign('home',$this->home);
		$this->assign('gtoken',$this->_get('token'));
		$this->assign('wecha_id',$this->wecha_id);	//参数一定要传递
		$this->assign('info',$this->info);	//分类信息
		$this->assign('lists',$lists);		//列表信息
		$this->assign('plugmenu',$list);
		$this->assign('res',$res);			//内容详情;
		$this->assign('tpl',$this->tpl);				//微信帐号信息
		$this->assign('copyright',$this->copyright);	//版权是否显示
		//$this->display($this->tpl['tplcontentname']);
		$this->assign('menuid',$menuid);
		$this->display($tplname);  //最新的暂时没启用
	}
	public function getLink($url){
		$url=$url?$url:'javascript:void(0)';
		$urlArr=explode(' ',$url);
		$urlInfoCount=count($urlArr);
		if ($urlInfoCount>1){
			$itemid=intval($urlArr[1]);
		}
		//会员卡 刮刮卡 团购 商城 大转盘 优惠券 订餐 商家订单 表单
		if (strExists($url,'刮刮卡')){
			$link='/index.php?g=Wap&m=Guajiang&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'大转盘')){
			$link='/index.php?g=Wap&m=Lottery&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'优惠券')){
			$link='/index.php?g=Wap&m=Coupon&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'刮刮卡')){
			$link='/index.php?g=Wap&m=Guajiang&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'商家订单')){
			if ($itemid){
				$link=$link='/index.php?g=Wap&m=Host&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id.'&hid='.$itemid;
			}else {
				$link='/index.php?g=Wap&m=Host&a=Detail&token='.$this->token.'&wecha_id='.$this->wecha_id;
			}
		}elseif (strExists($url,'万能表单')){
			if ($itemid){
				$link=$link='/index.php?g=Wap&m=Selfform&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}elseif (strExists($url,'相册')){
			$link='/index.php?g=Wap&m=Photo&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link='/index.php?g=Wap&m=Photo&a=plist&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}elseif (strExists($url,'全景')){
			$link='/index.php?g=Wap&m=Panorama&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link='/index.php?g=Wap&m=Panorama&a=item&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}elseif (strExists($url,'会员卡')){
			$link='/index.php?g=Wap&m=Card&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,'商城')){
			$link='/index.php?g=Wap&m=Product&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,'订餐')){
			$link='/index.php?g=Wap&m=Product&a=dining&dining=1&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,'团购')){
			$link='/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,'首页')){
			$link='/index.php?g=Wap&m=Index&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,'网站分类')){
			$link='/index.php?g=Wap&m=Index&a=lists&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link='/index.php?g=Wap&m=Index&a=lists&token='.$this->token.'&wecha_id='.$this->wecha_id.'&classid='.$itemid;
			}
		}elseif (strExists($url,'图文回复')){
			if ($itemid){
				$link='/index.php?g=Wap&m=Index&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}elseif (strExists($url,'LBS信息')){
			$link='/index.php?g=Wap&m=Company&a=map&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link='/index.php?g=Wap&m=Company&a=map&token='.$this->token.'&wecha_id='.$this->wecha_id.'&companyid='.$itemid;
			}
		}elseif (strExists($url,'DIY宣传页')){
			$link='/index.php/show/'.$this->token;
		}elseif (strExists($url,'婚庆喜帖')){
			if ($itemid){
				$link='/index.php?g=Wap&m=Wedding&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}elseif (strExists($url,'投票')){
			if ($itemid){
				$link='/index.php?g=Wap&m=Vote&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}else {
			$link=str_replace(array('{wechat_id}','{siteUrl}','&amp;'),array($this->wecha_id,C('site_url'),'&'),$url);
			if (!!(strpos($url,'tel')===false)&&$url!='javascript:void(0)'&&!strpos($url,'wecha_id=')){
				if (strpos($url,'?')){
					$link=$link.'&wecha_id='.$this->wecha_id;
				}else {
					$link=$link.'?wecha_id='.$this->wecha_id;
				}
			}
			
		}
		return $link;
	}
	public function convertLinks($arr){
		$i=0;
		foreach ($arr as $a){
			if ($a['url']){
				$arr[$i]['url']=$this->getLink($a['url']);
			}
			$i++;
		}
		return $arr;
	}
	public function flash(){
		$where['token']=$this->_get('token','trim');
		$flash=M('Flash')->where($where)->order('sort desc')->select();
		$count=count($flash);
		$this->assign('flash',$flash);
		$this->assign('info',$this->info);
		$this->assign('num',$count);
		$this->display('ty_index');
	}
	public function animate(){
	  
	  $info = $this->home;
	  
	   $an_index = "an".$info['animation']; 
	 
	  
	  
	   $this->display($an_index);
	
	}
	 
	
}