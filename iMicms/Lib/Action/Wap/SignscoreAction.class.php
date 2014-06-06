<?php
/**
 * 会员签到
 *
 */
class SignscoreAction extends BaseAction
{
    public function index()
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (!strpos($agent, "MicroMessenger")) {
            echo '此功能只能在微信浏览器中使用';
            exit;
        }
        
        $token    = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $cardsign = M('Member_card_sign');
        $where    = array(
            'token' => $token,
            'wecha_id' => $wecha_id,
            'score_type' => 1
        );
        $sign     = $cardsign->where($where)->order('sign_time desc')->find();
        $today    = date('Y-m-d', time());
        $itoday   = date('Y-m-d', $sign['sign_time']);
        
		/*
        if ($sign == null) {
            $cardsign->add($where);
            $sign = $cardsign->where($where)->order('id desc')->find();
        }
        */
		
        $get_card = M('member_card_create')->where(array(
            'wecha_id' => $wecha_id
        ))->find();
        if (empty($get_card)) {
            header("Location: " . C('site_url') . U('Wap/Card/get_card', array(
                'token' => $this->_get('token'),
                'wecha_id' => $this->_get('wecha_id')
            )));
            exit('领卡后才可以签到.');
        }
        $set_exchange = M('Member_card_exchange')->where(array(
            'token' => $token
        ))->find();
        if (empty($set_exchange)) {
            exit("该商家尚未设置该功能.");
        }
        
        if (IS_POST && $today != $itoday) {
            //总积分 = 签到总积分 + 消费总积分 和 连续签到计数器
            //iMicro_member_card_sign   会员签到表
            //iMicro_member_card_exchange   商家后台积分设置
            $whereinfo = array(
                'token' => $token,
                'wecha_id' => $wecha_id
            );
            $userinfo  = M('Userinfo')->where($whereinfo)->find();
            
            //检查 计数器是否等于 6 天，够了就增加 预设好的积分
            if ($userinfo['continuous'] == 6) {
                //先添加今天签到积分 22 分
                $data['expense']   = $set_exchange['everyday'] + $set_exchange['continuation'];
                $data['is_sign']   = 1;
                $data['score_type']   = 10;
                $data['sign_time'] = time();
                $data['token']      = $token;
                $data['wecha_id']   = $wecha_id;
                $cardsign->data($data)->add($data);
                //签到总积分 = 原签到总积分 + 今天签到积分；
                //总积分 = 原总积分 + 今天签到积分；
                $da['sign_score']  = $userinfo['sign_score'] + $data['expense'];
                $da['total_score'] = $userinfo['total_score'] + $data['expense'];
                $da['continuous']  = 0; //清空计数器
                M('Userinfo')->where($whereinfo)->save($da);
                $signined = 1;
            } else {
                //是否是连续签到，如果不是，清空计数器
				//strcmp(date('Y-m-d',$sign['sign_time']), date("Y-m-d",time())) == 0;
				$is_con = strcmp(date('Y-m-d',$sign['sign_time']), date("Y-m-d",strtotime("-1 day")));
                if ($is_con != 0) { //判断签到时间是否为昨天
                    $da['continuous'] = 0; //清零计数器，继续签到
                    M('Userinfo')->where($whereinfo)->save($da);
                    
                    $data['sign_time']  = time();
                    $data['is_sign']    = 1;
                    $data['score_type'] = 1;
                    $data['token']      = $token;
                    $data['wecha_id']   = $wecha_id;
                    $data['expense']    = $set_exchange['everyday'];
                    
                    //$cardsign->where($where)->save($data);
                    $cardsign->data($data)->add();
                    $da['total_score'] = $userinfo['total_score'] + $data['expense'];
                    $da['sign_score']  = $userinfo['sign_score'] + $data['expense'];
                    $da['continuous']  = 1;
                    M('Userinfo')->where($whereinfo)->save($da);
                    $signined = 1;
                } else {
                    //连续签到
                    $data['sign_time']  = time();
                    $data['is_sign']    = 1;
                    $data['score_type'] = 1;
                    $data['token']      = $token;
                    $data['wecha_id']   = $wecha_id;
                    $data['expense']    = $set_exchange['everyday'];
                    $cardsign->data($data)->add();
                    
                    $da['total_score'] = $userinfo['total_score'] + $data['expense'];
                    $da['sign_score']  = $userinfo['sign_score'] + $data['expense'];
                    $da['continuous']  = $userinfo['continuous'] + 1;
                    M('Userinfo')->where($whereinfo)->save($da);
                    $signined = 1;
                }
            }
        } else {
            $today  = date('Y-m-d', time());
            $itoday = date('Y-m-d', $sign['sign_time']);
            if ($itoday == $today) {
                $signined = 1;
            }
        }
        
        $cardset     = M('Member_card_set')->where(array(
            'token' => $token
        ))->find();
        $exchangeset = M('Member_card_exchange')->where(array(
            'token' => $token
        ))->find();
        $sign        = $cardsign->where($where)->order('sign_time desc')->limit(6)->select();
        $userinfo    = M('Userinfo')->where(array(
            'token' => $token,
            'wecha_id' => $wecha_id
        ))->find();
        $this->assign('userinfo', $userinfo);
        $this->assign('sign', $sign);
        $this->assign('signined', $signined);
        $cardset['continuation'] = $set_exchange['continuation'];
        $this->assign('cardset', $cardset);
        $this->assign('exchangeset', $exchangeset);
        $this->display();
    }
    
    //-----------------------------------
    //  消费记录 
    //-----------------------------------
    public function expend()
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (!strpos($agent, "MicroMessenger")) {
            echo '此功能只能在微信浏览器中使用';
            exit;
        }
        
        $token    = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $cardsign = M('Member_card_sign');
        $where    = array(
            'token' => $token,
            'wecha_id' => $wecha_id,
            'score_type' => 2
        );
        
        $cardset  = M('Member_card_set')->where(array(
            'token' => $token
        ))->find(); //获取banner的logo
        $sign     = $cardsign->where($where)->order('sign_time')->limit(6)->select(); //消费积分
		
        $change   = $cardsign->where(array(
            'token' => $token,
            'wecha_id' => $wecha_id,
			'score_type' => 3
        ))->order('sign_time')->limit(6)->select(); //积分变更
		
        $userinfo = M('Userinfo')->where(array(
            'token' => $token,
            'wecha_id' => $wecha_id
        ))->find(); //获取总积分,签到积分,签到天数
        
        $this->assign('userinfo', $userinfo);
        $this->assign('sign', $sign);
        $this->assign('change', $change);
        $this->assign('signined', $signined);
        $this->assign('cardset', $cardset);
        
        $this->display();
    }
    
}
?>