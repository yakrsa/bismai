
$(document).ready(function() {
	//判断是否是编辑模式下
	var type = $('#studentformtype').val();
	if(type == 2) {
		$('#studentformdisplay').css('display', 'none');
	}
	$('#submit').click(function() {
		var srids = $('#srids').val();  //获取学期状态
		if(srids == 0) {
			alert('请先到系统设置里面设置学期！');
			return false;
		}
		
		//模拟人工触发一个 blur 事件
		$("#sname").trigger("blur");
		$("#sbirthdate").trigger("blur");
		$("#smobile").trigger("blur");
		$("#shomephone").trigger("blur");
		$("#seffectivetime").trigger("blur");
		$("#stheendtime").trigger("blur");
		//缴费金额和缴费备注
		$("#ptmoney").trigger("blur");
		$("#ptremarks").trigger("blur");
		
		//获取状态值
		var statusname = $('.statusname').text();  //学员姓名
		var statusbirthdate = $('.statusbirthdate').text();  //出生日期
		var statusmobile = $('.statusmobile').text();  //手机号码
		var statushomephone = $('.statushomephone').text();  //座机号码
		var statuseffectivetime = $('.statuseffectivetime').text();  //生效时间
		var statustheendtime = $('.statustheendtime').text();  //终止时间
		
		var statuptmoney = $('.statuptmoney').text();  //学费金额
		var statuptremarks = $('.statuptremarks').text();  //缴费备注
		
		var datetimeseffectivetime = $('.datetimeseffectivetime').text();  //生效时间时间戳
		var datetimestheendtime = $('.datetimestheendtime').text();  //终止时间时间戳
		
		//验证缴费备注是否填写
		if(statuptremarks != 1) {
			var ptremarks = $('#ptremarks').val();  //获取缴费备注值
			if(ptremarks.length <= 0) {
				$('.verifytipsptremarks').html('');
				$('#ptremarks').css('border', '1px solid #CCC');
				statuptremarks = 1;
			}
		}
		
		//验证缴费金额是否填写
		if(statuptmoney != 1) {
			var ptmoney = $('#ptmoney').val();  //获取缴费金额值
			if(ptmoney.length <= 0) {
				$('.verifytipsptmoney').html('');
				$('#ptmoney').css('border', '1px solid #CCC');
				statuptmoney = 1;
			}
		}
		
		//判断电话号码是否填写了一个
		var phone = false;
		if((1 == statusmobile) || (1 == statushomephone)) {
			if((1 == statusmobile) && (1 == statushomephone)) {
				phone = true;
			} else if(1 == statusmobile) {
				var shomephone = $('#shomephone').val();  //获取座机号码
				if(shomephone.length <= 0) {
					$('.verifytipsshomephone').html('');
					$('#shomephone').css('border', '1px solid #CCC');
					phone = true;
				} else {
					phone = false;
					return false;
				}
			} else if(1 == statushomephone) {
				var smobile = $('#smobile').val();  //获取手机号码
				if(smobile.length <= 0) {
					$('.verifytipssmobile').html('');
					$('#smobile').css('border', '1px solid #CCC');
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
		
		
		//定义时间状态
		var date = false;
		if((1 == statuseffectivetime) && (1 == statustheendtime)) {
			if(datetimeseffectivetime < datetimestheendtime) {
				date = true;
			} else {
				date = false;
				alert('生效时间不能大于终止时间！');
			}
		}
		
		//form提交（最后的验证）
		if((1 == statusname) && (1 == statusbirthdate) && (true == phone) && (true == date)) {
			//判断是否是在新增模式下
			var type = $('#studentformtype').val();
			if(type == 1) {
				if((1 == statuptmoney) && (1 == statuptremarks)) {
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		} else {
			return false;
		}
		
		
	});
});

