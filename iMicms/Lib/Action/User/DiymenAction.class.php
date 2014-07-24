<?php
class DiymenAction extends UserAction{
	//自定义菜单配置
	public function _initialize() {
		parent::_initialize();
		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		if(!strpos($token_open['queryname'],'diymen_set')){
            $this->error('您还未开启该模块的使用权,请到功能模块中添加',U('Function/adlist',array('token'=>session('token'),'id'=>session('wxid'))));
		}
	}
	public function index(){	
                      
			$class=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0))->order('sort asc')->select();//dump($class);
			foreach($class as $key=>$vo){
				$c=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>$vo['id']))->order('sort asc')->select();
				$class[$key]['class']=$c;
			}
		       
			$this->assign('class',$class);
			$this->display();
		 
	}
	
	public function menuset(){
		$data=M('Diymen_set')->where(array('token'=>$_SESSION['token']))->find();
		if(IS_POST){
			$_POST['token']=$_SESSION['token'];			
			if($data==false){				
				$this->all_insert('Diymen_set','/menuset');
			}else{
				$_POST['id']=$data['id'];
				$this->all_save('Diymen_set','/menuset');
			}
		}else{
			$this->assign('diymen',$data);
			 
			$this->display();
		}
	}
	public function  class_add(){
		if(IS_POST){
			$_POST['url']=rtrim($this->_post('url'),'/');
			$this->all_insert('Diymen_class','/class_add');
		}else{
			$class=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0))->order('sort desc')->select();
			$this->assign('class',$class);
			$this->display();
		}
	}
	public function  class_del(){		
		$class=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>$this->_get('id')))->order('sort desc')->find();
		//echo M('Diymen_class')->getLastSql();exit;
		if($class==false){
			$back=M('Diymen_class')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->delete();
			if($back==true){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}else{
				$this->error('请删除该分类下的子分类');
		}
		
		
	}
	public function  class_edit(){
		if(IS_POST){
			$_POST['id']=$this->_get('id');
			$this->all_save('Diymen_class','/classs_edit'.array('id='.$this->_get('id')));
		}else{
			$data=M('Diymen_class')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->find();
			if($data==false){
				$this->error('您所操作的数据对象不存在！');
			}else{
				$class=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0))->order('sort desc')->select();//dump($class);
				$this->assign('class',$class);
				$this->assign('show',$data);
			}
			$this->display();
		}
	}
	public function  upsaves(){
	 
	          $datas =array();
		  $data  =array();
		  $data['token']= $datas['token']= $_SESSION['token'];
                  $db = M('Diymen_class');
		 
		  
		  if($_REQUEST['new']){
          	  for($i=1;$i<=count($_REQUEST['new']['sort']);$i++){	  
                  foreach($_REQUEST['new'] as $k=>$v){ 
		    $data[$k] = handle_specialchars($_REQUEST['new'][$k][$i]);  
		  } 
           	  if($data) $db->data($data)->add();
		  }
		  }
		  
                  foreach($_REQUEST['ps'] as $kp=>$vp){
		  
		    $datas['id'] = $kp; 
		    
		    $datas['title']   =   handle_specialchars($_REQUEST['ps'][$kp]['title']); 
		    $datas['keyword'] =   $_REQUEST['ps'][$kp]['keyword']; 
		    $datas['sort']    =   intval($_REQUEST['ps'][$kp]['sort']); 
		    $datas['type']    =   intval($_REQUEST['ps'][$kp]['type']); 
		    $datas['is_show'] =   $_REQUEST['ps'][$kp]['is_show']; 
		        
		    $db->data($datas)->save();
		  
		    
		  } 
		 
	        $this->success('操作成功','/index.php?g=User&m=Diymen&a=index');
	}
public function  class_send(){
		  if(IS_GET){
		          
			$api=M('Diymen_set')->where(array('token'=>session('token')))->find();
			//dump($api);
			  
			$url_get='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$api['appid'].'&secret='.$api['appsecret'];
			 //$json=json_decode( file_get_contents($url_get));
			 $result = file_get_contents($url_get);
			if (empty($result)){
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt ($ch, CURLOPT_URL, $url_get);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($ch);
				curl_close($ch);
			}
			$json = json_decode($result);
			$data = '{"button":[';

			$class=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0,'is_show'=>1))->limit(3)->order('sort asc')->select();
                        $kcount=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0,'is_show'=>1))->limit(3)->order('sort asc')->count();
			$k=1;
			foreach($class as $key=>$vo){
				//主菜单

				$data.='{"name":"'.$vo['title'].'",';
				$c=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>$vo['id'],'is_show'=>1))->limit(5)->order('sort asc')->select();
				$count=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>$vo['id'],'is_show'=>1))->limit(5)->order('sort asc')->count();
				//子菜单
				if($c!=false){
					$data.='"sub_button":[';
				}else{
					if(strncasecmp($vo['keyword'],"http://",7)==0){
					$data.='"type":"view","url":"'.$vo['keyword'].'"';
					}else{
					$data.='"type":"click","key":"'.$vo['title'].'"';
					}
				}
				$i=1;
				foreach($c as $voo){					
					if($i==$count){
						if(stristr($voo['keyword'],"http")){
							$data.='{"type":"view","name":"'.$voo['title'].'","url":"'.$voo['keyword'].'"}';
						}else{
							$data.='{"type":"click","name":"'.$voo['title'].'","key":"'.$voo['keyword'].'"}';
						}
					}else{
						if(stristr($voo['keyword'],"http")){
							$data.='{"type":"view","name":"'.$voo['title'].'","url":"'.$voo['keyword'].'"},';
						}else{
							$data.='{"type":"click","name":"'.$voo['title'].'","key":"'.$voo['keyword'].'"},';
						}					
					}
					$i++;
				}
				if($c!=false){
					$data.=']';
				}
				
				if($k==$kcount){
					$data.='}';
				}else{
					$data.='},';
				}
				$k++;
			}
	                $data.=']}';
                         
			cookie('data',$data);
                      //  file_put_contents("d:/phpnow/vhosts/lexun.cc/cc1.txt",serialize($data));
			 
			file_get_contents("https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$json->access_token);
                        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$json->access_token;
			if($this->createMenu($url,$data,$json->access_token)==false){
			 //$this->error('操作失败');
				
			  echo 1;
			}else{
			       
                                                     
			      echo 2;
				// $this->success('操作成功');
			}
			 exit;
		 }else{
		         echo 3;exit;
		 	//$this->error('非法操作');
		 }
	}
	
	
	public function  class_ysend(){
		  if(IS_GET){
		          
			$api=M('Diymen_set')->where(array('token'=>session('token')))->find();
			 
			  
			$url_get='https://api.yixin.im/cgi-bin/token?grant_type=client_credential&appid='.$api['yappid'].'&secret='.$api['yappsecret'];
			$json=json_decode( file_get_contents($url_get));
			 
			if($api['yappid']==false||$api['yappsecret']==false){
			echo 4;exit;}
			$data = '{"button":[';
			
			$class=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0,'is_show'=>1))->limit(3)->order('sort asc')->select();//dump($class);
                        $kcount=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>0,'is_show'=>1))->limit(3)->order('sort asc')->count();
			$k=1;
			foreach($class as $key=>$vo){
				//主菜单

				$data.='{"name":"'.$vo['title'].'",';
				$c=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>$vo['id'],'is_show'=>1))->limit(5)->order('sort asc')->select();
				$count=M('Diymen_class')->where(array('token'=>session('token'),'pid'=>$vo['id'],'is_show'=>1))->limit(5)->order('sort asc')->count();
				//子菜单
				if($c!=false){
					$data.='"sub_button":[';
				}else{
					$data.='"type":"click","key":"'.$vo['title'].'"';
				}
				$i=1;
				foreach($c as $voo){					
					if($i==$count){  //if(stristr($voo['keyword'],"http:")){
						if(stristr($voo['keyword'],"http")){
							$data.='{"type":"view","name":"'.$voo['title'].'","url":"'.$voo['keyword'].'"}';
							
						}else{
							$data.='{"type":"click","name":"'.$voo['title'].'","key":"'.$voo['keyword'].'"}';
						}
					}else{
						if(stristr($voo['keyword'],"http")){
							$data.='{"type":"view","name":"'.$voo['title'].'","url":"'.$voo['keyword'].'"},';
						}else{
							$data.='{"type":"click","name":"'.$voo['title'].'","key":"'.$voo['keyword'].'"},';
						}					
					}
					$i++;
				}
				if($c!=false){
					$data.=']';
				}
				
				if($k==$kcount){
					$data.='}';
				}else{
					$data.='},';
				}
				$k++;
			}
	                $data.=']}';
                         
                   	 
			file_get_contents('https://api.yixin.im/cgi-bin/menu/delete?access_token='.$json->access_token);
                        $url='https://api.yixin.im/cgi-bin/menu/create?access_token='.$json->access_token;
			if($this->createMenu($url,$data,$json->access_token)==false){	
			  echo 1;
			}else{
			       
                                                     
			      echo 2;
				
			}
			 exit;
		 }else{
		         echo 3;exit;
		 	
		 }
	}
	
	
	function http_post($url,$param){
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
		}
		if (is_string($param)) {
			$strPOST = $param;
		} else {
			$aPOST = array();
			foreach($param as $key=>$val){
				$aPOST[] = $key."=".urlencode($val);
			}
			$strPOST =  join("&", $aPOST);
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($oCurl, CURLOPT_POST,true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus["http_code"])==200){
			return $sContent;
		}else{
			return false;
		}
	}
	
	function createMenu($url,$data,$access_token){
	
	       /*  const API_URL_PREFIX = 'https://api.weixin.qq.com/cgi-bin';
	         const AUTH_URL = '/token?grant_type=client_credential&';
	         const MENU_CREATE_URL = '/menu/create?';
	         const MENU_GET_URL = '/menu/get?';
	         const MENU_DELETE_URL = '/menu/delete?';
	         const MEDIA_GET_URL = '/media/get?';
		 */
		if (!$access_token) return false;
		$result = $this->http_post($url,$data);
		if ($result)
		{
			$json = json_decode($result,true);
			if (!$json || $json['errcode']>0) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			//return true;
			if($json && $json['errcode'] == -1) return false;
			 
			
			// file_put_contents("d:/phpnow/vhosts/lexun.cc/cc1.txt",$json['errcode']); 
			if($json && $json['errcode'] == 0)  return true;
		}
		//return false;
	}
	
	 

}
	?>
