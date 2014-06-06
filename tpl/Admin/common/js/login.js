
$(document).ready(function() {
	//验证验证码
	$('#verify').blur(function() {
		var verify = $(this).val();
		if(verify.length == 0) {
			$(this).next().next().html("<img src='../../Static/Img/Admin/form2.png' /> 验证码不能为空！");
		} else if(verify.length != 6) {
			$(this).next().next().html("<img src='../../Static/Img/Admin/form2.png' /> 验证码需要6个字符！");
		} else if(verify.length == 6) {
			$.ajax({
				url:tplroot+'/Common/GetVerify',
				type:'post',
				data:'verify='+verify,
				dataType:'json',
				success:function(data) {
					//console.info(data);  //调试使用
					if(data == 1) {
						$('.verifytipsverify').html("<img src='../../Static/Img/Admin/form1.png' /> 验证码正确！");
						/* 验证码验证成功，字段触发登录按钮 */
						var statuaname = $('.statuaname').text();  //获取用户名的验证状态值
						var statuapwd = $('.statuapwd').text();  //获取密码的验证状态值
						if(statuaname == 1 && statuapwd == 1) {
							$("#submit").trigger("click");
						}
					} else if(data == 0) {
						$('.verifytipsverify').html("<img src='../../Static/Img/Admin/form2.png' /> 验证码错误！");
					}
					$('.verifytext').text(data);
				}
			});
		}
	});
	
	//登录按钮事件处理
	$('#submit').click(function() {
		//模拟人工触发一个 blur 事件
		$("#aname").trigger("blur");
		$("#apwd").trigger("blur");
		$("#verify").trigger("blur");

		var statuaname = $('.statuaname').text();  //获取用户名的验证状态值
		var statuapwd = $('.statuapwd').text();  //获取密码的验证状态值
		var verifystatu = $('.verifytext').text();  //获取验证码隐藏域的状态值
		
		//判断所有验证是否正确
		if((1 == statuaname) && (1 == statuapwd) && (1 == verifystatu)) {
			return true;
		} else {
			return false;
		}
	});

	
});
