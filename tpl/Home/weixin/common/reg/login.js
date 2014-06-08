var resolutionHeight=window.screen.height;$("#hd").css("padding-top",(resolutionHeight*0.08)+"px");
$("div.info").css("margin-top",(resolutionHeight*0.11)+"px");
if(resolutionHeight<770){
$("body").css("height","130%");
}
else if(resolutionHeight<901){
$("body").css("height","115%");
}else if(resolutionHeight>1200){$("body").addClass("bodybig");}var scrollHeight = Math.max(document.documentElement.scrollHeight, document.body.scrollHeight);var clientHeight = document.documentElement.clientHeight || document.body.clientHeight;var maxHeight=Math.max(clientHeight,scrollHeight);$("body").css("min-height",maxHeight+"px");$(window).resize(function(){var scrollHeight1 = Math.max(document.documentElement.scrollHeight, document.body.scrollHeight);var clientHeight1 = document.documentElement.clientHeight || document.body.clientHeight;var maxHeight1=Math.max(clientHeight1,scrollHeight1);$("body").css("height",maxHeight1+"px");});/*placeholder*/
$('input[placeholder]').placeholder();
 

 
$(document).ready(function(){
        $('#btn-login').click(function(){
            $('#error_box').hide();
            var userAgent = window.navigator.userAgent.toLowerCase();
            var ie6 = $.browser.msie && /msie 6\.0/i.test(userAgent);
            if (ie6)
            {
                alert('请不要使用ie6及以下等低版本浏览器');
                return false;
            }
         
	    
            // 提交前检验
            if('' == $('#username').val()){
                $('#username').focus();
                $('#error_tips').text('请输入账号');
                $('#error_box').slideDown(400);
                setTimeout(function(){
                    $('#error_box').hide();
                }, 1000);
                return false;
            }
 
            $.post('/index.php?m=Users&a=checklogin', {username:$('#username').val(), password:$('#password').val(), keepalive:$('#keepalive').attr('value')}, function(rs){
	        if(rs == 3) var texts = '请联系在线客服，为你人工审核帐号!';
		if(rs == 2) var texts = '帐号密码错误!';
		if(rs == 1) var texts = '登录成功,比斯迈微管家欢迎您!';
                $('#error_tips').text(texts);
                $('#error_box').slideDown(400);
                setTimeout(function(){
                    $('#error_box').hide();
                }, 1000);
                if(rs == 1){
                    setTimeout(function(){
                        location.href = '/index.php?g=User&m=Index&a=index';
                    }, 600);
                }
            }, 'json');
        });
    });

    function changeCheckbox(){
        var new_value = (parseInt($('#keepalive').attr('value')) + 1) % 2;
        $('#keepalive').attr('value', new_value);
        if(1 == new_value){
            $('#keepalive').addClass('checked');
        }else{
            $('#keepalive').removeClass('checked');
        }
    }

    function bindEnterKey(event){
        if(13 == event.keyCode){
            $('#btn-login').click();
        }
    }
 