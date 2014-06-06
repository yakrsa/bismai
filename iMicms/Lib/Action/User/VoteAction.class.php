<?php
class VoteAction extends UserAction{

	public function index(){
	          $data['token']= $datas['token']= $_SESSION['token'];
		  $vtype = array("1"=>"文本投票","2"=>"图文投票");
                  $db =D('Vote');
		  $list=$db->where($data)->order('id desc')->select(); 
		  $this->assign('vtype',$vtype);
                  $this->assign('list',$list);		  
		  
		  $this->display();
	}
 
	public function add(){
	          
	          $datas =array();
		  $data  =array();
		  $data['token']= $_SESSION['token'];
                  $db = M('Vote');
		
		  
		  if(IS_POST){
		         $data['qstime']       = $this->_post('time','trim');   
			 $ts = explode("-",$data['qstime']);
			 $data['statdate']     = strtotime(trim($ts[0]));
			 $data['enddate']      = strtotime(trim($ts[1]));
			 $data['vpicurl']      = $this->_post('vpicurl','trim');
			 $data['title']        = $this->_post('title','trim');
			 $data['keyword']      = $this->_post('keyword','trim');
			 $data['pic_show']     = $this->_post('pic_show','intval');
			 $data['instructions'] = $this->_post('instructions','trim');
			 $data['is_radio']     = $this->_post('is_radio','intval');
			 $data['select_num']   = $this->_post('select_num','intval');
			 $data['result']       = $this->_post('result','intval');
			 $data['type']         = $this->_post('type','intval');
			 
			 $data['createtime']   = $data['updatetime'] = time();
			 
			 if($data)
			 {
			 $datas['pid']=$db->data($data)->add();
			 
			 if($datas['pid']){
					$datae['pid']     = $datas['pid'];
					$datae['module']  = "Vote";
					$datae['token']   = session('token');
					$datae['keyword'] = $data['keyword'];
					M('Keyword')->data($datae)->add();
				}
			 }
			 
		      if($_REQUEST['vtitle'] && $datas['pid']){
          	         for($i=0;$i<count($_REQUEST['vtitle']);$i++){	  
                           
		            $datas['vtitle']  = handle_specialchars($_REQUEST['vtitle'][$i]);  
		            $datas['sort']    =  handle_specialchars($_REQUEST['sort'][$i]);
                            $datas['picurl']  =  handle_specialchars($_REQUEST['picurl'][$i]); 
 			    $datas['piclink'] =  handle_specialchars($_REQUEST['piclink'][$i]);
           	            if($datas) M('Vote_value')->data($datas)->add();
		          }
		        }
			 
			 
			$this->success('操作成功','/index.php?g=User&m=Vote&a=index'); 
			 
		  }else{
		        // true是文字投票 fa是图文投票
			$id=$this->_get('id','intval');
			$type=$this->_get('type','intval');
			if($type==1) $this->assign('ty',"true");
			if($type==2) $this->assign('ty',"false");
			$this->assign('id',$id);
			$this->assign('type',$type);
			$this->display();
		  } 
	}
	 
	public function edit(){	          
	          $datas =array();
		  $data  =array();
		  $data['id']    = $datas['pid'] =  $this->_get('id','intval');
		  $data['token'] = $_SESSION['token'];
		  $vstatus = M('Vote')->where(array('token'=>session('token'),'id'=>$this->_get('id'),'status'=>1))->find();
		  $estatus = M('Vote')->where(array('token'=>session('token'),'id'=>$this->_get('id'),'status'=>4))->find();
		 
		  if($vstatus)  $this->error('投票已经开始了，不能操作！'); 
		  if($estatus)  $this->error('投票已经结束了，不能操作！'); 
                  $db = M('Vote'); 
		  
		  if(IS_POST){
		         $data['qstime']       = $this->_post('time','trim'); 
                         $ts = explode("-",$data['qstime']);
			 $data['statdate']     = strtotime(trim($ts[0]));
			 $data['enddate']      = strtotime(trim($ts[1]));			 
			 $data['vpicurl']      = $this->_post('vpicurl','trim');
			 $data['title']        = $this->_post('title','trim');
			 $data['keyword']      = $this->_post('keyword','trim');
			 $data['pic_show']     = $this->_post('pic_show','intval');
			 $data['instructions'] = $this->_post('instructions','trim');
			 $data['is_radio']     = $this->_post('is_radio','intval');
			 $data['select_num']   = $this->_post('select_num','intval');
			 $data['result']       = $this->_post('result','intval');
			 $data['updatetime']   = time();
			 
			 if($data)
                                 {			 
				   $db->data($data)->save();
				        $datak['pid']    = $this->_get('id','intval');
					$datak['module'] = "Vote";
					$da['keyword']   = $this->_post('keyword','trim');
				        M('Keyword')->where($datak)->save($da);
				        M('Vote_value')->where(array('pid'=>$this->_get('id')))->delete();
				 }   
			 
			 if($_REQUEST['vtitle'] && $datas['pid']){
          	         for($i=0;$i<count($_REQUEST['vtitle']);$i++){	  
                           
		            $datas['vtitle'] = handle_specialchars($_REQUEST['vtitle'][$i]);  
		            $datas['sort'] =  handle_specialchars($_REQUEST['sort'][$i]);
                            $datas['picurl'] =  handle_specialchars($_REQUEST['picurl'][$i]); 
 			    $datas['piclink'] =  handle_specialchars($_REQUEST['piclink'][$i]);
           	            if($datas) M('Vote_value')->data($datas)->add();
		          }
		        }
			  
			 
			 
			 
			 $this->success('操作成功','/index.php?g=User&m=Vote&a=index'); 
		  }else{
		        $list=$db->where($data)->find();   
			$vlist=M('Vote_value')->where($datas)->order('sort asc')->select(); 
			
			$id=$this->_get('id','intval');
			$type=$this->_get('type','intval');
			if($type==1) $this->assign('ty',"true");
			if($type==2) $this->assign('ty',"false");
			$this->assign('id',$id);
			$this->assign('type',$type);
			$this->assign('info',$list);
			$this->assign('vlist',$vlist);
			$this->display();
		  } 
		  
	}
	
	public function  del(){	
			$back=M('Vote')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->delete();
			if($back==true){
			        M('Vote_value')->where(array('pid'=>$this->_get('id'),'token'=>session('token')))->delete();
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		 
		
		
	}
	
	public function DelVoteBatch(){
		$ids =$this->_post('ids');
		if(!$ids)  $this->error('数据错误');
		$ids .=0; 
		
		if($ids) $ids = str_replace("on,","",$ids);
		$where['token']= session('token');
		$token = session('token');
		if($ids)
         		{
			$where = "token='$token' AND id IN ($ids)";
			$wheres = "pid IN ($ids)";
			}
		 
		 
		if(D('Vote')->where($where)->delete()){
		        M('Vote_value')->where($wheres)->delete();
				
			M('Keyword')->where($wheres)->delete();
			echo 0;
		}else{
			echo 1;
		}
	}
	public function  start(){
                         $data['token']    = session('token');
			 $data['id']       = $this->_get('id');
			 $data['status']   = 1;
               	        
			$back=M('Vote')->data($data)->save();
			if($back==true){
			        $this->success('开启成功');
			}else{
				 $this->error('开启失败');
			}
		 
		
		
	}
	
	public function  end(){
                         $data['token']    = session('token');
			 $data['id']       = $this->_get('id');
			 $data['status']   = 4;
               	        
			$back=M('Vote')->data($data)->save();
			if($back==true){
			        $this->success('结束投票成功');
			}else{
				 $this->error('结束投票失败');
			}
		 
		
		
	}
	
	public function search(){
		$keyword         = $this->_post('keywords');
		 
		$data['token']   = session('token'); 
		if($keyword) $data['keyword'] = $keyword;
		// dump($data); 
		$list=M('Vote')->where($data)->order('id desc')->select(); 
		$this->assign('list',$list);
		$this->display('index');
	
	}
	
	public function result(){
	        $data['id']    = $datas['pid']  = $this->_get('id');
		 
		$data['token']   = session('token'); 
	        $vlist = M('Vote')->where($data)->find();
		 
		$total = M('Vote_value')->field('sum(num) as total')->where($datas)->select();
		
                $bar = array("1"=>"progress-danger","2"=>"progress-info","3"=>"progress-striped","4"=>"progress-success",
                             "5"=>"progress-danger","6"=>"progress-info","7"=>"progress-striped","8"=>"progress-success",
                             "9"=>"progress-danger","10"=>"progress-info","11"=>"progress-striped","12"=>"progress-success",
                             "13"=>"progress-danger","14"=>"progress-info","15"=>"progress-striped","16"=>"progress-success",
                             "17"=>"progress-danger","18"=>"progress-info","19"=>"progress-striped","20"=>"progress-success");  			     
		 
		$list = M('Vote_value')->where($datas)->select(); 
		
		$this->assign('Total',$total[0]['total']);
		$this->assign('list',$list);
		$this->assign('bar',$bar);
		$this->assign('info',$vlist);
		$this->display();
	}


}



?>