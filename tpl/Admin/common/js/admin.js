function setwindowheight() {
	//将浏览器的高度设置为元素的高度
	var windowheight = $(window).height()-91;
	$('.ifcontent').css('height', windowheight+'px');
	$('#contentleft').css('height', windowheight+'px');
}

$(document).ready(function() {
	setwindowheight();  //调用当前浏览器高度处理方法
	
	//主导航点击事件
	$('.navigation ul li').click(function() {
		$('.navigation ul li').removeClass('navigationtop');
		$(this).addClass('navigationtop');
		
		//获取当前对象的下一个元素的值（值是对应的这个元素下的内容）
		var textid = $(this).next().text();  //获取当前元素的下一个元素的值（里面是存放对象关联的左侧当好 class 值）
		$('#contentleft ul').css('display', 'none');  //先将左侧当好下的所有 ul 都隐藏
		$('.'+textid).css('display', 'block');  //开启当前对象下关联的左侧导航
		$('.'+textid+' li').removeClass('contentlefttop');  //将左侧当前对象的所有li的 class（contentlefttop）去掉
		$('.'+textid+' li:first').addClass('contentlefttop');  //为第一个 li 元素添加 class（contentlefttop）
		
		var url = $('.'+textid+' li:first').next().text();  //获取元素的url地址
		$('.ifcontent').attr('src', tplroot+url);  //改变页面内容区域的地址
		
		var text = $(this).text();  //获取当前元素的名称
		var texts = $('.'+textid+' li:first').text();  //获取左侧第一个元素的名称
		$('.topcontents').html('<span class="current">您的位置:</span><span class="location">'+text+' > <span class="locations">'+texts+'</span></span>');
		
		setwindowheight();  //调用当前浏览器高度处理方法
	});
	
	//左侧导航点击事件
	$('#contentleft ul li').click(function() {
		//$('#contentleft ul li').removeClass('contentlefttop');
		$(this).parent().find('li').removeClass('contentlefttop');  //获取当前对象的父节点，再获取子节点的 li 删除所有 class
		$(this).addClass('contentlefttop');  //为当前元素添加 class
		
		var url = $(this).next().text();  //获取元素的url地址
		$('.ifcontent').attr('src', tplroot+url);  //改变页面内容区域的地址
		
		var texts = $(this).text();  //获取当前元素的名称
		$('.locations').text(texts);
		setwindowheight();  //调用当前浏览器高度处理方法
	});
	
	/* 点击管理员名称加载资料修改 */
	$('.adminrights').click(function() {
		setwindowheight();  //调用当前浏览器高度处理方法
		$('.ifcontent').attr('src', tplroot+'/Admin/Admin/AdminEditor');  //改变页面内容区域的地址
	});
	
	
	
});

