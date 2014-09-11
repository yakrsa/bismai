<?php
class WeixinAction extends Action
{
    private $token;
    private $fun;
    private $data = array();
    private $my = '比斯迈';
    
    public function index()
    {
        $this->token = $this->_get('token');
        $this->my    = C('site_my');
#        Log::record('weixinmsg',Log::DEBUG);
 #       Log::record('weixinmsg',$this->token,Log::DEBUG);
  #      Log::save();
   #     $this->siteName = C('site_name');
        $weixin      = new Wechat($this->token);
        //$data = $weixin->request();
        //$this->xml = $weixin->xml;
        $this->data  = $weixin->request();
        //是否是在上墙中
        if ($this->data) {
            $data  = $this->data;
            $users = S($data['FromUserName'] . 'wxq');
            if ($users != false) {
                $res = $this->wxq($users);
            } else {
                $res = $this->reply($data);
            }
            list($content, $type) = $res;
            $weixin->response($content, $type);
        }
    }
    
    private function reply($data)
    {
#	Log::write(json_encode($data)); 
	M('Wxuser_message')->add($data);
        
        //if($data['Location_X']){
        
        
        //return $this->map($data['Location_X'],$data['Location_Y']);
        //}
        if ('CLICK' == $data['Event']) {
            $data['Content'] = $data['EventKey'];
        }
        if ('voice' == $data['MsgType']) {
            $data['Content']       = $data['Recognition'];
            $this->data['Content'] = $data['Recognition'];
        }
        if ($data['Event'] == 'SCAN') {
            $data['Content']       = $this->getRecognition($data['EventKey']);
            $this->data['Content'] = $data['Content'];
        }
        
        if ('subscribe' == $data['Event']) {
            $this->requestdata('follownum');
            $data = M('Areply')->field('home,keyword,content')->where(array('token' => $this->token))->find();
            if ($data['keyword'] == '首页' || $data['keyword'] == 'home') {
                return $this->shouye();
            }
            if ($data['keyword'] == '微活动' || $data['keyword'] == 'Wreservation') {
                return $this->Wreservation();
            }
   
            
            if ($data['home'] == 1) {
                //	$like['keyword']=array('like','%'.$data['keyword'].'%');
                $like['keyword'] = array(
                    'eq',
                    $data['keyword']
                );
                $like['token']   = $this->token;
                $back            = M('Img')->field('id,text,pic,url,title')->limit(9)->order('id desc')->where($like)->select();
                foreach ($back as $keya => $infot) {
                    if ($infot['url'] != false) {
                        if (stristr($infot['url'], '?')) {
                            $url = (strip_tags(htmlspecialchars_decode($infot['url'])) . '&iMicms=mp.weixin.qq.com');
                        } else {
                            $url = $infot['url'] . '?iMicms=mp.weixin.qq.com';
                        }
                    } else {
                        $url = rtrim(C('site_url'), '/') . U('Wap/Index/content', array(
                            'token' => $this->token,
                            'id' => $infot['id'],
                            'wecha_id' => $this->data['FromUserName'],
                            'iMicms' => 'mp.weixin.qq.com'
                        ));
                    }
                    
                    if (stristr($infot['pic'], "http:"))
                        $purl = $infot['pic'];
                    else
                        $purl = rtrim(C('site_url'), '/') . $infot['pic'];
                    
                    $return[] = array(
                        $infot['title'],
                        $infot['text'],
                        $purl,
                        $url
                    );
                }
                
                return array(
                    $return,
                    'news'
                );
            } else {
                return array(
                    strip_tags(htmlspecialchars_decode($data['content'])),
                    'text'
                );
            }
        }
        //取消关注时
        elseif ('unsubscribe' == $data['Event']) {
            $this->requestdata('unfollownum');
        }
        $Pin = new GetPin();
        if (substr($data['Content'], 0, 3) == "yyy") {
            $key      = "摇一摇";
            $yyyphone = substr($data['Content'], 3, 11);
        } else
            $key = $data['Content'];

        $open = M('Token_open')->where(array('token' => $this->_get('token')))->find();
        $this->fun = $open['queryname'];
        $datafun   = explode(',', $open['queryname']);
        
        $tags = $this->get_tags($key);
        $back = explode(',', $tags);
        foreach ($back as $keydata => $data) {
            $string = $Pin->Pinyin($data);
            
            if (in_array($string, $datafun)) {
                $check = $this->user('connectnum');
                
                if ($string == 'fujin') {
                    $this->recordLastRequest($key);
                }
                $this->requestdata('textnum');
                if ($check['connectnum'] != 1) {
                    $return = C('connectout');
                    continue;
                }
                unset($back[$keydata]);
                eval('$return= $this->' . $string . '($back);');
                continue;
            }
        }
        if (!empty($return)) {
            if (is_array($return)) {
                return $return;
            } else {
                return array(
                    $return,
                    'text'
                );
            }
        } else {
            if ($this->data['Location_X']) {
                $this->recordLastRequest($this->data['Location_Y'] . ',' . $this->data['Location_X'], 'location');
                return $this->map($this->data['Location_X'], $this->data['Location_Y']);
            }
            if (!(strpos($key, '开车去') === FALSE) || !(strpos($key, '坐公交') === FALSE) || !(strpos($key, '步行去') === FALSE)) {
                $this->recordLastRequest($key);
                $user_request_model = M('User_request');
                $loctionInfo        = $user_request_model->where(array(
                    'token' => $this->_get('token'),
                    'msgtype' => 'location',
                    'uid' => $this->data['FromUserName']
                ))->find();
                if ($loctionInfo && intval($loctionInfo['time'] > (time() - 60))) {
                    $latLng = explode(',', $loctionInfo['keyword']);
                    return $this->map($latLng[1], $latLng[0]);
                }
                return array(
                    '请发送您所在的位置',
                    'text'
                );
            }
            
            switch ($key) {
                case '首页':
                    return $this->home();
                    break;
                case '主页':
                    return $this->home();
                    break;
                case '微网站':
                    return $this->home();
                    break;
                case '3G':
                    return $this->home();
                    break;
                case '3g':
                    return $this->home();
                    break;
                case '微官网':
                    return $this->home();
                    break;
                case '地图':
                    return $this->companyMap();
                case '最近的':
                    $this->recordLastRequest($key);
                    $user_request_model = M('User_request');
                    $loctionInfo        = $user_request_model->where(array(
                        'token' => $this->_get('token'),
                        'msgtype' => 'location',
                        'uid' => $this->data['FromUserName']
                    ))->find();
                    if ($loctionInfo && intval($loctionInfo['time'] > (time() - 60))) {
                        $latLng = explode(',', $loctionInfo['keyword']);
                        return $this->map($latLng[1], $latLng[0]);
                    }
                    return array(
                        '请发送您所在的位置',
                        'text'
                    );
                    break;
                case '帮助':
                    return $this->help();
                    break;
                case 'help':
                    return $this->help();
                    break;
                case '会员卡':
                    return $this->member();
                    break;
                case '会员':
                    return $this->member();
                    break;                
                default:
                    $check = $this->user('diynum');
                    if ($check['diynum'] != 1) {
                        return array(
                            C('connectout'),
                            'text'
                        );
                    }
                    return $this->keyword($key);
            }
        }
    }
    
    function companyMap()
    {
        import("Home.Action.MapAction");
        $mapAction = new MapAction();
        return $mapAction->staticCompanyMap();
    }
    /*
    function shenhe($name){	
    $name=implode('',$name);		
    if(empty($name)){
    return '正确的审核帐号方式是：审核+帐号';
    }else{			
    $user=M('Users')->field('id')->where(array('username'=>$name))->find();
    if($user==false){
    return $this->my."提醒您,您还没注册吧\n正确的审核帐号方式是：审核+帐号,不含+号";
    }else{
    $viptimes = time()+7*86400;
    $up=M('users')->where(array('id'=>$user['id']))->save(array('status'=>1,'gid'=>4,'viptime'=>$viptimes));
    if($up!=false){
    return $this->my.'恭喜您,您的帐号已经审核,您现在可以登陆平台试用7天!';
    }else{
    return '服务器繁忙请稍后再试';
    }
    }
    }
    }
    */
    function huiyuanka($name)
    {
        return $this->member();
    }
    function member()
    {
        $card          = M('member_card_create')->where(array(
            'token' => $this->token,
            'wecha_id' => $this->data['FromUserName']
        ))->find();
        $cardInfo      = M('member_card_set')->where(array(
            'token' => $this->token
        ))->find();
        //$this -> behaviordata('Member_card_set', $cardInfo['id']);
        $reply_info_db = M('Reply_info');
        if ($card) {
            $where_member = array(
                'token' => $this->token,
                'infotype' => 'membercard'
            );
            $memberConfig = $reply_info_db->where($where_member)->find();
            if (!$memberConfig) {
                $memberConfig           = array();
                $memberConfig['picurl'] = rtrim(C('site_url'), '/') . '/tpl/static/images/vip.jpg';
                $memberConfig['title']  = '会员卡,省钱，打折,促销，优先知道,有奖励哦';
                $memberConfig['info']   = '尊贵vip，是您消费身份的体现,会员卡,省钱，打折,促销，优先知道,有奖励哦';
            }
            $data['picurl']  = $memberConfig['picurl'];
            $data['title']   = $memberConfig['title'];
            $data['keyword'] = $memberConfig['info'];
            if (!$memberConfig['apiurl']) {
                $data['url'] = rtrim(C('site_url'), '/') . U('Wap/Card/index', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName']
                ));
            } else {
                $data['url'] = str_replace('{wechat_id}', $this->data['FromUserName'], $memberConfig['apiurl']);
            }
        } else {
            $where_unmember = array(
                'token' => $this->token,
                'infotype' => 'membercard_nouse'
            );
            $unmemberConfig = $reply_info_db->where($where_unmember)->find();
            if (!$unmemberConfig) {
                $unmemberConfig           = array();
                $unmemberConfig['picurl'] = rtrim(C('site_url'), '/') . '/tpl/static/images/member.jpg';
                $unmemberConfig['title']  = '申请成为会员';
                $unmemberConfig['info']   = '申请成为会员，享受更多优惠';
            }
            $data['picurl']  = $unmemberConfig['picurl'];
            $data['title']   = $unmemberConfig['title'];
            $data['keyword'] = $unmemberConfig['info'];
            if (!$unmemberConfig['apiurl']) {
                $data['url'] = rtrim(C('site_url'), '/') . U('Wap/Card/index', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName']
                ));
            } else {
                $data['url'] = str_replace('{wechat_id}', $this->data['FromUserName'], $unmemberConfig['apiurl']);
            }
        }
        return array(
            array(
                array(
                    $data['title'],
                    $data['keyword'],
                    $data['picurl'],
                    $data['url']
                )
            ),
            'news'
        );
    }
    
    function keyword($key)
    {
        #		$like['keyword']=array('like','%'.$key.'%');
        Log::write($key);
        $like['keyword'] = array(
            'eq',
            $key
        );
        $like['token']   = $this->token;
        $data = M('keyword')->where($like)->order('id desc')->find();
        if ($data != false) {
            switch ($data['module']) {
                case 'Img':
                    $this->requestdata('imgnum');
                    $img_db   = M($data['module']);
                    $back     = $img_db->field('id,text,pic,url,title')->limit(9)->order('sorts desc')->where($like)->select();
                    $idsWhere = 'id in (';
                    $comma    = '';
                    foreach ($back as $keya => $infot) {
                        $idsWhere .= $comma . $infot['id'];
                        $comma = ',';
                        if ($infot['url'] != false) {
                            $url = $this->convertLinks(htmlspecialchars_decode($infot['url']));
                        } else {
                            $url = rtrim(C('site_url'), '/') . U('Wap/Index/content', array(
                                'token' => $this->token,
                                'id' => $infot['id'],
                                'wecha_id' => $this->data['FromUserName']
                            )) . '#mp.weixin.qq.com';
                        }
                        $return[] = array(
                            $infot['title'],
                            $infot['text'],
                            $infot['pic'],
                            $url
                        );
                    }
                    $idsWhere .= ')';
                    if ($back) {
                        $img_db->where($idsWhere)->setInc('click');
                    }
                    return array(
                        $return,
                        'news'
                    );
                    break;
                
                case 'Wxq':
                    $this->requestdata('other');
                    return $this->wxqLogin($data['pid']);
                    break;
                case 'Host':
                    $this->requestdata('other');
                    $host = M('Host')->where(array(
                        'id' => $data['pid']
                    ))->find();
                    return array(
                        array(
                            array(
                                $host['name'],
                                $host['info'],
                                $host['ppicurl'],
                                C('site_url') . '/index.php?g=Wap&m=Host&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $data['pid'] . '&iMicms=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    
                    break;
                case 'Wreservation':
                    $this->requestdata('other');
                    $back = M('Wreservation')->limit(9)->order('sorts desc')->where($like)->select();
                    $ids = array();
                    foreach ($back as $keya => $infot) {
                    	$ids[] = $infot['id'];
                        $url = rtrim(C('site_url'), '/') . U('Wap/Wreservation/index', array(
                            'token' => $this->token,
                            'id' => $infot['id'],
                            'wecha_id' => $this->data['FromUserName'],
                            'from' => 'event'
                        ));
                        $return[] = array(
                            $infot['title'],
                            $infot['text'],
                            $infot['pic'],
                            $url
                        );
                    }
                    $idsWhere = array('in',$ids);
                    if ($back) {
                        M('Wreservation')->where($idsWhere)->setInc('click');
                    }
                    
                    return array(
                        $return,
                        'news'
                    );
                    break;
                
                
                case 'Text':
                    $this->requestdata('textnum');
                    $info = M($data['module'])->order('id desc')->find($data['pid']);
                    return array(
                        htmlspecialchars_decode(str_replace('{wechat_id}', $this->data['FromUserName'], $info['text'])),
                        'text'
                    );
                    break;
                
                case 'Wcard':
                    $this->requestdata('textnum');
                    $back = D('Wcard')->field('id,coverurl,picurl,title,word')->limit(1)->order('id desc')->where(array(
                        'token' => $this->token
                    ))->select();
                    
                    foreach ($back as $keya => $infot) {
                        
                        $url = rtrim(C('site_url'), '/') . U('Wap/Wcard/index', array(
                            'token' => $this->token,
                            'id' => $infot['id'],
                            'hid' => $infot['id'],
                            'wecha_id' => $this->data['FromUserName'],
                            'iMicms' => 'mp.weixin.qq.com'
                        ));
                        if (stristr($infot['coverurl'], "http:"))
                            $purl = $infot['coverurl'];
                        else
                            $purl = rtrim(C('site_url'), '/') . $infot['coverurl'];
                        $return[] = array(
                            $infot['title'],
                            $infot['word'],
                            $purl,
                            $url
                        );
                        $urlmd    = rtrim(C('site_url'), '/') . U('Wap/Wcard/webmd', array(
                            'token' => $this->token,
                            'id' => $infot['id'],
                            'hid' => $infot['id'],
                            'wecha_id' => $this->data['FromUserName'],
                            'type' => 1,
                            'iMicms' => 'mp.weixin.qq.com'
                        ));
                        $urlzf    = rtrim(C('site_url'), '/') . U('Wap/Wcard/webmd', array(
                            'token' => $this->token,
                            'id' => $infot['id'],
                            'hid' => $infot['id'],
                            'wecha_id' => $this->data['FromUserName'],
                            'type' => 2,
                            'iMicms' => 'mp.weixin.qq.com'
                        ));
                        
                    }
                    $return[] = array(
                        '查看赴宴名单',
                        '',
                        '',
                        $urlmd
                    );
                    $return[] = array(
                        '查看祝福名单',
                        '',
                        '',
                        $urlzf
                    );
                    return array(
                        $return,
                        'news'
                    );
                    
                    break;
                case 'Product':
                    $this->requestdata('textnum');
                    $pro = M('Product')->where(array(
                        'id' => $data['pid']
                    ))->find();
                    return array(
                        array(
                            array(
                                $pro['name'],
                                strip_tags(htmlspecialchars_decode($pro['intro'])),
                                $pro['logourl'],
                                C('site_url') . '/index.php?g=Wap&m=Product&a=product&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&id=' . $data['pid'] . '&iMicms=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                case 'Selfform':
                    $this->requestdata('textnum');
                    $pro = M('Selfform')->where(array(
                        'id' => $data['pid']
                    ))->find();
                    return array(
                        array(
                            array(
                                $pro['name'],
                                strip_tags(htmlspecialchars_decode($pro['intro'])),
                                $pro['logourl'],
                                C('site_url') . '/index.php?g=Wap&m=Selfform&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&id=' . $data['pid'] . '&iMicms=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;               
                default:
                    $this->requestdata('videonum');
                    $info = M($data['module'])->order('id desc')->find($data['pid']);
                    return array(
                        array(
                            $info['title'],
                            $info['keyword'],
                            $info['musicurl'],
                            $info['hqmusicurl']
                        ),
                        'music'
                    );
            }
        } else {
            if (!strpos($this->fun, 'liaotian')) {
                $other = M('Other')->where(array(
                    'token' => $this->token
                ))->find();
                if ($other == false) {
                    return array(
                        '回复帮助，可了解所有功能',
                        'text'
                    );
                } else {
                    if (empty($other['keyword'])) {
                        return array(
                            $other['info'],
                            'text'
                        );
                    } else {
                        if ($other['keyword'] == '首页' || $other['keyword'] == 'home' || $other['keyword'] == '微站') {
                            return $this->shouye();
                        }
                        
                        $img = M('Img')->field('id,text,pic,url,title')->limit(5)->order('id desc')->where(array(
                            'token' => $this->token,
                            'keyword' => array(
                                'like',
                                '%' . $other['keyword'] . '%'
                            )
                        ))->select();
                        if ($img == false) {
                            return array(
                                '您好！我们已收到到您回复的信息，感谢参与。',
                                'text'
                            );
                        }
                        foreach ($img as $keya => $infot) {
                            if ($infot['url'] != false) {
                                $url = $this->convertLinks($infot['url']);
                            } else {
                                $url = rtrim(C('site_url'), '/') . U('Wap/Index/content', array(
                                    'token' => $this->token,
                                    'id' => $infot['id'],
                                    'wecha_id' => $this->data['FromUserName']
                                ));
                            }
                            $return[] = array(
                                $infot['title'],
                                $infot['text'],
                                $infot['pic'],
                                $url . '#mp.weixin.qq.com'
                            );
                        }
                        return array(
                            $return,
                            'news'
                        );
                    }
                }
            }
            $this->selectService();
            return array(
                $this->chat($key),
                'text'
            );
        }
    }
    
    
    private function getFuncLink($u)
    {
        $urlInfos = explode(' ', $u);
        switch ($urlInfos[0]) {
            default:
                $url = str_replace(array(
                    '{wechat_id}',
                    '{siteUrl}',
                    '&amp;'
                ), array(
                    $this->data['FromUserName'],
                    C('site_url'),
                    '&'
                ), $urlInfos[0]);
                break;
            
            case '商家订单':
                $url = C('site_url') . '/index.php?g=Wap&m=Host&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&hid=' . $urlInfos[1] . '&iMicms=mp.weixin.qq.com';
                break;
            case '优惠券':
                $Lottery = M('Lottery')->where(array(
                    'token' => $this->token,
                    'type' => 3,
                    'status' => 1
                ))->order('id DESC')->find();
                $url     = C('site_url') . U('Wap/Coupon/index', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName'],
                    'id' => $Lottery['id']
                ));
                break;
            
            case '会员卡':
                $url = C('site_url') . U('Wap/Card/vip', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName']
                ));
                break;
            case '首页':
                $url = rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Index&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'];
                break;
            case '网站分类':
                $url = C('site_url') . U('Wap/Index/lists', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName'],
                    'classid' => $urlInfos[1]
                ));
                break;
            case 'LBS信息':
                if ($urlInfos[1]) {
                    $url = C('site_url') . U('Wap/Company/map', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data['FromUserName'],
                        'companyid' => $urlInfos[1]
                    ));
                } else {
                    $url = C('site_url') . U('Wap/Company/map', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data['FromUserName']
                    ));
                }
                break;
            }
        return $url;
    }
    
    
    function convertLinks($url)
    {
        if ($this->strExists($url, "http://")) {
            if (strpos($url, "?")) {
                $url = $url . "&token=" . $this->token . "&wecha_id=" . $this->data['FromUserName'];
            } else {
                $url = $url . "?token=" . $this->token . "&wecha_id=" . $this->data['FromUserName'];
            }
        } else {
            $url = $this->getLink($url);
        }
        return $url . '#mp.weixin.qq.com';
    }
    function strExists($haystack, $needle)
    {
        return !(strpos($haystack, $needle) === FALSE);
    }
    function home()
    {
        return $this->shouye();
    }
    function shouye($name)
    {
        //if(!strpos($this->fun,'shouye'))return '回复帮助，可了解所有功能';
        $home = M('Home')->where(array(
            'token' => $this->token
        ))->find();
        if ($home == false) {
            return array(
                '商家未做首页配置，请稍后再试',
                'text'
            );
        } else {
            $this->requestdata('3g');
            $imgurl = $home['picurl'];
            if (stristr($imgurl, "http:"))
                $purl = $imgurl;
            else
                $purl = rtrim(C('site_url'), '/') . $imgurl;
            $url = rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Index&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&iMicms=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $home['webname'],
                    $home['info'],
                    $purl,
                    $url
                )
            ),
            'news'
        );
    }
    

    
   
    function kuaidi($data)
    {
        $data = array_merge($data);
        $str  = file_get_contents('http://www.weinxinma.com/api/index.php?m=Express&a=index&name=' . $data[0] . '&number=' . $data[1]);
        return $str;
    }
    function langdu($data)
    {
        $data   = implode('', $data);
        $mp3url = 'http://www.apiwx.com/aaa.php?w=' . urlencode($data);
        return array(
            array(
                $data,
                '点听收听',
                $mp3url,
                $mp3url
            ),
            'music'
        );
    }
    
    
    
    function GetDistance($lat1, $lng1, $lat2, $lng2, $len_type = 1, $decimal = 2)
    {
        $EARTH_RADIUS = 6378.137;
        $PI           = 3.1415926;
        $radLat1      = $lat1 * $PI / 180.0;
        $radLat2      = $lat2 * $PI / 180.0;
        $a            = $radLat1 - $radLat2;
        $b            = ($lng1 * $PI / 180.0) - ($lng2 * $PI / 180.0);
        $s            = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s            = $s * $EARTH_RADIUS;
        $s            = round($s * 1000);
        if ($len_type > 1) {
            $s /= 1000;
        }
        return round($s, $decimal);
    }
    
    function recordLastRequest($key, $msgtype = 'text')
    {
        $rdata              = array();
        $rdata['time']      = time();
        $rdata['token']     = $this->_get('token');
        $rdata['keyword']   = $key;
        $rdata['msgtype']   = $msgtype;
        $rdata['uid']       = $this->data['FromUserName'];
        $user_request_model = M('User_request');
        $user_request_row   = $user_request_model->where(array(
            'token' => $this->_get('token'),
            'msgtype' => $msgtype,
            'uid' => $rdata['uid']
        ))->find();
        if (!$user_request_row) {
            $user_request_model->add($rdata);
        } else {
            $rid['id'] = $user_request_row['id'];
            $user_request_model->where($rid)->save($rdata);
        }
    }
    
   
    
   
    
    public function help()
    {
        $data = M('Areply')->where(array(
            'token' => $this->token
        ))->find();
        return array(
            preg_replace("/(\015\012)|(\015)|(\012)/", "\n", $data['content']),
            'text'
        );
    }
    function error_msg($data)
    {
        return '没有找到' . $data . '相关的数据';
    }
    public function user($action)
    {
        //查询微信号
        $user      = M('Wxuser')->field('uid')->where(array(
            'token' => $this->token
        ))->find();
        $usersdata = M('Users');
        //公共条件
        $dataarray = array(
            'id' => $user['uid']
        );
        //用户信息
        $users     = $usersdata->field('gid,diynum,connectnum,activitynum,viptime')->where(array(
            'id' => $user['uid']
        ))->find();
        //用户组
        $group     = M('User_group')->where(array(
            'id' => $users['gid']
        ))->find();
        if ($users['diynum'] < $group['diynum']) {
            $data['diynum'] = 1;
            if ($action == 'diynum') {
                $usersdata->where($dataarray)->setInc('diynum');
            }
        }
        if ($users['connectnum'] < $group['connectnum']) {
            $data['connectnum'] = 1;
            if ($action == 'connectnum') {
                $usersdata->where($dataarray)->setInc('connectnum');
            }
        }
        if ($users['viptime'] > time()) {
            $data['viptime'] = 1;
        }
        return $data;
    }
    public function requestdata($field)
    {
        $data['year']  = date('Y');
        $data['month'] = date('m');
        $data['day']   = date('d');
        $data['token'] = $this->token;
        $mysql         = M('Requestdata');
        $check         = $mysql->field('id')->where($data)->find();
        if ($check == false) {
            $data['time'] = time();
            $data[$field] = 1;
            $mysql->add($data);
        } else {
            $mysql->where($data)->setInc($field);
        }
    }
    function behaviordata($field, $id = '', $type = '')
    {
        $data['date']    = date('Y-m-d', time());
        $data['token']   = $this->token;
        $data['openid']  = $this->data['FromUserName'];
        $data['keyword'] = $this->data['Content'];
        if (!$data['keyword']) {
            $data['keyword'] = '用户关注';
        }
        $data['model'] = $field;
        if ($id != false) {
            $data['fid'] = $id;
        }
        if ($type != false) {
            $data['type'] = 1;
        }
        $mysql = M('Behavior');
        $check = $mysql->field('id')->where($data)->find();
        $this->updateMemberEndTime($data['openid']);
        if ($check == false) {
            $data['enddate'] = time();
            $mysql->add($data);
        } else {
            $mysql->where($data)->setInc('num');
        }
    }
    function updateMemberEndTime($openid)
    {
        $mysql           = M('Wehcat_member_enddate');
        $id              = $mysql->field('id')->where(array(
            'openid' => $openid
        ))->find();
        $data['enddate'] = time();
        $data['openid']  = $openid;
        $data['token']   = $this->token;
        if ($id == false) {
            $mysql->add($data);
        } else {
            $data['id'] = $id['id'];
            $mysql->save($data);
        }
    }
    function selectService()
    {
        $this->behaviordata('chat', '');
        $time           = time() - (30 * 60);
        $where['token'] = $this->token;
        $serviceUser    = M('Service_user')->field('id')->where('`token` = "' . $this->token . '" and `status` = 0 and `endJoinDate` > ' . $time)->select();
        if ($serviceUser != false) {
            $list = M('wechat_group_list')->field('id')->where(array(
                'openid' => $this->data['FromUserName']
            ))->find();
            if ($list == false) {
                $this->adddUserInfo();
            }
            $serviceJoinDate = M('wehcat_member_enddate')->field('id,uid,joinUpDate')->where(array(
                'token' => $this->token,
                'openid' => $this->data['FromUserName']
            ))->find();
            if ($serviceJoinDate['uid'] == false) {
                foreach ($serviceUser as $key => $users) {
                    $user[] = $users['id'];
                }
                if (count($user) == 1) {
                    $id = $user[0];
                } else {
                    $rand = mt_rand(0, count($user) - 1);
                    $id   = $user[$rand];
                }
                $where['id']  = $serviceJoinDate['id'];
                $where['uid'] = $id;
                M('wehcat_member_enddate')->data($where)->save();
            } else {
                $endtime = 30 * 60;
                $now     = $time - $serviceJoinDate['joinUpDate'];
                if ($now < $endtime) {
                    exit();
                }
            }
        }
    }

    function getRecognition($id)
    {
        $GetDb = D('Recognition');
        $data  = $GetDb->field('keyword')->where(array(
            'id' => $id,
            'status' => 0
        ))->find();
        if ($data != false) {
            $GetDb->where(array(
                'id' => $id
            ))->setInc('attention_num');
            return $data['keyword'];
        } else {
            return false;
        }
    }
    function api_notice_increment($url, $data)
    {
        $ch     = curl_init();
        $header = "Accept-Charset: utf-8";
        if (strpos($url, '?')) {
            $url .= '&token=' . $this->token;
        } else {
            $url .= '?token=' . $this->token;
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if (curl_errno($ch)) {
            return false;
        } else {
            return $tmpInfo;
        }
    }
    
    function httpGetRequest_baike($url)
    {
        $headers = array(
            "User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1",
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
            "Accept-Language: en-us,en;q=0.5",
            "Referer: http://www.baidu.com/"
        );
        $ch      = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch);
        curl_close($ch);
        
        if ($output === FALSE) {
            return "cURL Error: " . curl_error($ch);
        }
        return $output;
    }
    function adddUserInfo()
    {
        $access_token = $this->_getAccessToken();
        $url2         = 'https://api.weixin.qq.com/cgi-bin/user/info?openid=' . $this->data['FromUserName'] . '&access_token=' . $access_token;
        $classData    = json_decode($this->curlGet($url2));
        if ($classData->subscribe == 1) {
            $data['nickname']       = str_replace("'", '', $classData->nickname);
            $data['sex']            = $classData->sex;
            $data['city']           = $classData->city;
            $data['province']       = $classData->province;
            $data['headimgurl']     = $classData->headimgurl;
            $data['subscribe_time'] = $classData->subscribe_time;
            $url3                   = 'https://api.weixin.qq.com/cgi-bin/groups/getid?access_token=' . $access_token;
            $json2                  = json_decode($this->curlGet($url3, 'post', '{"openid":"' . $data['openid'] . '"}'));
            $data['g_id']           = $json->groupid;
            M('wechat_group_list')->data($data)->add();
        }
    }
    function _getAccessToken()
    {
        $where            = array(
            'token' => $this->data['FromUserName']
        );
        $this->thisWxUser = M('Wxuser')->where($where)->find();
        $url_get          = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->thisWxUser['appid'] . '&secret=' . $this->thisWxUser['appsecret'];
        $json             = json_decode($this->curlGet($url_get));
        if (!$json->errmsg) {
        } else {
            $this->error('获取access_token发生错误：错误代码' . $json->errcode . ',微信返回错误信息：' . $json->errmsg);
        }
        return $json->access_token;
    }
    function curlGet($url, $method = 'get', $data = '')
    {
        $ch     = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $temp = curl_exec($ch);
        return $temp;
    }
    public function get_tags($title, $num = 10)
    {
        vendor('Pscws.Pscws4', '', '.class.php');
        $pscws = new PSCWS4();
        $pscws->set_dict(CONF_PATH . 'etc/dict.utf8.xdb');
        $pscws->set_rule(CONF_PATH . 'etc/rules.utf8.ini');
        $pscws->set_ignore(true);
        $pscws->send_text($title);
        $words = $pscws->get_tops($num);
        $pscws->close();
        $tags = array();
        foreach ($words as $val) {
            $tags[] = $val['word'];
        }
        return implode(',', $tags);
    }
    function getLink($url)
    {
        $urlArr       = explode(' ', $url);
        $urlInfoCount = count($urlArr);
        if ($urlInfoCount > 1) {
            $itemid = intval($urlArr[1]);
            $linktk = $urlArr[1];
        }
        if ($this->strExists($url, '优惠券')) {
            if ($itemid) {
                $link = C('site_url') . U('Wap/Coupon/index', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName'],
                    'id' => $itemid
                ));
            } else {
                $link = C('site_url') . U('Wap/Coupon/index', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName']
                ));
            }
        } elseif ($this->strExists($url, '商家订单')) {
            if ($itemid) {
                $link = C('site_url') . U('Wap/Host/index', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName'],
                    'hid' => $itemid
                ));
            } else {
                $link = C('site_url') . U('Wap/Host/index', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName']
                ));
            }
        } elseif ($this->strExists($url, '首页') || $this->strExists($url, '微站') || $this->strExists($url, '3G')) {
            $link = C('site_url') . U('Wap/Index/index', array(
                'token' => $this->token,
                'wecha_id' => $this->data['FromUserName']
            ));
        } elseif ($this->strExists($url, '会员卡')) {
            $card = M('Member_card_create')->where(array(
                'token' => $this->token,
                'wecha_id' => $this->data['FromUserName']
            ))->find();
            if ($card == false) {
                $link = C('site_url') . U('Wap/Card/get_card', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName']
                ));
            } else {
                $link = C('site_url') . U('Wap/Card/vip', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName']
                ));
            }
        }  else {
            $link = $url;
        }
        return $link;
    }
    
}
