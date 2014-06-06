
//删除确认操作方法
function gridmodeldelete(e) {
	if(confirm("是否删除？ 删除后将无法恢复！")) {
		//跳转到删除页面
		location.href="./Index?type=2&atid="+e;
	}
}

$(document).ready(function() {
	//登录按钮事件处理
	$('#submitdelete').click(function() {
		var selectcheckbox = $('#tablecontent input:checked').length;
		//alert(selectcheckbox);
		//判断所有验证是否正确
		if(selectcheckbox > 0) {
			if(confirm('是否删除？ 删除后将无法恢复！')) {
				return true;
			} else {
				return false;
			}
		} else {
			alert('请先选择需要删除的数据！');
			return false;
		}

	});

	
});


