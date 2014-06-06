
$(document).ready(function() {
	$('#submit').click(function() {
		var adminnamestatu = 0;
		//模拟人工触发一个blur事件
		$('.addinputtext').trigger("blur");

		//调用公共js方法获取验证状态
		var statu = verificationatatu('#addadmin');

		//判断所有验证是否正确
		if((1 == statu)) {
			return true;
		} else {
			return false;
		}
	});
	
	//新增管理员，管理员名称是否存在处理
	$('#aname').blur(function() {
		var type = $('#type').val();
		if(type == 'add') {
			var aname = $(this).val();
			var aname = aname.replace(/^\s+|\s+$/g,"");  //去除左右空格
			var statuaname = $('.statuaname').text();  //获取验证状态值
			if(aname != '') {
				if(statuaname == 1) {
					$.ajax({
						url:tplroot+'/Admin/Admin/AjaxAdminName',
						type:'post',
						data:'aname='+aname,
						dataType:'json',
						success:function(data) {
							//console.info(data);  //调试使用
							var prompttype = $('.prompttypeaname').text();
							if(data == 1) {
								if(prompttype == 1 || prompttype == 10) {
									$('.verifytipsaname').html("<img src='../../../Static/Img/Admin/form2.png' style='margin:0px 3px -3px 0px;'/>管理员已经存在！");
								} else if(prompttype == 2 || prompttype == 20) {
									alert('管理员已经存在！');
								}
								$('.statuaname').text(0);
								$('.inputthisaname').css("border", "1px solid #F00");
							} else {
								if(prompttype == 1 || prompttype == 10) {
									$('.verifytipsaname').html("<img src='../../../Static/Img/Admin/form1.png' style='margin:0px 3px -3px 0px;'/>该名称可以注册！");
								} else if(prompttype == 2 || prompttype == 20) {
									alert('该名称可以注册！');
								}
								var statu = $('.statuaname').text();
								$('.statuaname').text(1);
								$('.inputthisaname').css("border", "1px solid #5EBB29");
							}
						}
					});
				}
			} else {
				$('.verifytipsaname').html("");
				$('.statuaname').text(1);
				$('.inputthisaname').css("border", "1px solid #CCC");
			}
			
		}
	});
	
	//管理员信息编辑，密码处理
	$('#apwd').blur(function() {
		var type = $('#type').val();
		if(type == 'editor') {
			var apwd = $(this).val();
			var apwd = apwd.replace(/^\s+|\s+$/g,"");  //去除左右空格
			if(apwd != "") {
				var prompttype = $('.prompttypeapwd').text();
				
				if(apwd.length < 6) {
					if(prompttype == 10) {
						$('.verifytipsapwd').html("<img src='../../../Static/Img/Admin/form2.png' style='margin:0px 3px -3px 3px;'/>必须大于6个字符！");
					} else if(prompttype == 20) {
						alert('必须大于6个字符！');
					}
					$('.statuapwd').text(0);
					$('.inputthisapwd').css("border", "1px solid #F00");
				} else if(apwd.length > 12) {
					if(prompttype == 10) {
						$('.verifytipsapwd').html("<img src='../../../Static/Img/Admin/form2.png' style='margin:0px 3px -3px 3px;'/>不能大于12个字符！");
					} else if(prompttype == 20) {
						alert('不能大于12个字符！');
					}
					$('.statuapwd').text(0);
					$('.inputthisapwd').css("border", "1px solid #F00");
				} else {
					if(prompttype == 10) {
						$('.verifytipsapwd').html("<img src='../../../Static/Img/Admin/form1.png' style='margin:0px 3px -3px 3px;'/>格式正确！");
					} else if(prompttype == 20) {
						alert('格式正确！');
					}
					$('.statuapwd').text(1);
					$('.inputthisapwd').css("border", "1px solid #5EBB29");
				}
			} else {
				$('.verifytipsapwd').html("");
				$('.statuapwd').text(1);
				$('.inputthisapwd').css("border", "1px solid #CCC");
			}
		}
	});
	
	
});


