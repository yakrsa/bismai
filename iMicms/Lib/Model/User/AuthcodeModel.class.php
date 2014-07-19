<?php
class AuthcodeModel extends Model{
public funtion getAuthcode($where='status=1',$field='*'){
	return $this->field($field)->where($where)->select;
}


}


?>
