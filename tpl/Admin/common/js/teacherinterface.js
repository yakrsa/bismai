
$(document).ready(function() {
	$('#submit').click(function() {
		//模拟人工触发一个 blur 事件
		$("#tname").trigger("blur");
		$("#tbirthdate").trigger("blur");
		$("#tmobile").trigger("blur");
		$("#thomephone").trigger("blur");
		$("#tmail").trigger("blur");
		
		//获取状态值
		var statutname = $('.statutname').text();  //教师姓名
		var statutbirthdate = $('.statutbirthdate').text();  //出生日期
		var statutmobile = $('.statutmobile').text();  //手机号码
		var statuthomephone = $('.statuthomephone').text();  //座机号码
		var statutmail = $('.statutmail').text();  //电子邮箱

		//验证邮箱是否填写
		if(statutmail != 1) {
			var tmail = $('#tmail').val();  //获取座机号码
			if(tmail.length <= 0) {
				$('.verifytipstmail').html('');
				$('#tmail').css('border', '1px solid #CCC');
				statutmail = 1;
			}
		}
		
		//判断电话号码是否填写了一个
		var phone = false;
		if((1 == statutmobile) || (1 == statuthomephone)) {
			if((1 == statutmobile) && (1 == statuthomephone)) {
				phone = true;
			} else if(1 == statutmobile) {
				var thomephone = $('#thomephone').val();  //获取座机号码
				if(thomephone.length <= 0) {
					$('.verifytipsthomephone').html('');
					$('#thomephone').css('border', '1px solid #CCC');
					phone = true;
				} else {
					phone = false;
					return false;
				}
			} else if(1 == statuthomephone) {
				var tmobile = $('#tmobile').val();  //获取手机号码
				if(tmobile.length <= 0) {
					$('.verifytipstmobile').html('');
					$('#tmobile').css('border', '1px solid #CCC');
					phone = true;
				} else {
					phone = false;
					return false;
				}
			}
		} else {
			phone = false;
			return false;
		}
		
		//form提交（最后的验证）
		if((1 == statutname) && (1 == statutbirthdate) && (1 == statutmail) && (true == phone)) {
			return true;
		} else {
			return false;
		}
		
		
	});
});

