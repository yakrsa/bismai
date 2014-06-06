$(function(){
	CW.shake.getRule({
		  id:$_GET['id']
		},function(data){
			eval('var data='+data);
			var logotop=$(document).scrollTop()+($(window).height()-$('#biglogo').height())/2;
			var logoleft=($(window).width()-$('#biglogo').width())/2;
			$('#biglogo').css({
				'top':logotop,
				'left':logoleft,
				'background-image':'url('+data[0].twocode+')',
				'background-position':'center center',
				'background-repeat':'no-repeat',
				'background-size':'100% 100%'
			});
			if(data[0].qbg!==''){
				$('#shakebg').css({
					'background-image':'url('+data[0].qbg+')'
				});
			}
			if(data[0].logo!==''){
				$('#clogo').attr('src',data[0].logo);
			}
			if(data[0].hbg!==''){
				$('.wallbg').css({
					'background-image':'url('+data[0].hbg+')',
					'background-position':'center center',
					'background-repeat':'no-repeat'
				});
			}
		});
	
	$('#twocode').live('click',function(){
		$('#biglogo').fadeIn();
	});
	
	$('#biglogo').live('click',function(){
		$(this).fadeOut();
	});
	
	var timetop=$(document).scrollTop()+($(window).height()-$('#showtime').height())/2;
	var timeleft=($(window).width()-$('#showtime').width())/2;	
	var newtimetop=$(document).scrollTop()+($(window).height()-300)/2;
	var newtimeleft=($(window).width()-300)/2;
	
	$('#showtime').css({top:timetop,left:timeleft});
	$('#star').css({top:timetop,left:timeleft});
	var time=10;
	function starshake(){
		var stime=setInterval(function(){
			if(time>0){
				$("#showtime").animate({top:newtimetop,left:newtimeleft,height:'300px',lineHeight:'300px',width:'300px',fontSize:'200px',borderTopLeftRadius:'150px',borderTopRightRadius:'150px',borderBottomLeftRadius:'150px',borderBottomRightRadius:'150px',opacity:0},1000);
				$('#showtime').html(time);
				$("#showtime").animate({top:timetop,left:timeleft,height:'150px',lineHeight:'150px',width:'150px',fontSize:'100px',borderTopLeftRadius:'75px',borderTopRightRadius:'75px',borderBottomLeftRadius:'75px',borderBottomRightRadius:'75px',opacity:0.8},0);
				time--;
			}
			else{
				clearInterval(stime);
				CW.shake.starshake({
					  id:$_GET['id']
					},function(data){
						eval('var data='+data);
						if(data.status){
							$('#showtime').hide();
							$('#shakebg').fadeOut(500);
							nowshake();
						}
					});
			}
		},1000);
	}
	
	$('#star').click(function(){
		$(this).fadeOut(500);
		$('#showtime').fadeIn(1000);
		CW.shake.getwall({
			  id:$_GET['id']
			},function(data){
					eval('var data='+data);
					var html="";
					for(var i in data){
						if(data[i].name=='' || data[i].phone==''){
							continue;
						}
						html+='<div class="vote_list" rel="'+data[i].id+'" datanum="'+data[i].num+'">';
						html+='<div class="vote_area">';
						html+='<dl class="user">';
						html+='<dt class="face"><img src="'+data[i].face+'" /></dt>';
						html+='<dd class="name">'+data[i].nickname+'</dd>';
						html+='<dd class="phone">'+data[i].phone.substring(0,3)+'****'+data[i].phone.substring(7,11)+'</dd>';
						html+='</dl>';
						html+='<div class="progressbar">';
						html+='<div class="gg" style="color:#fff"><h2>'+Math.round(parseInt(data[i].num)/4)+'%</h2></div>';
						html+='<div style="width:'+data[i].num+'px;" class="bar"><span></span></div>';
						html+='</div>';	
						html+='</div>';
						html+='</div>';
					}
					$('.vote_wall').html(html);
			});
		starshake();
	});
	
	

	
	function nowshake(){
		var getuser=setInterval(function(){
			CW.shake.getwall({
				  id:$_GET['id']
				},function(data){
					eval('var data='+data);
					var html="";
					for(var i in data){
						if(data[i].name=='' || data[i].phone==''){
							continue;
						}
						if(Math.round(parseInt(data[i].num)/4)==100){
							clearInterval(getuser);
						}
//						$('.vote_list').each(function(){
//							if($(this).attr('rel')==data[i].id){
//								if(parseInt($(this).attr('datanum'))!==parseInt(data[i].num)){
//									html+='<div class="vote_list" rel="'+data[i].id+'" change="yes" datanum="'+data[i].num+'">';
//								}else{
//									html+='<div class="vote_list" rel="'+data[i].id+'" datanum="'+data[i].num+'">';
//								}
//							}
//						});
						html+='<div class="vote_list" rel="'+data[i].id+'" datanum="'+data[i].num+'">';
						html+='<div class="vote_area">';
						html+='<dl class="user">';
						html+='<dt class="face"><img src="'+data[i].face+'" /></dt>';
						html+='<dd class="name">'+data[i].nickname+'</dd>';
						html+='<dd class="phone">'+data[i].phone.substring(0,3)+'****'+data[i].phone.substring(7,11)+'</dd>';
						html+='</dl>';
						html+='<div class="progressbar">';
						html+='<div class="gg" style="color:#fff"><h2>'+Math.round(parseInt(data[i].num)/4)+'%</h2></div>';
						html+='<div style="width:'+data[i].num+'px;" class="bar"><span></span></div>';
						html+='</div>';	
						html+='</div>';
						html+='</div>';
					}
					$('.vote_wall').html(html);
//					$('.vote_list[change=yes]').flip({color:'#666'});
					shake_flip();
				});
		},5000);
	}
	
	function shake_flip(){
		$('.vote_list').eq(0).flip({color:'#999',speed:90,onAnimation:function(){
			$('.vote_list').eq(1).flip({color:'#999',speed:90,onAnimation:function(){
				$('.vote_list').eq(2).flip({color:'#999',speed:90,onAnimation:function(){
					$('.vote_list').eq(3).flip({color:'#999',speed:90,onAnimation:function(){
						$('.vote_list').eq(4).flip({color:'#999',speed:90,onAnimation:function(){
							$('.vote_list').eq(5).flip({color:'#999',speed:90,onAnimation:function(){
								$('.vote_list').eq(6).flip({color:'#999',speed:90,onAnimation:function(){
									$('.vote_list').eq(7).flip({color:'#999',speed:90,onAnimation:function(){
										$('.vote_list').eq(8).flip({color:'#999',speed:90,onAnimation:function(){
											$('.vote_list').eq(9).flip({color:'#999',speed:90,onAnimation:function(){
												$('.vote_list').eq(10).flip({color:'#999',speed:90});
												}});
											}});
										}});
									}});
								}});
							}});
						}});
					}});
				}});
			}});
}
});