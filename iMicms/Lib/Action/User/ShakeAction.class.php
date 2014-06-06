<?php
/**
 *互动摇一摇管理 Written by leohoko
**/
class ShakeAction extends UserAction{

	public function index(){
		$db=D('Shake');
		$where['token']=session('token');
		$where['isopen']=2;
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('createtime desc')->limit($page->firstRow.','.$page->listRows)->select();
		$where['isopen']=array('neq',2);
		$actinfo=$db->where($where)->find();
		if($actinfo!==false)
		$this->assign('actinfo',$actinfo);
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	
	public function add(){
	if(IS_POST){ 
	$this->all_insert();
	}else{
		$db=M('Shake');
		$where['token']=session('token');
		$where['isopen']=array('neq',2);
		$exst=$db->where($where)->select();
		if($exst!=false){$this->error('已存在已激活的活动',U('Shake/index',array('token'=>session('token'))));}
		else
		$this->display();
		}
	}
	
	public function change()
	{
			$db=M('Shake');
		$where['token']=session('token');
		
		if ($this->_get('actid','intval')==0){
		$data['isact'] = 0;
		$result1 = $db->where($where)->save($data);
		$data['isopen'] = 1;
		$db1=M('Shake');
		$where['id']=$this->_get('id','intval');
		$where['token']=session('token');
		$result = $db1->where($where)->save($data);
		}elseif($this->_get('actid','intval')==1){
		$data['isopen'] = 0;
		$data['isact'] = 0;
		M('Shakedo')->where(array('token'=>session('token')))->save(array('point'=>'0'));
		M('Shake')->where(array('token'=>session('token'),'id'=>$this->_get('id','intval')))->save(array('isact'=>'0'));
		$result = $db->where($where)->save($data);
		M('Shakedo')->where(array('token'=>session('token')))->delete();
		}
		elseif($this->_get('actid','intval')==2)
		{
			$data['isopen'] = 2;
			$mark='';
			$cc=M('Shakedo')->where(array('token'=>session('token')))->count();
			$topten=M('Shakedo')->where(array('token'=>session('token')))->order('point desc')->select();
			if($topten!==false){
				for($i=0;$i<count($topten);$i++)
				{
					if($i==count($topten)-1)
					$mark.=$topten[$i]['phone'].'+'.$topten[$i]['point'];
					else
					$mark.=$topten[$i]['phone'].'+'.$topten[$i]['point'].',';
				}
				
				}
			$edata=array('aid'=>$this->_get('id','intval'),'token'=>session('token'),'mark'=>$mark,'endtime'=>time(),'joinnum'=>$cc);
			$data['endtime']=time();
			$data['joinnum']=$cc;
			$data['isact']=0;
			M('Shakelog')->add($edata);
			M('Shakedo')->where(array('token'=>session('token')))->delete();
			$result = $db->where($where)->save($data);
		}

		
		if($result!==false){$this->success('修改成功',U('Shake/index',array('token'=>session('token'))));}
		}
	
	public function edit()
	{
	if(IS_POST){ 
	$this->all_save();
	}else{
		$db=M('Shake');
		$where['token']=session('token');
		$where['id']=$this->_get('id','intval');
		$info=$db->where($where)->find();
		$this->assign('info',$info);
		$this->display();
		}
	}
	public function check(){
		$info=M('Shakelog')->where(array('aid'=>$this->_get('id','intval'),'token'=>session('token')))->find();
		$state=M('Shake')->where(array('id'=>$this->_get('id','intval'),'token'=>session('token')))->find();
		$mark=explode(",",$info['mark']);
		foreach($mark as $key=>$value)
		{
			$tmplist=explode('+',$value);
			if($tmplist)
			$point[]=array($key+1,$tmplist[0],$tmplist[1]);		
		}
	   //$point=array_pop($point);
	   $this->assign('state',$state);
	   $this->assign('info',$info);
	   $this->assign('point',$point);
	   $this->display();	
	}
	
	public function insert()
	{
		$this->all_insert();
	}
	public function upsave(){
		$this->all_save();
	}
	public function del()
	{
		$where['id']=$this->_get('id','intval');
		if(D(MODULE_NAME)->where($where)->delete()){
			
			$this->success('操作成功',U(MODULE_NAME.'/index'));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	public function delold(){
	   	$where['id']=$this->_get('id','intval');
		$a=M('shake')->where($where)->delete();
		$b=M('shakelog')->where(array('aid'=>$this->_get('id','intval')))->delete();
		if($a && $b){
			
			$this->success('操作成功',U('Shake'.'/index'));
		}else{
			$this->error('操作失败',U('Shake'.'/index'));
		}
	}
	public function initgame(){
		echo $_POST["token"];
		M('Shakedo')->where(array('token'=>session('token')))->delete();
		M('Shake')->where(array('token'=>session('token'),'isopen'=>'1'))->save(array('isact'=>'0'));
		
	}
	public function show()
	{
		$db=M('Shake');
		$where['token']=session('token');
		$where['isopen']='1';
		$info=$db->where($where)->find();
		$this->assign('info',$info);
		$this->display();
	}
	public function startgame(){
		$result=M('Shake')->where(array('token'=>$this->_post('token')))->save(array('isact'=>'1'));
	}
	public function sentpoint(){
		$result=M('Shakedo')->field('phone,point')->where(array('token'=>$this->_post('token')))->order('point desc')->limit('0,9')->select();
		$json_string=json_encode($result);
		echo $json_string;	
	}
	public function getman(){
		$result=M('Shakedo')->where(array('token'=>$this->_post('token')))->count();
		echo $result;
		}
	
	
}
?>