<?php
class User_groupModel extends Model{
	protected $_validate=array(
		array('name','require','用户组名称必须填写！',1,'',3),
		array('diynum','require','自定义图文数必须填写！',1,'',3),
		array('connectnum','require','用户请求数必须填写！',1,'',3),
		array('gongzhongnum','require','公众号创建个数必须填写！',1,'',3),		
		array('price','require','价格必须填写！',1,'',3),
                array('expdate','require','包月数必须填写！',1,'',3),
		array('name','','用户名称已经存在！',1,'unique',3), // 新增修改时候验证username字段是否唯一
	);
		// 获取单个用户信息
	public function getGroup($where = '',$field = '*') {
		return $this->field($field)->where($where)->find();
	}
	//所有的用户组
	public function getAllGroup($where = '',$field = '*') {
		return $this->field($field)->where($where)->select();
	}
}
?>
