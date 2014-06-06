$(function(){
	 var a=$("#regform").validate({
		rules:{
			username:{
				required:true,
				chkUserName:true,
				minlength:6,
				maxlength:16
			},
			 
			email:{
				required:true,
				email:true
			} 
		},
		messages:{
			username:{
				required:"请输入用户名",
				minlength:"用户名长度不够",
				maxlength:"用户名长度不能超过16",
				chkUserName:"请使用[数字/字母/中划线/下划线]！"
			},
			 
			email:{
				required:"请输入邮箱",
				email:"请输入正确的邮箱格式"
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
				username:$("input[name='username']",b).val(),
				 
				email:$("input[name='email']",b).val(),
				 
				__hash__:$("input[name='__hash__']",b).val() 
			}; 
			 
			 d.addClass("disabled"); 
			$.post("/index.php?g=Home&m=Users&a=getpass",c,function(e){
				 d.removeClass("disabled");
				 
					if(e == 2){
						 
						alert("请接收邮件，重置密码！")
						window.location.href="/index.php";
					} 
				        
					 
					if(e ==1){
					                $("input[name='username']").focus();
							alert("帐户和邮箱不匹配!");
							window.location.href="/index.php?g=Home&m=Index&a=getpass";
						}
				      
				       	
					if(e == 3){
							alert('你已经提交了找回密码，请查收邮件！')
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