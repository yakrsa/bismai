<?php

class LoginAction extends Action{
    public function index(){
        if(IS_POST){
            $userName = $this -> _post('userName', 'htmlspecialchars');
            $data['userPwd'] = $this -> _post('userPwd', 'md5');
            if($userName == false || $data['userPwd'] == false){
                $this -> error('帐号必须填写');
            }
            if((!strpos($userName, '@') === FALSE)){
                $user = explode('@', $userName);
                $data['name'] = $user[0];
                $data['token'] = $user[1];
                if($data['name'] == false || $data['token'] == false){
                    $this -> error('帐号格式不正确');
                }
            }else{
                $this -> error('帐号格式错误');
            }
            $back = D('service_user') -> where($data) ->select();
            if($back != false){
                session('userId', $back[0]['id']);
                session('name', $back[0]['name']);
                session('token', $data['token']);
                session('userName', $back[0]['userName']);
                $this -> success('登陆成功', U('Index/index'));
            }else{
                $this -> error('您的登陆信息错误
请核实后再登陆');
            }
        }else{
            $this -> display();
        }
    }
}
?>
