
$(document).ready(function() {
	$('#submit').click(function() {
		//模拟人工触发一个 blur 事件
		$("#ptmoney").trigger("blur");
		$("#ptremarks").trigger("blur");
		
		//获取状态值
		var statuptmoney = $('.statuptmoney').text();  //学费金额
		var statuptremarks = $('.statuptremarks').text();  //缴费备注
		
		//验证缴费备注是否填写
		if(statuptremarks != 1) {
			var ptremarks = $('#ptremarks').val();  //获取缴费备注值
			if(ptremarks.length <= 0) {
				$('.verifytipsptremarks').html('');
				$('#ptremarks').css('border', '1px solid #CCC');
				statuptremarks = 1;
			}
		}
		
		//form提交（最后的验证）
		if((1 == statuptmoney) && (1 == statuptremarks)) {
			return true;
		} else {
			return false;
		}
		
		
	});
});

