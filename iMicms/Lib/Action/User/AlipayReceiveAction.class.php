<?php
class AlipayReceiveAction extends BaseAction{
    public $user;
    protected function _initialize(){
        $users = M('Users') -> where(array('id' => intval($_GET['uid']))) -> find();
        $this -> user = $users;
    }
    public function index(){
        if (C('agent_version')){
            $group = M('User_group') -> field('id,name,price') -> where('price>0 AND agentid=' . $this -> agentid) -> select();
        }else{
            $group = M('User_group') -> field('id,name,price') -> where('price>0') -> select();
        }
        $user = M('User_group') -> field('price') -> where(array('id' => session('gid'))) -> find();
        $this -> assign('group', $group);
        $this -> assign('user', $user);
        $this -> display();
    }
    public function post(){
        if($this -> _get('price') == false || $this -> _get('uname') == false)$this -> error('价格和用户名必须填写');
        import("@.ORG.Alipay.AlipaySubmit");
        $payment_type = "1";
        $notify_url = C('site_url') . U('User/Alipay/notify');
        $return_url = C('site_url') . U('User/Alipay/return_url', array('uid' => intval($_GET['uid'])));
        $seller_email = trim(C('alipay_name'));
        $out_trade_no = $this -> _get('uid') . '_' . time();
        $subject = '充值vip' . $this -> _get('group') . '会员' . $this -> _get('num') . '个月';
        $total_fee = (int)$this -> _get('price');
        $body = 'vip高级会员服务费';
        $show_url = C('site_url') . U('Home/Index/price');
        $anti_phishing_key = "";
        $exter_invoke_ip = "";
        $body = $subject;
        $data = M('Indent') -> data(array('uid' => intval($_GET['uid']), 'month' => intval($this -> _get('num')), 'title' => $subject, 'uname' => $this -> _get('uname'), 'gid' => $this -> _get('groupid'), 'create_time' => time(), 'indent_id' => $out_trade_no, 'price' => $total_fee)) -> add();
        $show_url = rtrim(C('site_url'), '/');
        $parameter = array("service" => "create_direct_pay_by_user", "partner" => trim(C('alipay_pid')), "payment_type" => $payment_type, "notify_url" => $notify_url, "return_url" => $return_url, "seller_email" => $seller_email, "out_trade_no" => $out_trade_no, "subject" => $subject, "total_fee" => $total_fee, "body" => $body, "show_url" => $show_url, "anti_phishing_key" => $anti_phishing_key, "exter_invoke_ip" => $exter_invoke_ip, "_input_charset" => trim(strtolower('utf-8')));
        $alipaySubmit = new AlipaySubmit($this -> setconfig());
        $html_text = $alipaySubmit -> buildRequestForm($parameter, "get", "确认");
        echo $html_text;
    }
    public function setconfig(){
        $alipay_config['partner'] = trim(C('alipay_pid'));
        $alipay_config['key'] = trim(C('alipay_key'));
        $alipay_config['sign_type'] = strtoupper('MD5');
        $alipay_config['input_charset'] = strtolower('utf-8');
        $alipay_config['cacert'] = getcwd() . '\\PigCms\\Lib\\ORG\\Alipay\\cacert.pem';
        $alipay_config['transport'] = 'http';
        return $alipay_config;
    }
    public function add(){
        $this -> index();
    }
    public function return_url (){
        import("@.ORG.Alipay.AlipayNotify");
        $alipayNotify = new AlipayNotify($this -> setconfig());
        $verify_result = $alipayNotify -> verifyReturn();
        if($verify_result){
            $out_trade_no = $this -> _get('out_trade_no');
            $trade_no = $this -> _get('trade_no');
            $trade_status = $this -> _get('trade_status');
            if($this -> _get('trade_status') == 'TRADE_FINISHED' || $this -> _get('trade_status') == 'TRADE_SUCCESS'){
                $indent = M('Indent') -> where(array('indent_id' => $out_trade_no)) -> find();
                if($indent != false){
                    if($indent['status'] == 1){
                        $this -> error('该订单已经处理过,请勿重复操作');
                    }
                    M('Users') -> where(array('id' => $indent['uid'])) -> setInc('money', intval($indent['price']));
                    M('Users') -> where(array('id' => $indent['uid'])) -> setInc('moneybalance', intval($indent['price']));
                    $back = M('Indent') -> where(array('id' => $indent['id'])) -> setField('status', 1);
                    if($back != false){
                        $month = intval($indent['month']);
                        $groupid = intval($indent['gid']);
                        $thisGroup = M('User_group') -> where(array('id' => $groupid)) -> find();
                        $needFee = intval($thisGroup['price']) * $month;
                        $moneyBalance = $this -> user['moneybalance'] + $indent['price'];
                        if ($needFee < $moneyBalance){
                            $users_db = D('Users');
                            $users_db -> where(array('id' => $indent['uid'])) -> save(array('viptime' => $this -> user['viptime'] + $month * 30 * 24 * 3600, 'status' => 1, 'gid' => $indent['gid']));
                            $gid = $indent['gid'] + 1;
                            $functions = M('Function') -> where('gid<' . $gid) -> select();
                            $str = '';
                            if ($functions){
                                $comma = '';
                                foreach ($functions as $f){
                                    $str .= $comma . $f['funname'];
                                    $comma = ',';
                                }
                            }
                            $token_open_db = M('Token_open');
                            $wxusers = M('Wxuser') -> where(array('uid' => $indent['uid'])) -> select();
                            if ($wxusers){
                                foreach ($wxusers as $wxu){
                                    $token_open_db -> where(array('token' => $wxu['token'])) -> save(array('queryname' => $str));
                                }
                            }
                            $spend = 0 - $needFee;
                            M('Indent') -> data(array('uid' => $this -> user['id'], 'month' => $month, 'title' => '购买服务', 'uname' => $this -> user['username'], 'gid' => $groupid, 'create_time' => time(), 'indent_id' => $indent['id'], 'price' => $spend, 'status' => 1)) -> add();
                            M('Users') -> where(array('id' => $indent['uid'])) -> setDec('moneybalance', intval($needFee));
                            $this -> success('充值成功并购买成功', 'http://demo.pigcms.cn/index.php?g=User&m=Index&a=index');
                        }else{
                            $this -> success('充值成功但您的余额不足', 'http://demo.pigcms.cn/index.php?g=User&m=Index&a=index');
                        }
                    }else{
                        $this -> error('充值失败,请在线客服,为您处理', 'http://demo.pigcms.cn/index.php?g=User&m=Index&a=index');
                    }
                }else{
                    $this -> error('订单不存在', 'http://demo.pigcms.cn/index.php?g=User&m=Index&a=index');
                }
            }else{
                $this -> error('充值失败，请联系官方客户');
            }
        }else{
            $this -> error('不存在的订单');
        }
    }
    public function notify(){
        import("@.ORG.Alipay.alipay_notify");
        $alipayNotify = new AlipayNotify($this -> setconfig());
        $html_text = $alipaySubmit -> buildRequestHttp($parameter);
    }
}
?>