// 获取页面元素
//var myElement = document.querySelector("header");
//// 创建 Headroom 对象，将页面元素传递进去
//var headroom  = new Headroom(myElement);
//// 初始化
//headroom.init(); 
     
             function Spirit_CallBack(obj,se_w,se_h){
	    	  if(jQuery(obj).length > 1){
		    	  	   (function (){
			       	    	 var se_ratio = se_h / se_w;
				       	    	jQuery(obj).each(function (){
				       	    	  	  jQuery(this).css({
				       	    	  	     height : Math.round(jQuery(obj).width() * se_ratio)
				       	    	      });
			       	    	     });  
		       	    })();
	    	  }else{
		    	  	  (function (){
			       	    	 var se_ratio = se_h / se_w;
			       	    	  jQuery(obj).css({
			       	    	  	  height : Math.round(jQuery(obj).width() * se_ratio)
			       	    	  });
		       	    })();
	    	  }
      }
             
             
       function Spirit_dynamicBG(obj,se_w,se_h,ob_consult){
       	     var zs_x = se_w;
       	     var zs_y = se_h;
       	     var zs_c = zs_x / zs_y;
       	     var win_w = $(ob_consult).width();
	   	     var win_h = $(ob_consult).height();
	   	  
	   	     var win_c = win_w / zs_c;
	   	     var zs_s = win_w / zs_c;
	   	     
	   	    if(win_h > zs_s){
	   	      	$(obj).css({'background-size' : 'auto 100%' });
	   	    }else{
	   	    	   $(obj).css({'background-size' : '100% auto'});
	   	    }
	   	    
       }

  
  
//     if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.split(";")[1].replace(/[ ]/g, "") == "MSIE6.0") {
//         }else if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.split(";")[1].replace(/[ ]/g, "") == "MSIE7.0") {
//             } else if (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.split(";")[1].replace(/[ ]/g, "") == "MSIE8.0") {
//                } else {
//                  AOS.init({
//						easing: 'ease-out-back',
//						duration: 1000,
//					});
//          }

  
  
$(function (){
	
	       var ng_eswiper = new Swiper('.ng-eswiper', {
			    speed: 400,
			    spaceBetween: 10,
			    pagination: '.ng-eswiper .swiper-pagination',
			    autoplay : 5000,
			    loop : true,
			    calculateHeight : true,
//			    paginationClickable :true,
			    autoplayDisableOnInteraction : false
			});   

         
         $(window).bind("resize",function (){
         	   
//       	   Spirit_CallBack($(".ng-upo-show"),100,100);
         	     
         	   $(".ng-body").css({"min-height" : $(window).height() - 52}); 
         	     
         }).resize();
     

         $(".ng-tonavbtn").on("click",function (){
         	    if(!$(".ng-tonavbtn").hasClass("ng-tonavbtn-on")){
         	    	 $(".ng-tonavbtn").addClass("ng-tonavbtn-on");
         	    	 $(".ng-whlist").slideDown(800);
         	    	 $("html").addClass("ac-gn-noscroll");
         	    	 $(".ng-hekin-shocart").addClass("ng-hekin-shocart-right");
         	    }else{
         	    	 $(".ng-tonavbtn").removeClass("ng-tonavbtn-on");
         	    	 $(".ng-whlist").slideUp(800,function (){
         	    	 	 $(".ng-hekin-shocart").removeClass("ng-hekin-shocart-right");
         	    	 });
         	    	 $("html").removeClass("ac-gn-noscroll");
         	    	   	
         	    }
         });
         
         
         $(".ng-hohet-pro-list li").on("click",function (){ $(".ng-hohet-pro-images li").removeClass("on").eq($(this).index()).addClass("on");});
         
         $(".ng-sustain-lios-tbtn").on("click",function (){
         	  if(!$(this).hasClass("ng-sustain-lios-tbtn-on")){
         	  	   $(this).addClass("ng-sustain-lios-tbtn-on").next().slideDown();
         	  }else{
         	  	     $(this).removeClass("ng-sustain-lios-tbtn-on").next().slideUp();
         	  }
         });
	 
	 
	 
	      $(".ng-hekin-shocart").on("click",function (){ $(".ng-nnv-share").toggleClass("ng-nnv-share-activate");});
            
            
             $(".ng-whikk-decline").on("click",function (event){
             	         event.preventDefault();
             	         if(!$(this).hasClass("ng-whikk-decline-on")){
             	         	   $(this).addClass("ng-whikk-decline-on").next().slideDown();
             	         }else{
             	         	   $(this).removeClass("ng-whikk-decline-on").next().slideUp();
             	         }
             });
             
             
              $(".ng-vinlst").slide({mainCell:".bd ul",autoPlay:true,effect:"leftMarquee",vis:2,interTime:50});
            
 
 
              var ng_copswiper = new Swiper('.ng-copse-swiper', {
			    speed: 400,
			    spaceBetween: 10,
			    autoplay : 5000,
			    loop : true,
			    calculateHeight : true,
//			    paginationClickable :true,
			    autoplayDisableOnInteraction : false
			});   

           $(".ng-bven-tab li").bind("click",function (){
       	         $(".ng-bven-tab li>span").removeClass("on");
        	     $(this).find("span").addClass("on");
        	     $(".ng-bven-map ul li").removeClass("on").eq($(this).index()).addClass("on");
           });
        

});
