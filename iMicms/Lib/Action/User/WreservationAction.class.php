<?php

/**
 *	微预约
 */
class WreservationAction extends UserAction{
	public function index(){
		$db=D(MODULE_NAME);
		$where['uid']=session('uid');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('sorts asc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}

	public function add(){
		$class=M('Classify')->where(array('token'=>session('token')))->select();
		if($class==false){$this->error('请先添加3G网站分类',U('Classify/index',array('token'=>session('token'))));}
		$this->display();
	}

	public function edit(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		$res=D(MODULE_NAME)->where($where)->find();
		$this->assign('res',$res);
		$this->display();
	}

	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		if(D(MODULE_NAME)->where($where)->delete()){
			D('Keyword')->where(array('pid'=>$where['id'],'token'=>session('token'),'module'=>MODULE_NAME))->delete();
			$this->success('操作成功',U(MODULE_NAME.'/index'));
		}
		else {
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}

	public function insert(){
		// $pat = "/<(\/?)(script|i?frame|style|html|body|title|font|strong|span|div|marquee|link|meta|\?|\%)([^>]*?)>/isU";
		$pat = "/<(\/?)(script|i?frame|\?|\%)([^>]*?)>/isU";
		$_POST['info'] = preg_replace($pat,"",$_POST['info']);

		if(!$_POST['allowdeadline']){
			$_POST['deadline']='0000-00-00';
		}

        $db = D(MODULE_NAME);
        if ($db->create() === false) {
            $this->error($db->getError());
        }
        else {
            $id = $db->add();
            if ($id) {
                $data['pid'] = $id;
                $data['module'] = MODULE_NAME;
                $data['token'] = session('token');
                $data['keyword'] = $_POST['keyword'];
                M('Keyword')->add($data);
                $this->success('操作成功', U(MODULE_NAME . "/index"));
            } else {
                $this->error('操作失败', U(MODULE_NAME . "/index"));
            }
        }

	}

	public function upsave(){
		$pat = "/<(\/?)(script|i?frame|style|html|body|title|font|strong|span|div|marquee|link|meta|\?|\%)([^>]*?)>/isU";
		$_POST['info'] = preg_replace($pat,"",$_POST['info']);
		if($_FILES['upfile']['name']){
			$img = $this->_upload();
			$_POST['pic'] = C('site_url')."/".str_replace("./","",$img[0]['savepath'].$img[0]['savename']);
		}

		if(!$_POST['allowdeadline']){
			$_POST['deadline']='0000-00-00';
		}

        $db   = D(MODULE_NAME);
        if ($db->create() === false) {
            $this->error($db->getError());
        } else {
            $id = $db->save();
            if ($id) {
                $data['pid']    = $this->_POST('id','trim');
                $data['module'] = MODULE_NAME;
                $data['token']  = session('token');
                $da['keyword']  = $_POST['keyword'];
                M('Keyword')->where($data)->save($da);
                $this->success('操作成功 >>'.$data['pid'], U(MODULE_NAME . "/index"));
            } 
            else {
                $this->error('操作失败', U(MODULE_NAME . "/index"));
            }
        }

	}

	public function record(){
		$pr = C('DB_PREFIX');

		$token=session('token');
		$wid=(int)$this->_get('wid','trim',-1);
		if($wid<0){
			echo "没有项目";exit();
		}

		$db_wr = D(MODULE_NAME);
		$where_wr["id"] = $wid;
		$where_wr["token"] = $token;
		$rs_wr = $db_wr->find($where_wr);
		if($rs_wr){
			$where_list["wid"] = $wid;

			$db_list = D("wreservation_list");

			$count=$db_list->where($where_list)->count();
			$page=new Page($count,25);
			// $db_list->alias("list");
			// $db_list->where($where_list);
			// $db_list->join('LEFT JOIN '.$pr.'wechat_group_list as wechat ON list.wechatid=wechat.openid');
			// $db_list->field('list.*,wechat.nickname,wechat.sex,wechat.province,wechat.city');
			// $db_list->limit($page->firstRow.','.$page->listRows);
			// $info_list = $db_list->select();
			
			/* 140909 */
			$db_list->where($where_list);
			$db_list->limit($page->firstRow.','.$page->listRows);
			$info_list = $db_list->select();

			$this->assign('page',$page->show());
			$this->assign('info',$info_list);
			$this->display();

		}
		else{
			echo "没有项目";exit();
		}
	}

	public function start(){
		$id = (int)$this->_get('id','trim',"-1");
		$status = (int)$this->_get('status','trim',"0");
		if($id>0){
			$where['id'] = $id;
			$data['status'] = $status;
			D('Wreservation')->where($where)->save($data);
			$rsarr=array('errno'=>0,'msg'=>'修改成功!');
			echo json_encode($rsarr);
			exit();
		}
		$rsarr=array('errno'=>1,'msg'=>'缺少参数!');
		echo json_encode($rsarr);
		exit();
	}

}
?>