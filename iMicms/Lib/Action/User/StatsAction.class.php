<?php
class StatsAction extends UserAction{

	public function index(){
		$now = time();
		$now_y = date("Y", $now);
		$now_m = date("m", $now);
		$year = ($this->_get('year','intval') != "") ? $this->_get('year','intval') : $now_y;
		$month = ($this->_get('month','intval') != "") ? $this->_get('month','intval') : $now_m;
		$time = array(1,2,3,4,5,6,7,8,9,10,11,12);
		$user_group = D('User_group')->select();
		$users = D('Users')->select();
		$wxuser = D('Wxuser')->select();
		$where['token'] = session('token');
		$where['year'] = $year;
		$where['month'] = $month;
		$db = D('Requestdata');
		$count = $db->where($where)->count();
		$page = new Page($count,31);
		$info = $db->where($where)->order('day desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('time',$time);
		$this->assign('now_y',$year);
		$this->assign('now_m',$month);
		$this->assign('list',$info);
		$this->display();
	}
	
	public function getxmldata(){
		$now = time();
		$now_y = date("Y", $now);
		$now_m = date("m", $now);
		$year = ($this->_get('year','intval') != "") ? $this->_get('year','intval') : $now_y;
		$month = ($this->_get('month','intval') != "") ? $this->_get('month','intval') : $now_m;
		$time = array(1,2,3,4,5,6,7,8,9,10,11,12);
		$user_group = D('User_group')->select();
		$users = D('Users')->select();
		$wxuser = D('Wxuser')->select();
		$where['token'] = session('token');
		$where['year'] = $year;
		$where['month'] = $month;
		$db = D('Requestdata');
		$count = $db->where($where)->count();
		$page = new Page($count,31);
		$info = $db->where($where)->order('day desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('time',$time);
		$this->assign('year',$year);
		$this->assign('month',$month);
		$this->assign('list',$info);
		$this->assign('list3g',$info);
		$this->assign('listtext',$info);
		$this->assign('listimg',$info);
		$this->assign('listvideo',$info);
		$this->assign('listother',$info);
		$this->assign('listfollow',$info);
		$this->assign('listunfollow',$info);
		$this->assign('listall',$info);
		$this->display();
	}
	
	public function getajaxdata(){
		$now = time();
		$now_y = date("Y", $now);
		$now_m = date("m", $now);
		$year = ($this->_get('year','intval') != "") ? $this->_get('year','intval') : $now_y;
		$month = ($this->_get('month','intval') != "") ? $this->_get('month','intval') : $now_m;
		$time = array(1,2,3,4,5,6,7,8,9,10,11,12);
		$user_group = D('User_group')->select();
		$users = D('Users')->select();
		$wxuser = D('Wxuser')->select();
		$where['token'] = session('token');
		$where['year'] = $year;
		$where['month'] = $month;
		$db = D('Requestdata');
		$count = $db->where($where)->count();
		$page = new Page($count,31);
		$info = $db->where($where)->order('day desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('time',$time);
		$this->assign('now_y',$year);
		$this->assign('now_m',$month);
		$this->assign('list',$info);
		$this->display();
	}
}

?>