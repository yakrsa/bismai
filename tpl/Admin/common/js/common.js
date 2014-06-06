
//公共input:text 模块验证获取验证状态方法
function verificationatatu(divclass) {
	var value = '';
	$(divclass+' .inputtextclass').each(function() {
		value += $(this).text();  //获取所有的值
	});
	var statu = value.replace(/\s+/g,"");  //去除所有空格
	//正则验证
	var telsy = new RegExp(/^[1]+$/);
	if(telsy.test(statu)) {
		return 1;
	} else {
		return 0;
	}
}

