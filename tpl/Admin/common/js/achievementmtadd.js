
$(document).ready(function() {
	$('#submit').click(function() {
		//模拟人工触发一个 blur 事件
		$("#atfraction").trigger("blur");
		
		//获取状态值
		var statuatfraction = $('.statuatfraction').text();  //学员分数
		
		
		//form提交（最后的验证）
		if(1 == statuatfraction) {
			return true;
		} else {
			return false;
		}
		
		
	});
});

