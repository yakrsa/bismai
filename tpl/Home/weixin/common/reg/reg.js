$(function(){
	 var a=$("#regform").validate({
		rules:{
                        authcode:{
                                required:true,
                                chkUserName:true,
                                minlength:32,
                                maxlength:32
                        },
			username:{
				required:true,
				chkUserName:true,
				minlength:6,
				maxlength:16
			},
			password:{
				required:true,
				minlength:6,
				maxlength:16
			},
			repassword:{
				required:true,
				equalTo:"#password"
			},
			email:{
				required:true,
				email:true
			},
			mobile:{
				required:true,
				number:true,
				minlength:11,
				maxlength:14
			}
		},
		messages:{
                        authcode:{
                                required:"请输入邀请码",
                                minlength:"邀请码长度不够",
                                maxlength:"邀请码长度不能超过32",
                        },
			username:{
				required:"请输入用户名",
				minlength:"用户名长度不够",
				maxlength:"用户名长度不能超过16",
				chkUserName:"请使用[数字/字母/中划线/下划线]！"
			},
			password:{
				required:"请输入密码",
				minlength:"密码长度不够",
				maxlength:"密码长度不能超过16"
			},
			repassword:{
				required:"请输入密码",
				equalTo:"两次输入密码不相同"
			},
			email:{
				required:"请输入邮箱",
				email:"请输入正确的邮箱格式"
			},
			mobile:{
				required:"请输入手机",
				minlength:"请输入正确的手机号码",
				maxlength:"请输入正确的手机号码",
				number:"请输入正确的手机号码"
			}
		},
		 
		showErrors:function(b,d){
			if (d&&d.length>0) {
				$.each(d,function(e,g){
					var f=$(g.element);
					f.closest(".control-group").addClass("error");
					f.attr("title",g.message)})
			} else {
				var c=$(this.currentElements);
				c.closest(".control-group").removeClass("error");
				c.removeAttr("title")
			}
		},
		submitHandler:function(){
			var b=$("#regform");
			var d=$("#reg-btn");
			 
			  if(d.hasClass("disabled")){return}
			var c={
                                authcode:$("input[name='authcode']",b).val(),
				username:$("input[name='username']",b).val(),
				password:$("input[name='password']",b).val(),
                                province:$('#province').val(),
                                city:$('#city').val(),
                                areaid:$('#areaid').val(),
				email:$("input[name='email']",b).val(),
				mobile:$("input[name='mobile']",b).val(),
				qq:$("input[name='qq']",b).val(),
				tusername:$("input[name='username']",b).val(),
				captcha:$("input[name='captcha']",b).val(),
				__hash__:$("input[name='__hash__']",b).val() 
			}; 
			 
			 d.addClass("disabled");//  /index.php?m=Users&a=checkreg
			$.post("/index.php?g=Home&m=Users&a=checkreg",c,function(e){
				 d.removeClass("disabled");
				 
					if(e == 2 || e == 3){
						$("input[name='username']").focus();
						alert("用户名或邮箱已存在")
					} 
				        
					if(e == 7 ){
						$("input[name='username']").focus();
						alert("用户名已存在")
					} 
					if(e == 6 ){
						$("input[name='email']").focus();
						alert("邮箱已存在")
					} 
					if(e ==1){
							alert("注册成功");
							window.location.href="/index.php?g=Home&m=Index&a=login";
						}
				      
				       if(e == 5){
				                        $("input[name='captcha']").focus();
							alert('验证码错误！')
						}
                                       if(e == 8){
                                                        $("input[name='authcode']").focus();
                                                        alert('邀请码错误！')
                                                }	
					if(e == 4){
							alert('注册成功,请联系在线客服审核帐号')
							window.location.href="/index.php";
						}
					 
				 
			},"json");
			return false
		}
	});
			
	$.validator.addMethod("chkUserName",
		function(c){
			var b=/^[0-9a-zA-Z_-]+$/;
			return b.test(c)
		},"请使用[数字/字母/中划线/下划线]！");

	$.validator.addMethod("isMobilphone",
		function(d){
			var b=/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/;
			var c=new RegExp(b);
			return c.test(d)
		},"不是有效的手机号码")

});
