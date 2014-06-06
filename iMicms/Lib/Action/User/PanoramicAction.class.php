<?php
class PanoramicAction extends UserAction
{
    public function _initialize()
    {
        parent::_initialize();
        $token_open = M('token_open')->field('queryname')->where(array(
            'token' => session('token')
        ))->find();
        if (!strpos($token_open['queryname'], 'Panoramic')) {
            $this->error('您还开启该模块的使用权,请到功能模块中添加', U('Function/adlist', array(
                'token' => session('token'),
                'id' => session('wxid')
            )));
        }
		if(session('gid')==1){
			$this->error('vip0无法使用全景相册活动,请充值后再使用',U('Home/Index/price'));
		}
		$this->assign('count',M('Panoramic')->where(array('token'=>session('token')))->count());
        $this->assign('activityname', "全景相册");
        $this->assign('modulename', "Panoramic");
    }

    public function index()
    {
		$user=M('Users')->field('gid,activitynum')->where(array('id'=>session('uid')))->find();
		$group=M('User_group')->where(array('id'=>$user['gid']))->find();
		$this->assign('group',$group);
		$this->assign('activitynum',$user['activitynum']);
        $db             = D('Panoramic');
        $where['token'] = session('token');
        $count          = $db->where($where)->count();
        $page           = new Page($count, 25);
        $info           = $db->where($where)->order('sort ASC')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('page', $page->show());
        $this->assign('list', $info);
        $this->display();
    }
	
    public function add()
    {
		$user=M('Users')->field('gid,activitynum')->where(array('id'=>session('uid')))->find();
		$group=M('User_group')->where(array('id'=>$user['gid']))->find();
		if($user['activitynum']>=$group['activitynum']){
			$this->error('您的免费活动创建数已经全部使用完,请充值后再使用',U('Home/Index/price'));
		}
        if (IS_POST) {
            $data           = D('Panoramic');
            $_POST['token'] = session('token');
            if ($data->create() != false) {
                if ($id = $data->add()) {
                    $da['pid']     = $id;
                    $da['module']  = 'Panoramic';
                    $da['token']   = session('token');
                    $da['keyword'] = $_POST['keyword'];
                    M('Keyword')->add($da);
					$user=M('Users')->where(array('id'=>session('uid')))->setInc('activitynum');
                    $this->success('添加成功', U('Panoramic/index'));
                } else {
                    $this->error('服务器繁忙,请稍候再试');
                }
            } else {
                $this->error($data->getError());
            }
        } else {
            $this->display();
        }
    }
	
    public function edit()
    {
        if (IS_POST) {
            $data           = D('Panoramic');
            $_POST['id']    = $this->_get('id');
            $_POST['token'] = session('token');
            $where          = array(
                'id' => $_POST['id'],
                'token' => $_POST['token']
            );
            $check          = $data->where($where)->find();
            if ($check == false)
                $this->error('非法操作');
            if ($data->create()) {
                if ($id = $data->where($where)->save($_POST)) {
                    $wh['pid']     = $_POST['id'];
                    $wh['module']  = 'Panoramic';
                    $wh['token']   = session('token');
                    $da['keyword'] = $_POST['keyword'];
                    M('Keyword')->where($wh)->save($da);
                    $this->success('修改成功', U('Panoramic/index'));
                } else {
                    $this->error('操作失败');
                }
            } else {
                $this->error($data->getError());
            }
        } else {
            $id    = $this->_get('id');
            $where = array(
                'id' => $id,
                'token' => session('token')
            );
            $data  = M('Panoramic');
            $check = $data->where($where)->find();
            if ($check == false)
                $this->error('非法操作');
            $info = $data->where($where)->find();
            $this->assign('set', $info);
            $this->display();
        }
    }
    
    public function delete()
    {
        $id    = $this->_get('id');
        $where = array(
            'id' => $id,
            'token' => session('token')
        );
        $data  = M('Panoramic');
        $check = $data->where($where)->find();
        if ($check == false)
            $this->error('非法操作');
        $back = $data->where($wehre)->delete();
        if ($back == true) {
            M('Keyword')->where(array(
                'pid' => $id,
                'token' => session('token'),
                'module' => 'Panoramic'
            ))->delete();
            $this->success('删除成功');
        } else {
            $this->error('操作失败');
        }
    }
}
?>