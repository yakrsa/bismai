<?php
class WcardAction extends UserAction{
	//配置
	
	public function index(){
	
	        $token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		//dump($token_open);
		if(!strpos($token_open['queryname'],'wcard')){$this->error('您还开启该模块的使用权,请到功能模块中添加',U('Function/adlist',array('token'=>session('token'),'id'=>session('wxid'))));}
		//列表
		 
		$db=D('Wcard');
		$uid = session('uid'); 
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('uid',$uid);  
		$this->assign('info',$info);
		$this->display();
	}
	public function adds(){
	$this->display();
	}
	
	public function add(){
		$class=M('Classify')->where(array('token'=>session('token')))->select();
		if($class==false){$this->error('请先添加3G网站分类',U('Classify/index',array('token'=>session('token'))));}
		$db=M('Classify');
		$where['token']=session('token');
		$info=$db->where($where)->select();
		$this->assign('info',$info);
		$this->display();
	}
	public function edit(){
		$where['id']=$this->_get('id','intval'); 
		$where['token']=session('token');
		 
		$info=D('Wcard')->where($where)->find();
		$data=M('Wcard_list');
		$list = $data->where(array('token'=>$_SESSION['token'],'pid'=>$this->_get('id')))->order('id desc')->select();	
		 
		$this->assign('cnt',count($list));
		$this->assign('info',$info);
		$this->assign('photo',$list); 
		$this->display();
	}
	 
	
	public function delbatch(){
		$ids =$this->_post('ids');
		 
		
		if(!$ids)  $this->error('数据错误');
		$ids .=0; 
		
		if($ids) $ids = str_replace("on,","",$ids);
		 
		$where['token']= session('token');
		$token = session('token');
		if($ids) 
		{
		$where       = "token='$token' AND id IN ($ids)";
		$wherepid    = "token='$token' AND pid IN ($ids)";
		$wherekeypid = "token='$token' AND module='Wcard' AND pid IN ($ids)";
		}
		
		// file_put_contents("d:/phpnow/vhosts/lexun.cc/cc1.txt",$where); 
		if(D(MODULE_NAME)->where($where)->delete()){
		        M('Wcard_list')->where($wherepid)->delete();
			M('Keyword')->where($wherekeypid)->delete();
			echo 0;
		}else{
			echo 1;
		}
	}
	public function search(){	
	       
		 
		$data['keyword']=array('like','%'.$this->_get('keyword').'%');
		$like['token']=$this->token; 
		$data['token']= session('token'); 
		 
		
		$list=M('Wcard')->where($data)->select();
		$this->assign('info',$list);
		$this->display('index');
	
	}
	
	public function insert(){
	       $name = 'Wcard';
	       $farword="/index.php?g=User&m=Wcard&a=index";
	       $data['token']   = session('token');
	       $data['keyword'] = $_POST['keyword'];		
	       $db=D($name); 
	      // print_r($_REQUEST);EXIT;
	       if($db->create()===false){
		
			$this->error($db->getError());
		}else{
		
			$id=$db->add();
			if($id){
				$m_arr=array('Img','Text','Voiceresponse','Ordering','Lottery','Other','Host','Product','Selfform','Wcard');
				if(in_array($name,$m_arr)){
					$data['pid']=$id;
					$data['module']=$name;
					 
					M('Keyword')->add($data);
				}
				
			    for($i=0;$i<count($_REQUEST['photoid']);$i++){	  
                        
		            $datas['title']   =  handle_specialchars($_REQUEST['description'][$i]);  
		           
                            $datas['picurl']  =  handle_specialchars($_REQUEST['url'][$i]); 
 			   
			    $datas['status']  =  1;
			    $datas['pid']     =  $id;
			    $datas['token']   =  $_SESSION['token'];
			    $datas['create_time'] = time();
			    M('Wcard_list')->data($datas)->add();
                       }	
				 
				 $this->success('操作成功',$farword);
			}else{
			        
				 $this->error('操作失败',$farword);
			}
		}
		 
	}
	public function upsave(){
	       $flag = 0;
	       $name = 'Wcard';
	       $farword="/index.php?g=User&m=Wcard&a=index";
	       $data['token']   =  session('token');
	       
               $cnt             =  $this->_post('cnt','intval');
               $aid             =  $this->_post('aid','intval');		       
	       $db=D($name); 
	       if($cnt != count($_REQUEST['photoid'])) $flag=1;
	       
	       foreach($_REQUEST['photoid'] as $k=>$v){
	       
	        if($v==$aid) {$flag =1;break;}
	       }
	      if($flag){
	        M('Wcard_list')->where(array('token'=>$_SESSION['token'],'pid'=>$this->_post('id')))->delete(); 	
			   
	       for($i=0;$i<count($_REQUEST['photoid']);$i++){	  
                        
		            $datas['title']   =  handle_specialchars($_REQUEST['description'][$i]);  
		           
                            $datas['picurl']  =  handle_specialchars($_REQUEST['url'][$i]); 
 			   
			    $datas['status']  =  1;
			    $datas['pid']     =  $this->_post('id');
			    $datas['token']   =  $_SESSION['token'];
			    $datas['create_time'] = time();
			    M('Wcard_list')->data($datas)->add();
                       }	
	      
	        }
		if($db->create()===false){
		 
			$this->error($db->getError());
		}else{
		 
			$id=$db->save();
			 
			if($id){
				 
					$data['pid']     = $this->_post('id');
					$data['module']  = $name;
					$da['keyword']   = $_POST['keyword'];
					M('Keyword')->where($data)->save($da);
					//F('SQLTT',M('Keyword')->getLastSql());
				 
			      
				
			        $this->success('操作成功',$farword);
			}else{
			       	 $this->error('操作失败',$farword);
			}
		}
	}
	public function upload(){	       
                
		if(IS_POST){
                     M('Wcard_list')->where(array('token'=>$_SESSION['token'],'pid'=>$this->_post('pid')))->delete(); 
                     for($i=0;$i<count($_REQUEST['photoid']);$i++){	  
                        
		            $datas['title']   =  handle_specialchars($_REQUEST['title'][$i]);  
		           
                            $datas['picurl']  =  handle_specialchars($_REQUEST['url'][$i]); 
 			   
			    $datas['status']  =  1;
			    $datas['pid']     =  $this->_post('pid');
			    $datas['token']   =  $_SESSION['token'];
			    $datas['create_time'] = time();
			    M('Wcard_list')->data($datas)->add();
                       }		     
                    	 M('Wcard')->data(array('token'=>$_SESSION['token'],'id'=>$this->_post('pid'),'num'=>$i))->save(); 
			 
                         $this->success('操作成功','/index.php?g=User&m=Wcard&a=index');			
		}else{
			$data=M('Wcard_list');
			$count      = $data->where(array('token'=>$_SESSION['token'],'pid'=>$this->_get('id')))->count();
			$Page       = new Page($count,12);
			$show       = $Page->show();
			$list = $data->where(array('token'=>$_SESSION['token'],'pid'=>$this->_get('id')))->order('sort asc')->select();	
			$this->assign('page',$show);
			$this->assign('pid',$this->_get('id'));
			$this->assign('photo',$list);
			$this->display();	
		
		}
		 	
		
		
	}
	
	public function del(){
	 
		
		$check=M('Wcard')->field('id')->where(array('token'=>$_SESSION['token'],'id'=>$this->_get('id')))->find();
		if($check==false){ $this->error('服务器繁忙,请稍后再试');exit;}
		if(empty($_POST['edit'])){
			if(M('Wcard')->where(array('id'=>$check['id']))->delete()){
				M('Wcard_list')->where(array('pid'=>$check['id']))->delete();
				M('Keyword')->where(array('pid'=>$id,'token'=>session('token'),'module'=>'Wcard'))->delete();
			
				 $this->success('操作成功');
				 
			}else{
			        
				 $this->error('服务器繁忙,请稍后再试');
			}
			exit;
		}
	
	}
	
	public function md(){
	 
		$type  = $this->_get('type');
		$token = $this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		$info=M('Wcard')->where(array('token'=>$token,'id'=>$this->_get('id')))->find();
		$wcard_list=M('Wcard_zf')->where(array('token'=>$token,'pid'=>$this->_get('id'),'flag'=>$type))->select();
		//dump($wcard);
		 
		$this->assign('info',$info);
		$this->assign('wcard',$wcard_list);
		$this->assign('type',$type);
		if( $type==1) $this->display('md');	
		if( $type==2) $this->display('zf');	
        }
	
}



?>