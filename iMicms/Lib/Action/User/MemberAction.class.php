<?php
class MemberAction extends UserAction
{
    public function index()
    {
        $sql           = M('Member');
        $data['token'] = $this->_get('token');
        $data['uid']   = session('uid');
        $member        = $sql->field('homepic')->where($data)->find();
        $this->assign('member', $member);
        $list = M('Userinfo')->where(array(
            'token' => $data['token']
        ))->select();
        foreach ($list as $key => $li) {
            if (empty($li['add_expend_time'])) {
                $li['add_expend_time'] = time();
            }
            $list[$key] = $li;
        }
        if (IS_POST) {
            $key = $this->_post('searchkey');
            if (empty($key)) {
                exit("关键词不能为空.");
            }
            $map['token']         = $this->get('token');
            $map['tel|wechaname'] = array(
                'like',
                "%$key%"
            );
            $list                 = M('Userinfo')->where($map)->select();
            
            
        }
        $this->assign('list', $list);
        $tbsign = M('Member_card_sign')->where(array(
            'token' => $data['token']
        ))->select();
        $this->assign('tbsign', $tbsign);
        $this->display();
    }
	
    public function add()
    {
        $sql            = M('Member');
        $data['token']  = $this->_get('token');
        $data['uid']    = session('uid');
        $member         = $sql->field('id')->where($data)->find();
        $pic['homepic'] = $this->_post('homepic');
        if ($member != false) {
            $back = $sql->where($data)->save($pic);
            if ($back) {
                $this->success('更新成功');
            } else {
                $this->error('服务器繁忙，请稍后再试1');
            }
        } else {
            $data['homepic'] = $pic['homepic'];
            $back            = $sql->add($data);
            if ($back) {
                $this->success('更新成功');
            } else {
                $this->error('服务器繁忙，请稍后再试');
            }
        }
    }
	
    public function del()
    {
        $data['token'] = $this->_get('token');
        $data['id']    = $this->_get('id');
        $da            = M('Userinfo')->field('wecha_id')->where(array(
            'token' => $data['token'],
            'id' => $data['id']
        ))->find();
        $back          = M('Userinfo')->where($data)->delete();
        if ($back) {
            M('Member_card_create')->where(array(
                'wecha_id' => $da['wecha_id']
            ))->delete();
            M('Member_card_sign')->where(array(
                'wecha_id' => $da['wecha_id']
            ))->delete();
            $this->success('操作成功');
        } else {
            $this->error('服务器繁忙，请稍候再试');
        }
    }
    
    //------------------------------------------
    // 添加消费积分记录
    //------------------------------------------
    public function edit()
    {
        if (!IS_POST) {
            $this->error('没有提交任何东西');
            exit;
        }
        
        $token           = $this->_post('token');
        $wecha_id        = $this->_post('wecha_id');
        $add_expend      = (int) $this->_post('add_expend');
        $add_expend_time = $this->_post('add_expend_time');
        if ($add_expend <= 0) {
            $this->error('消费金额必须大于0元');
            exit;
        }
        $exchange = M('Member_card_exchange');
        $getset   = $exchange->where(array(
            'token' => $token
        ))->find();
        $userinfo = M('Userinfo')->where(array(
            'token' => $token,
            'wecha_id' => $wecha_id
        ))->find();
        
        $data['token']        = $token;
        $data['wecha_id']     = $wecha_id;
        $data['sign_time']    = strtotime($add_expend_time);
        $data['score_type']   = 2;
        $data['expense']      = ceil($add_expend * $getset['reward']);
        $data['sell_expense'] = $add_expend; //消费金额
        $back                 = M('Member_card_sign')->data($data)->add();
        
        //总记录
        $da['total_score']     = $userinfo['total_score'] + $data['expense'];
        $da['expend_score']    = $userinfo['expend_score'] + $data['expense'];
        $da['add_expend']      = $add_expend;
        $da['add_expend_time'] = strtotime($add_expend_time);
        $back2                 = M('Userinfo')->where(array(
            'token' => $token,
            'wecha_id' => $wecha_id
        ))->save($da);
        if ($back && $back2) {
            $this->success('操作成功');
        } else {
            $this->error('服务器繁忙，请稍候再试');
        }
    }
    
    public function changepoints()
    {
        if (!IS_POST) {
            $this->error('没有提交任何东西');
            exit;
        }
        
        $token                = $this->_post('token');
        $wecha_id             = $this->_post('wecha_id');
        $change_score         = (int) $this->_post('change_score');
        $change_score_time    = $this->_post('change_score_time');
        $exchange             = M('Member_card_exchange');
        $userinfo             = M('Userinfo')->where(array(
            'token' => $token,
            'wecha_id' => $wecha_id
        ))->find();
        $data['token']        = $token;
        $data['wecha_id']     = $wecha_id;
        $data['sign_time']    = strtotime($change_score_time);
        $data['score_type']   = 3;
        $data['changepoints'] = $change_score;
        $data['sell_expense'] = 0;
        $back                 = M('Member_card_sign')->data($data)->add();
        
        //总记录
        $da['total_score']       = $userinfo['total_score'] + $data['changepoints'];
        $da['change_score']      = $userinfo['change_score'] + $data['changepoints'];
        $da['change_score_time'] = strtotime($change_score_time);
        $daback                  = M('Userinfo')->where(array(
            'token' => $token,
            'wecha_id' => $wecha_id
        ))->save($da);
        if ($back && $daback) {
            $this->success('操作成功');
        } else {
            $this->error('服务器繁忙，请稍候再试');
        }
    }
}
?>