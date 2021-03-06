<?php
class NdiskAction extends UserAction{
	public function index(){ 
		$data=M('Ndisk');
		$count      = $data->where(array('token'=>$_SESSION['token']))->count();
		$Page       = new Page($count,12);
		$show       = $Page->show();
		$list = $data->where(array('token'=>$_SESSION['token']))->limit($Page->firstRow.','.$Page->listRows)->select();	
		//dump($list);exit;
		$this->assign('page',$show);		
		$this->assign('photo',$list);
		$this->display();		
	}
	
	public function set(){		
		
		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		//dump($token_open);
		if(!strpos($token_open['queryname'],'adma')){$this->error('您还开启该模块的使用权,请到功能模块中添加',U('Function/fclist',array('token'=>session('token'),'id'=>session('wxid'))));}
		//网盘列表
		$db=M('Users');
		if(IS_POST){ 
		$datas['id']         = $this->_post('id','intval'); 
		 
		$data['photo_head']  = $this->_post('head_url','trim'); 
		 
		 
		$db->where($datas)->save($data); 
		$this->success('操作成功');
		}
		else {
		
		$info =$db->find(session('wxid')); 
		 
		$this->assign('uid',session('wxid')); 	
		$this->assign('info',$info);
		$this->display();
                }		
	}
	
	
	public function headset(){		
		if(IS_POST){ 
		 
		$datas['id']         = $this->_post('id','intval'); 
		$datas['id']         = session('wxid'); 
		$data['photo_head']  = $this->_post('url','trim'); 
		 
		 
		M('Users')->where($datas)->save($data); 
		}		
	}
	public function edit(){
		//if($this->_get('token')!=session('token')){$this->error('非法操作');}
		$data=D('Ndisk');
		if(IS_POST){
		     
			$this->all_save('Ndisk');
		}else{
			$photo=$data->where(array('token'=>session('token'),'id'=>$this->_get('id')))->find();
			if($photo==false){
				$this->error('网盘不存在');
			}else{
				$this->assign('photo',$photo);
			}
			$this->display();		
		
		}
	}
	public function list_edit(){
	        $pid = $this->_post('pid');
		 
		if($this->_get('token')!=session('token')){$this->error('非法操作');}
		$check=M('Ndisk_list')->field('id,pid')->where(array('token'=>$_SESSION['token'],'id'=>$this->_post('id')))->find();
		if($check==false){$this->error('照片不存在');}
		if(IS_POST){
			$this->all_save('Ndisk_list',$pid);		//'Ndisk_list','/list_add/'.$pid
		}else{
			$this->error('非法操作');
		}
	}
	public function list_del(){
		if($this->_get('token')!=session('token')){$this->error('非法操作');}
		$check=M('Ndisk_list')->field('id,pid')->where(array('token'=>$_SESSION['token'],'id'=>$this->_get('id')))->find();
		if($check==false){$this->error('服务器繁忙');}
		if(empty($_POST['edit'])){
			if(M('Ndisk_list')->where(array('id'=>$check['id']))->delete()){
				M('Ndisk')->where(array('id'=>$check['pid']))->setDec('num');
				$this->success('操作成功');
			}else{
				$this->error('服务器繁忙,请稍后再试');
			}
		}
	}
	public function list_add(){
		
		$checkdata=M('Ndisk')->where(array('token'=>$_SESSION['token'],'pid'=>$this->_get('pid')))->find();
		if($checkdata==false){$this->error('网盘不存在');}
		if(IS_POST){			
			M('Ndisk')->where(array('token'=>session('token'),'id'=>$this->_post('pid')))->setInc('num');
			$this->all_insert('Ndisk_list');			
		}else{
			$data=M('Ndisk_list');
			$count      = $data->where(array('token'=>$_SESSION['token'],'pid'=>$this->_get('pid')))->count();
			$Page       = new Page($count,12);
			$show       = $Page->show();
			$list = $data->where(array('token'=>$_SESSION['token'],'pid'=>$this->_get('id')))->order('sort desc')->limit($Page->firstRow.','.$Page->listRows)->select();	
			$this->assign('page',$show);		
			$this->assign('photo',$list);
			$this->display();	
		
		}
		
	}
	public function add(){
		if(IS_POST){	
                        	
			$this->all_insert('Ndisk','/index.php?g=User&m=Ndisk&a=index');			
		}else{
			$this->display();	
		
		}
		
	}
	
	public function upload(){
	       
                $checkdata=M('Ndisk')->where(array('token'=>$_SESSION['token'],'pid'=>$this->_get('pid')))->find();
		if($checkdata==false){$this->error('网盘不存在');exit;}
		if(IS_POST){
                     M('Ndisk_list')->where(array('token'=>$_SESSION['token'],'pid'=>$this->_post('pid')))->delete(); 
                     for($i=0;$i<count($_REQUEST['photoid']);$i++){	  
                        
		            $datas['title']   =  handle_specialchars($_REQUEST['title'][$i]);  
		            $datas['sort']    =  handle_specialchars($_REQUEST['sort'][$i]);
                            $datas['picurl']  =  handle_specialchars($_REQUEST['url'][$i]); 
 			    $datas['info']    =  handle_specialchars($_REQUEST['description'][$i]);
			    $datas['status']  =  1;
			    $datas['pid']     =  $this->_post('pid');
			    $datas['token']   =  $_SESSION['token'];
			    $datas['create_time'] = time();
			    M('Ndisk_list')->data($datas)->add();
                       }		     
                    	 M('Ndisk')->data(array('token'=>$_SESSION['token'],'id'=>$this->_post('pid'),'num'=>$i))->save(); 
			 
                         $this->success('操作成功','/index.php?g=User&m=Ndisk&a=index');			
		}else{
			$data=M('Ndisk_list');
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
		 
		$check=M('Ndisk')->field('id')->where(array('token'=>$_SESSION['token'],'id'=>$this->_get('id')))->find();
		if($check==false){echo 2;exit;}
		if(empty($_POST['edit'])){
			if(M('Ndisk')->where(array('id'=>$check['id']))->delete()){
				M('Ndisk_list')->where(array('pid'=>$check['id']))->delete();
				// $this->success('操作成功');
				echo 1;
			}else{
			        echo 2;
				//$this->error('服务器繁忙,请稍后再试');
			}
			exit;
		}
	
	}


}


?>