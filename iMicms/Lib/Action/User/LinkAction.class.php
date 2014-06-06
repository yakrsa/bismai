<?php
class LinkAction extends UserAction{
	public $where;
	public $modules;
	public function _initialize() {
		parent::_initialize();
		$this->where=array('token'=>$this->token);
		$this->modules=array(
		'Home'=>'首页',
		'Classify'=>'网站分类',
		'Img'=>'图文回复',
		'Company'=>'LBS信息',
		'Adma'=>'DIY宣传页',
		'Photo'=>'相册',
		'Selfform'=>'万能表单',
		'Host'=>'商家订单',
		'Groupon'=>'团购',
		'Shop'=>'商城',
		'Dining'=>'订餐',
		'Wcard'=>'婚庆喜帖',
		'Vote'=>'投票',
		'Diaoyan'=>'调研',
		'Panoramic'=>'全景',
		'Lottery'=>'大转盘',
		'Guajiang'=>'刮刮卡',
		'Coupon'=>'优惠券',
		'MemberCard'=>'会员卡',
		'Estate'=>'微房产',
		'Message'=>'留言板',
		'Car'=>'汽车',
		'GoldenEgg'=>'砸金蛋',
		'LuckyFruit'=>'水果机',
		'Jiudian' => '微酒店',
		'Yiliao' => '微医疗',
		'Meirong' => '微美容',
		'Jiuba' => '微酒吧',
		'Huadian' => '微花店',
		'Zhengwu' => '微政务',
		'Jianshen' => '微健身',
		'Lvyou' => '微旅游',
		'Shipin' => '微食品',
		'Jiaoyu' => '微教育',
		'Heka' => '贺卡',
		);
	}
	public function insert(){
		$modules=$this->modules();
		$this->assign('modules',$modules);
		$this->display();
	}
	public function modules(){
		return array(
		array('module'=>'Home','linkcode'=>'index.php?g=Wap&m=Index&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>'微站首页','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>$this->modules['Home'],'askeyword'=>1),
		array('module'=>'Classify','linkcode'=>'index.php?g=Wap&m=Index&a=lists&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Classify'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>0),
		array('module'=>'Img','linkcode'=>'index.php?g=Wap&m=Index&a=content&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Img'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'Company','linkcode'=>'index.php?g=Wap&m=Company&a=map&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Company'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'地图','askeyword'=>1),
		array('module'=>'Adma','linkcode'=>'index.php/show/'.$this->token,'name'=>$this->modules['Adma'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>0),
		array('module'=>'Photo','linkcode'=>'index.php?g=Wap&m=Photo&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Photo'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'相册','askeyword'=>1),
		array('module'=>'Selfform','linkcode'=>'index.php?g=Wap&m=Selfform&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Selfform'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'Host','linkcode'=>'index.php?g=Wap&m=Host&a=detail&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Host'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'Groupon','linkcode'=>'index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Groupon'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'团购','askeyword'=>1),
		array('module'=>'Shop','linkcode'=>'index.php?g=Wap&m=Product&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Shop'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'商城','askeyword'=>1),
		//array('module' => 'Dining', 'linkcode' => ('/index.php?g=Wap&m=Dining&a=index&dining=1&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Dining'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '订餐', 'askeyword' => 1), 
		array('module'=>'Wcard','linkcode'=>'index.php?g=Wap&m=Wcard&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Wcard'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'Heka','linkcode'=>'index.php?g=Wap&m=Heka&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Heka'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'Vote','linkcode'=>'index.php?g=Wap&m=Vote&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Vote'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'Diaoyan','linkcode'=>'index.php?g=Wap&m=Diaoyan&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Diaoyan'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'Panoramic','linkcode'=>'index.php?g=Wap&m=Panoramic&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Panoramic'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>$this->modules['Panoramic'],'askeyword'=>1),
		array('module'=>'Lottery','linkcode'=>'','name'=>$this->modules['Lottery'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'Guajiang','linkcode'=>'','name'=>$this->modules['Guajiang'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'Coupon','linkcode'=>'','name'=>$this->modules['Coupon'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'MemberCard','linkcode'=>'index.php?g=Wap&m=Card&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['MemberCard'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'会员卡','askeyword'=>1),
		array('module'=>'Estate','linkcode'=>'index.php?g=Wap&m=Estate&a=index&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','name'=>$this->modules['Estate'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'微房产','askeyword'=>1),
		//array('module' => 'Jiudian', 'linkcode' => ('index.php?g=Wap&m=Jiudian&a=index&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Jiudian'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '微酒店', 'askeyword' => 1),
		//array('module' => 'Yiliao', 'linkcode' => ('index.php?g=Wap&m=Yiliao&a=index&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Yiliao'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '微医疗', 'askeyword' => 1),
		//array('module' => 'Meirong', 'linkcode' => ('index.php?g=Wap&m=Meirong&a=index&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Meirong'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '微美容', 'askeyword' => 1),
		//array('module' => 'Jiuba', 'linkcode' => ('index.php?g=Wap&m=Jiuba&a=index&token=' . $this->token) . '&wecha_id={wechat_id}', 'name' => $this->modules['Jiuba'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '微酒吧', 'askeyword' => 1),
        //array('module'=>'Jiaoyu','linkcode'=>'index.php?g=Wap&m=Jiaoyu&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Jiaoyu'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		//array('module'=>'Huadian','linkcode'=>'index.php?g=Wap&m=Huadian&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Huadian'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		//array('module'=>'Zhengwu','linkcode'=>'index.php?g=Wap&m=Zhengwu&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Zhengwu'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		//array('module'=>'Jianshen','linkcode'=>'index.php?g=Wap&m=Jianshen&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Jianshen'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		//array('module'=>'Lvyou','linkcode'=>'index.php?g=Wap&m=Lvyou&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Lvyou'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		//array('module'=>'Shipin','linkcode'=>'index.php?g=Wap&m=Shipin&a=index&token='.$this->token.'&wecha_id={wechat_id}','name'=>$this->modules['Shipin'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		//array('module'=>'Message','linkcode'=>'index.php?g=Wap&m=Reply&a=index&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','name'=>$this->modules['Message'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'留言','askeyword'=>1),
		array('module'=>'Car','linkcode'=>'index.php?g=Wap&m=brands&a=index&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','name'=>$this->modules['Car'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'GoldenEgg','linkcode'=>'','name'=>$this->modules['GoldenEgg'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module'=>'LuckyFruit','linkcode'=>'','name'=>$this->modules['LuckyFruit'],'sub'=>1,'canselected'=>0,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		);
	}
	public function Classify(){
		$this->assign('moduleName',$this->modules['Classify']);
		$db=M('Classify');
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['name'],'linkcode'=>'index.php?g=Wap&m=Index&a=lists&token='.$this->token.'&wecha_id={wechat_id}&classid='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Img(){
		$this->assign('moduleName',$this->modules['Img']);
		$db=M('Img');
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Index&a=content&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Company(){
		$this->assign('moduleName',$this->modules['Company']);
		$db=M('Company');
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['name'],'linkcode'=>'index.php?g=Wap&m=Company&a=map&token='.$this->token.'&wecha_id={wechat_id}&companyid='.$item['id'],'linkurl'=>'','keyword'=>'地图'));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Photo(){
		$this->assign('moduleName',$this->modules['Photo']);
		$db=M('Photo');
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Photo&a=plist&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>'相册'));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Selfform(){
		$this->assign('moduleName',$this->modules['Selfform']);
		$db=M('Selfform');
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['name'],'linkcode'=>'index.php?g=Wap&m=Selfform&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Host(){
		$moduleName='Host';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['name'],'linkcode'=>'index.php?g=Wap&m=Host&a=index&token='.$this->token.'&wecha_id={wechat_id}&hid='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Panoramic(){
		$this->assign('moduleName',$this->modules['Panoramic']);
		$db=M('Panoramic');
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('createtime DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['name'],'linkcode'=>'index.php?g=Wap&m=Panoramic&a=item&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Wcard(){
		$moduleName='Wcard';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Wcard&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Heka(){
		$moduleName='Heka';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Heka&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Lottery(){
		$moduleName='Lottery';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$where['type']=1;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Lottery&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Guajiang(){
		$moduleName='Guajiang';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M('Lottery');
		$where=$this->where;
		$where['type']=2;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Guajiang&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Coupon(){
		$moduleName='Coupon';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M('Lottery');
		$where=$this->where;
		$where['type']=3;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Coupon&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function LuckyFruit(){
		$moduleName='LuckyFruit';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M('Lottery');
		$where=$this->where;
		$where['type']=4;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=LuckyFruit&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function GoldenEgg(){
		$moduleName='GoldenEgg';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M('Lottery');
		$where=$this->where;
		$where['type']=5;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=GoldenEgg&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Vote(){
		$moduleName='Vote';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Vote&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Diaoyan(){
		$moduleName='Diaoyan';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Diaoyan&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Jiaoyu(){
		$moduleName='Jiaoyu';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Jiaoyu&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Huadian(){
		$moduleName='Huadian';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Huadian&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Zhengwu(){
		$moduleName='Zhengwu';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Zhengwu&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Jianshen(){
		$moduleName='Jianshen';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Jianshen&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Lvyou(){
		$moduleName='Lvyou';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Lvyou&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Shipin(){
		$moduleName='Shipin';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M($moduleName);
		$where=$this->where;
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['title'],'linkcode'=>'index.php?g=Wap&m=Shipin&a=index&token='.$this->token.'&wecha_id={wechat_id}&id='.$item['id'],'linkurl'=>'','keyword'=>$item['keyword']));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Shop(){
		$moduleName='Shop';
		$this->assign('moduleName',$this->modules[$moduleName]);
		$db=M('Product_cat');
		$where=array('dining'=>0,'token'=>$this->token);
		$count      = $db->where($where)->count();
		$Page       = new Page($count,5);
		$show       = $Page->show();
		$list=$db->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
		//
		$items=array();
		if ($list){
			foreach ($list as $item){
				array_push($items,array('id'=>$item['id'],'name'=>$item['name'],'linkcode'=>'index.php?g=Wap&m=Product&a=index&token='.$this->token.'&wecha_id={wechat_id}&catid='.$item['id'],'linkurl'=>'','keyword'=>'商城'));
			}
		}
		//
		$this->assign('list',$items);
		$this->assign('page',$show);
		$this->display('detail');
	}
	public function Estate(){
		$moduleName='Estate';
		$this->assign('moduleName',$this->modules[$moduleName]);
		//
		$items=array();
		array_push($items,array('id'=>1,'name'=>'楼盘介绍','linkcode'=>'index.php?g=Wap&m=Estate&a=index&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>'微房产'));
		array_push($items,array('id'=>2,'name'=>'楼盘相册','linkcode'=>'index.php?g=Wap&m=Estate&a=album&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>'微房产'));
		array_push($items,array('id'=>3,'name'=>'户型全景','linkcode'=>'index.php?g=Wap&m=Estate&a=housetype&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>'微房产'));
		array_push($items,array('id'=>4,'name'=>'专家点评','linkcode'=>'index.php?g=Wap&m=Estate&a=impress&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>'微房产'));
		$Estate=M('Estate')->where(array('token'=>$this->token))->find();
		$rt=M('Reservation')->where(array('id'=>$Estate['res_id']))->find();
		array_push($items,array('id'=>5,'name'=>'看房预约','linkcode'=>'index.php?g=Wap&m=Reservation&a=index&rid='.$Estate['res_id'].'&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$rt['keyword']));
		$this->assign('list',$items);
		$this->display('detail');
	}
	public function Car(){
		$moduleName='Car';
		$this->assign('moduleName',$this->modules[$moduleName]);
		//
		$thisItem=M('Carset')->where(array('token'=>$this->token))->find();
		$thisItemNews=M('Carnews')->where(array('token'=>$this->token))->find();
		$items=array();
		array_push($items,array('id'=>1,'name'=>'经销车型','linkcode'=>'index.php?g=Wap&m=Car&a=brands&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		array_push($items,array('id'=>2,'name'=>'销售顾问','linkcode'=>'index.php?g=Wap&m=Car&a=salers&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		array_push($items,array('id'=>3,'name'=>'车主关怀','linkcode'=>'index.php?g=Wap&m=Car&a=owner&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		array_push($items,array('id'=>4,'name'=>'车型欣赏','linkcode'=>'index.php?g=Wap&m=Car&a=showcar&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		array_push($items,array('id'=>5,'name'=>'实用工具','linkcode'=>'index.php?g=Wap&m=Car&a=tool&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		array_push($items,array('id'=>6,'name'=>'预约试驾','linkcode'=>'index.php?g=Wap&m=Car&a=CarReserveBook&addtype=drive&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		array_push($items,array('id'=>7,'name'=>'预约保养','linkcode'=>'index.php?g=Wap&m=Car&a=CarReserveBook&addtype=maintain&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		//
		array_push($items,array('id'=>8,'name'=>'最新车讯','linkcode'=>'index.php?g=Wap&m=Index&a=lists&classid='.$thisItemNews['news_id'].'&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		array_push($items,array('id'=>9,'name'=>'最新优惠','linkcode'=>'index.php?g=Wap&m=Index&a=lists&classid='.$thisItemNews['pre_id'].'&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		array_push($items,array('id'=>10,'name'=>'尊享二手车','linkcode'=>'index.php?g=Wap&m=Index&a=lists&classid='.$thisItemNews['usedcar_id'].'&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		array_push($items,array('id'=>11,'name'=>'品牌相册','linkcode'=>'index.php?g=Wap&m=Photo&a=plist&id='.$thisItemNews['album_id'].'&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		array_push($items,array('id'=>12,'name'=>'店铺LBS','linkcode'=>'index.php?g=Wap&m=Company&a=map&companyid='.$thisItemNews['company_id'].'&token='.$this->token.'&wecha_id={wechat_id}&imicms=mp.weixin.qq.com','linkurl'=>'','keyword'=>$thisItem['keyword']));
		$this->assign('list',$items);
		$this->display('detail');
	}
}


?>