setInterval(function(){
	$('.arr').css({'webkitTransform':'translateY(-10px)'});
		$('.gift').css({'webkitTransform':'rotate(-30deg)'});
				setTimeout(function(){
					$('.arr').css({'webkitTransform':'translateY(10px)'});
					$('.gift').css({'webkitTransform':'rotate(30deg)'});
				},200)
},400);

$(document).ready(function(){	
		var name = $('.user .name').text();
		var	message = $('.user .message').text();
		var	fname = $('.user .fname').text();
		$('.user .name').text('');
		$('.user .message').text('');
		$('.user .fname').text('');
		function appuser(str,time,dom,callback){
			var i = 0,
				len = str.length;
			function go(){
				setTimeout(function(){
					if(i > len) return;
					dom.append(str[i]);
					i++;
					go();
				},time)
			}
			go();
			setTimeout(function(){
				callback();
			},len*time+500)
		}
		var t = 200;
		appuser(name,t,$('.user .name'),function(){
			appuser(message,t,$('.user .message'),function(){
				appuser(fname,t,$('.user .fname'),function(){});
			})
		});
				
});	
	
function send(){
	$('.weiba-layer-sharehelper').show();		
}	
function sendh(){	
    $('.weiba-layer-sharehelper').hide();	
}  