<?php

class ChatAction extends Action{
    public function _initialize(){
cookie('test',"test_".session('name'));
        if(session('userName') == false){
            $this -> error('您必须登陆后才能操作,请重新登录', U('Login/index'));
        }
    }
}
?>
