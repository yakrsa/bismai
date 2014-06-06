<?php

class ServiceUserAction extends UserAction{
    public $token;
    private $data;
    private $openid;
    public function _initialize(){
        parent :: _initialize();
        $this -> openid = $this -> _get('openid', 'htmlspecialchars');
        if($this -> openid == false){
        }
        $this -> token = session('token');
        $this -> data = D('Service_user');
    }
    public function index(){
        $wehre['token'] = session('token');
		$where = array('token' => session('token'));
        $count = $this -> data -> where($where) -> count();
        $page = new Page($count, 25);
        $list = $this -> data -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
        $this -> assign('page', $page -> show());
        $this -> assign('list', $list);
        $this -> assign('type', 'list');
        $this -> display();
    }
    public function add(){
        if(IS_POST){
            $db = D("Service_user");
            if($db -> create() === false){
                $this -> error($db -> getError());
            }else{
                $id = $db -> add();
                if($id == true){
                    M('Users') -> where(array('id' => session('uid'),'token'=>session('token'))) -> setInc('serviceUserNum');
                    $this -> success('操作成功',U('ServiceUser/index',array('token'=>session('token'))));
                }else{
                    $this -> error('操作失败',U('ServiceUser/add',array('token'=>session('token'))));
                }
            }
        }else{
            $this -> display();
        }
    }
    public function edit(){
        if(IS_POST){
            if(empty($_POST['userPwd'])){
                unset($_POST['userPwd']);
            }
            $_POST['id'] = $this -> _get('id', 'intval');
            $this -> all_save('Service_user', '/index');
        }else{
            $where['id'] = $this -> _get('id', 'intval');
            $where['session'] = session('session');
            $info = M('ServiceUser') -> where($where) -> find();
            $this -> assign('serviceUser', $info);
            $this -> display('add');
        }
    }
    public function chat_log(){
        $data = M('service_logs');
        $wehre['token'] = session('token');
		$where = array('token' => session('token'));//判断按token查询
        $count = $data -> where($where) -> count();
        $page = new Page($count, 25);
        $list = $data -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
        foreach($list as $key => $vo){
            $list[$key]['name'] = D('Service_user') -> getServiceUser($vo['pid']);
        }
        $this -> assign('page', $page -> show());
        $this -> assign('list', $list);
        $this -> assign('type', 'list');
        $this -> display();
    }
    public function del (){
		if(M('Service_user')->where(array('id'=>$_GET['id']))->delete()){
			//M('Ordering_list')->where(array('pid'=>$check['id']))->delete();
			$this->success('操作成功');
		}else{
			$this->error('服务器繁忙,请稍后再试');
		}	
    }
    public function chat_log_del (){
        $this -> del_id('service_logs', 'Service/chat_log');
    }
}
?>