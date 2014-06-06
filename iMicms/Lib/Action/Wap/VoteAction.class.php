<?php
class VoteAction extends BaseAction{
	public function index(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"Mobile")) {
			//  echo '此功能只能在微信、易信浏览器中使用';exit;
		}
		$token		= $this->_get('token');
		$wecha_id	= $this->_get('wecha_id');
		$id 		= $this->_get('id');
		$redata		= M('Vote_record');
		$where 		= array('token'=>$token,'wecha_id'=>$wecha_id,'pid'=>$id);
		$record 	= $redata->where($where)->find();
		 
		
		$Vote 	= M('Vote')->where(array('id'=>$id,'token'=>$token))->find();
		
		 
		$Votevalue 	= M('Vote_value')->where(array('pid'=>$id))->order('sort asc')->select();
		$total = M('Vote_value')->field('sum(num) as total')->where(array('pid'=>$id))->select();
		//1.活动过期,显示结束
		  
		//4.显示奖项,说明,时间
		
		$this->assign('Total',$total[0]['total']); 
		$this->assign('Vote',$Vote); 
		$this->assign('gtoken',$token); 
		$this->assign('wecha_id',$wecha_id);
		$this->assign('list',$Votevalue); 
		$this->assign('record',$record);
		if ($Vote['enddate'] < time() || $record) {
			 
			
			 $this->display('over');
			 exit();
		}
		$this->display();
	}
	
        public function upsave(){
	       
	              if(IS_POST){
		      
		       $datas['votes']      = $_POST['ids'];
		      
		       $datas['pid']        = $this->_post('pid');
		       $datas['token']      = $this->_post('token');
		       $datas['wecha_id']   = $this->_post('wecha_id');
		       $where               = "id IN (".$datas['votes']."0)";
		       
		       $datas['votetime']   = time();
		       
		       $User = D('Vote_value'); 
                       $User->where($where)->setInc("num",1); 
		       $result = M('Vote_record')->where($datas)->find();
		   
		    
		       M('Vote_record')->data($datas)->add();
		      
		       echo 0;	 
		       exit;
		 
		}
		 
	}
	 
	
}
	
?>