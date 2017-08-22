

/* SET SCROLL SPEEDS FOR ELEMENTS */
$(function() {
	
    $('#mobil').scrollingParallax({
        staticSpeed : .022,
		staticScrollLimit : false
    });
	
	$('#birdsPic1').scrollingParallax({
        staticSpeed : .25,
		staticScrollLimit : false
    });
	
	$('#birdsPic2').scrollingParallax({
        staticSpeed : .30,
		staticScrollLimit : false
    });
	$('#birdsPic3').scrollingParallax({
        staticSpeed : .40,
		staticScrollLimit : false
    });
	
	$('#birdsPic4').scrollingParallax({
        staticSpeed : .55,
		staticScrollLimit : false
    });
	
	$('#skyline').scrollingParallax({
        staticSpeed : .06,
		staticScrollLimit : false
    });
	
	$('#bench').scrollingParallax({
        staticSpeed : .70,
		staticScrollLimit : false
    });
	
	$('#feathersAbove').scrollingParallax({
        staticSpeed : 2.00,
		staticScrollLimit : false
    });
	
	$('#feathersBelow').scrollingParallax({
        staticSpeed : 1.00,
		staticScrollLimit : false
    });
    
});


/* CHANGE PROPERTIES OF ELEMENTS BASED ON SCROLL POSITION */
$(function() {
	$.fn.resize = function(max_size) {

  m = Math.ceil;

  if (max_size == undefined) {

    max_size = 500;

  }

  h=w= max_size;

  $(this).each(function() {

    image_h = $(this).height();

    image_w = $(this).width();

    if (image_h > image_w) {

     w = m(image_w / image_h * max_size);

    } else {

      h = m(image_h / image_w * max_size);

    }
    $(this).css({height:h,width:w});

  })

};
$(document).scroll(function() {


   if($(window).scrollTop() >= 5)
   {
	   var sizeMobil = ($(window).scrollTop())+500;
	   	$("#intro h1").css("font-size",($(window).scrollTop())+20)
		//$('#mobil').css("width",($(window).scrollTop()/2)+200);
		//$('#mobil').css({width:sizeMobil});
		$("#mobil").each(function() {
    		$(this).css({width:sizeMobil});
  		});
		
   }
   else
		$("#intro h1").css("font-size",80)
		
   
   if($(window).scrollTop() >= 300)
   {
		$("#skyline").css("opacity",($(window).scrollTop()-300)/2500)
   }
   else
		$("#skyline").css("opacity",0)   
   
   
   if($(window).scrollTop() >= 2000)
   {
		$("#bench").css("opacity",($(window).scrollTop()-2600)/500)
   }
   else
		$("#bench").css("opacity",0)   
		$("#mobil").css("display:none")
		

   if($(window).scrollTop() >= 3450)
   {
		$("#rootsPic").css("opacity",($(window).scrollTop()-3450)/250)
   }
   else
		$("#rootsPic").css("opacity",0)   
		
		
   if($(window).scrollTop() >= 3700)
   {
		$("#tmlLogo").css("opacity",($(window).scrollTop()-3700)/200)
   }
   else
		$("#tmlLogo").css("opacity",0)
				

   if($(window).scrollTop() >= 3800)
   {
	   	$("#panel").css("margin-top",0)
		$("#panel").css("opacity",($(window).scrollTop()-3800)/250)		
   }
   else
		$("#panel").css("margin-top",99999)
		$("#panel").css("display","block")
	});
  
});


/*  HEIGHT SETTER - MAKES THE PAGE HAVE THE RIGHT LENGTH FOR THE VIEWPORT. GETS CALLED ONLOAD (IN BODY TAG) + ONRESIZE (BELOW) */
function setrightheight()
{
$("#container").css("height",($(window).height()+14150))
}

/* CHECK IF WINDOW IS RESIZED AND RE-RUN HEIGHT SETTER */
$(function() {
  $(window).resize(function() {
	setrightheight();
  });
});