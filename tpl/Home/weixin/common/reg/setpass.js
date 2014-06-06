$(function(){
	 var a=$("#regform").validate({
		rules:{
			password:{
				required:true,
				minlength:6,
				maxlength:16
			},
			repassword:{
				required:true,
				equalTo:"#password"
			}
		},
		messages:{
			password:{
				required:"请输入密码",
				minlength:"密码长度不够",
				maxlength:"密码长度不能超过16"
			},
			repassword:{
				required:"请输入密码",
				equalTo:"两次输入密码不相同"
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
				password:$("input[name='password']",b).val(),
				 
				repassword:$("input[name='repassword']",b).val(),
				uid:$("input[name='uid']",b).val(),  
				__hash__:$("input[name='__hash__']",b).val() 
			}; 
			 
			 d.addClass("disabled"); 
			$.post("/index.php?g=Home&m=Users&a=setpass",c,function(e){
				 d.removeClass("disabled");
				 
					if(e == 2){
						 
						alert("密码修改成功，请登陆")
						window.location.href="/index.php?g=Home&m=Index&a=login";
					} 
				        
					 
					if(e ==1){
					              
							alert("帐户不存在!");
							window.location.href="/index.php?g=Home&m=Index&a=setpass";
						}
				      
				       	
					if(e == 3){
							alert('网络错误，请重试')
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