<?php
class PanoramicAction extends BaseAction
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('activityname', "全景相册");
        $this->assign('modulename', "Panoramic");
    }
    
    public function index()
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (!strpos($agent, "MicroMessenger")) {
            //echo '此功能只能在微信浏览器中使用';
            //exit;
        }
        $token          = $this->_get('token');
        $id             = $this->_get('id');
        $db             = D('Panoramic');
        $where['token'] = session('token');
        $count          = $db->where($where)->count();
        $page           = new Page($count, 25);
        $info           = $db->where($where)->order('id DESC')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('page', $page->show());
        $this->assign('list', $info);
        $this->display();
        
    }
    
    public function item()
    {
        $token     = $this->_get('token');
        $id        = $this->_get('id');
        $Panoramic = M('Panoramic')->where(array(
            'id' => $id,
            'token' => $token
        ))->find();
        $this->assign('info', $Panoramic);
        $this->assign('token', $token);
        $this->display();
    }
    
    public function xml()
    {
        $token = $this->_get('token');
        $id    = $this->_get('id');
        $info  = M('Panoramic')->where(array(
            'id' => $id,
            'token' => $token
        ))->find();
        $this->assign('info', $info);
        $this->display(str_replace("common", "", RES) . 'Panoramic_xml.html', 'utf-8', 'text/xml');
    }
}
?>