
//����input:text ģ����֤��ȡ��֤״̬����
function verificationatatu(divclass) {
	var value = '';
	$(divclass+' .inputtextclass').each(function() {
		value += $(this).text();  //��ȡ���е�ֵ
	});
	var statu = value.replace(/\s+/g,"");  //ȥ�����пո�
	//������֤
	var telsy = new RegExp(/^[1]+$/);
	if(telsy.test(statu)) {
		return 1;
	} else {
		return 0;
	}
}

