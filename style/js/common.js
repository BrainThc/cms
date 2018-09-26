

$(document).ready(function(){
	$('.xnav li').hover(function(){$(this).addClass("cur");},function(){$(this).removeClass("cur");})

	$(".float_qq4").hide();
	$(window).bind("scroll", function () { 
		var sTop = $(window).scrollTop(); 
		var sTop = parseInt(sTop); 
		if (sTop >= 230) { 
		   $(".float_qq4").show(); 
		}  else { 
		   $(".float_qq4").hide(); 
		}  
	}); 



$(".float_qq1").hover(function(){$(this).animate({"left":"-70px"},350)},function(){$(this).animate({"left":"0"},350)});$(".float_qq2").hover(function(){$(this).animate({"left":"-116px"},350)},function(){$(this).animate({"left":"0"},350)});$(".float_qq3").hover(function(){$(this).find(".float_shwx").show()},function(){$(this).find(".float_shwx").hide()});$(".foot_dshare3").hover(function(){$(".foot_shWx").show()},function(){$(".foot_shWx").hide()});$(".foot_dshare2").hover(function(){$(".foot_shTelWx").show()},function(){$(".foot_shTelWx").hide()});
	$(".float_qq4").bind('click',function(){
		$(window).scrollTop(0);
	});

	$(".float_qq5").hover(function(){$(this).animate({"left":"-70px"},350)},function(){$(this).animate({"left":"0"},350)});

	$(".weixing-container").bind('mouseenter',function(){
		$('.weixing-show').show();
	})
	$(".weixing-container").bind('mouseleave',function(){        
		$('.weixing-show').hide();
	});


});


if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.split(";")[1].replace(/[ ]/g, "") == "MSIE6.0") {
        }else if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.split(";")[1].replace(/[ ]/g, "") == "MSIE7.0") {
            } else if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.split(";")[1].replace(/[ ]/g, "") == "MSIE8.0") {
               } else {
                 AOS.init({
						easing: 'ease-in-sine',
						duration: 500,
                        once:'true',

                                // offset: 200,
                                //   duration: 1000,
                                //   easing: 'ease-out-back',
                                //   delay: 200,
					});
         }




