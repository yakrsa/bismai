<?php
class HomeAction extends UserAction{
	//配置
	public function set(){
		$home=M('Home')->where(array('token'=>session('token')))->find();
		if(!$farword) $farword=$_POST['farword'];
		 // print_r($_POST);exit;
		if(IS_POST){
			if($home==false){				
				$this->all_insert('Home','/set');
			}else{
				$_POST['id']=$home['id'];
				if($_POST['play_img']==NULL)
				{
  				       $_POST['play_img']="off";
				}
                                else 	
                                {
                                $_POST['play_img']="on";
                                }				
				if($_POST['play_audio']==NULL){
				$_POST['play_audio']="off";
		             	 }
				 else 	
                                {
                                $_POST['play_audio']="on";
                                }
				$this->all_save('Home','/set');				
			}
		}else{
		        $this->assign('TOKEN',session('token'));
			$this->assign('home',$home);
			$this->display();
		}
	}
	
}



?>