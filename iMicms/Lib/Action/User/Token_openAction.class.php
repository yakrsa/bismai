<?php
class Token_openAction extends UserAction{
        //配置
	public function _initialize() {
		parent::_initialize();
		$openwhere=array('uid'=>session('uid'),'token'=>session('token'));
		$open=M('Token_open')->where($openwhere)->find();
                if(!$open){
 		  $back=M('Token_open')->add(array('uid'=>session('uid'),'token'=>session('token'),'queryname'=>'tianqi,qiushi,jishuan,kuaidi,xiaohua,peiliao,liaotian,shouji,fujin,fanyi,suanming,adma,geci,changtoushi,yuyinfanyi,huoche,gongjiao,shenfenzheng,caipiao,yuming,jiankang,mengjian,yinle,taobao,baike'));	
                 }		
	}
	
	public function add(){
		$fun=M('Function')->where(array('id'=>$this->_get('id')))->find();
		$openwhere=array('uid'=>session('uid'),'token'=>session('token'));
		$open=M('Token_open')->where($openwhere)->find();		
		$str['queryname'] = str_replace(',,',',',$open['queryname'].','.$fun['funname']);		
		$back=M('Token_open')->where($openwhere)->save($str);
		 
		if($back){
			echo 1;
		}else{
			echo 2;
		}
	
	}
	public function del(){
		$fun=M('Function')->where(array('id'=>$this->_get('id')))->find();
		$openwhere=array('uid'=>session('uid'),'token'=>session('token'));
		$open=M('Token_open')->where($openwhere)->find();		
		$str['queryname']=ltrim(str_replace(',,',',',str_replace($fun['funname'],'',$open['queryname'])),',');	
		$back=M('Token_open')->where($openwhere)->save($str);
		if($back){
			echo 1;
		}else{
			echo 2;
		}
	}




}



?>