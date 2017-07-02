$(document).ready(function(){
	//回頂部
	$('.s_gotop').click(function(){
		$("html,body").animate({scrollTop:0},"slow");
	})
	$(window).scroll(function() {
		if( $(this).scrollTop() > 100){
			$('.s_gotop').fadeIn("fast");
		}
		else{
			$('.s_gotop').stop().fadeOut("fast");
		}
	});
	
	//sidebar
	if(location.search=="")
		$(".ui.vertical.menu a").eq(0).addClass("active");
	else
		$("a[href*='" + location.search + "']").addClass("active");
	
	$('.dropdown').dropdown({
		action: 'combo'
	});
	
	$('.pop').popup({
		content  : "新增",
		 position : 'right center'
	});
	
	$('.ui.dropdown').dropdown();
	
	$('.ui.radio.checkbox').checkbox();
});