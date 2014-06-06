<?php
class SiteAction extends BackAction{
	public function _initialize() {
        parent::_initialize();  //RBAC 验证接口初始化
    }
	
	public function index(){
		$role = M('User_group')->field('id,name')->where('status = 1')->select();
		$this->assign('role',$role);
		$this->assign('user_first_grade',C('user_first_grade'));
		$this->display();
	}
	public function email(){
		$this->display();
	}	
	public function alipay(){
		$alipay = array();
		$alipay[0]['id'] = 0; 
		$alipay[0]['method'] = "标准双接口";
		$alipay[1]['id'] = 1; 
		$alipay[1]['method'] = "担保交易接口";
		$alipay[2]['id'] = 2; 
		$alipay[2]['method'] = "即时到帐接口";
		$this->assign('alipay_pay_method',C('alipay_pay_method'));
		$this->assign('alipay',$alipay);
		$this->display();
	}
	public function safe(){
		$this->display();
	}
	public function contact(){
	     
		$this->display();
	}
	public function upfile(){
		 $this->display();
	}
	public function insert(){
		$file=$this->_post('files');
		unset($_POST['files']);
		unset($_POST[C('TOKEN_NAME')]);
		
		if($this->update_config($_POST,CONF_PATH.$file)){
			$this->success('操作成功',U('Site/index',array('pid'=>6,'level'=>3)));
		}else{
			$this->success('操作失败',U('Site/index',array('pid'=>6,'level'=>3)));
		}
	}

	public function tenpay(){
		$file=$this->_post('tfiles');
		unset($_POST['tfiles']);
		//unset($_POST[C('TOKEN_NAME')]);

		if($this->update_config($_POST,CONF_PATH.$file)){
			$this->success('操作成功',U('Site/index',array('pid'=>6,'level'=>3)));
		}else{
			$this->success('操作失败',U('Site/index',array('pid'=>6,'level'=>3)));
		}
	}

	private function update_config($config, $config_file = '') {
		!is_file($config_file) && $config_file = CONF_PATH . 'web.php';
		if (is_writable($config_file)) {
			//$config = require $config_file;
			//$config = array_merge($config, $new_config);
			//dump($config);EXIT;
			file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
			@unlink(RUNTIME_FILE);
			return true;
		} else {
			return false;
		}
	}
	public function template() {
		$this->display();
	}
	public function template_up() {
		$data=$this->_post('beer');
		$setfile = "./Data/conf/Home/config.php";
	    $settingstr="<?php \n return array(\n   'TMPL_FILE_DEPR'=>'_',  \n 'DEFAULT_THEME' => '".$data."',      );\n?>\n";
	    file_put_contents($setfile,$settingstr); //通过file_put_contents保存setting.config.php文件；

	    $this->success('操作成功',U('Site/template'));
	}

}