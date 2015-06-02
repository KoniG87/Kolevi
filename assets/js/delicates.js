$(document).ready(function(){

/*delicatesről carousel*/

function delicatesCarousel(){
	var delicatesrolPrev = "<svg class=\"icon icon-nyil-balra slick-prev\"><use xlink:href=\"#icon-nyil-balra\"></use></svg>";
	var delicatesrolNext = "<svg class=\"icon icon-nyil-jobbra slick-next\"><use xlink:href=\"#icon-nyil-jobbra\"></use></svg>";

	$(".delicates-slider").slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  dots: true,
	  arrows:true,
	  prevArrow: delicatesrolPrev,
	  nextArrow: delicatesrolNext,
	});

	callDelicatesCarouselSvg();
}

delicatesCarousel();

function callDelicatesCarouselSvg(){
$(".delicates-slide-img").each(function(){
  $(this).Svgenerate({
  	rightFixed: "on",
    imgMask:"on",
    setToImg:"on",
    dropShadow: "on",
    blur:5,
    dX:5,
    dY:5,
    opacity:0.5,
    rangeX:0.95,
    rangeY:0.88,
    midmove: 0.3
  });
});


$(".delicates-slide>aside").each(function(){
  $(this).Svgenerate({
  	leftFixed: "on",
  	rangeX:0.90,
  	dropShadow: "on",
    blur:5,
    dX:5,
    dY:38,
    opacity:0.4
  });
});

}


/* BOLT ACCORDION */

var alapOddBolt = {
		rotateX:"-90deg",
		rotateZ:0,
		scaleX:0.8,
		scaleY:0.8,
		marginTop:"-2.5rem",
		/*backgroundColor:"#ddd",*/
		backgroundColor:"#ee8639",
/*		backgroundColorAlpha: 0.1*/

       },
      alapEvenBolt = {
		rotateX:"90deg",
		rotateZ:0,
		scaleX:0.8,
		scaleY:0.8,
		marginTop:"-2.5rem",
	/*	backgroundColor:"#f5f5f5",*/
		backgroundColor:"#f2e064",
/*		backgroundColorAlpha: 0.5*/

       },
      nyitvaOddBolt = {
		rotateX:"-30deg",
		rotateZ:0,
		scaleX: 1,
		scaleY: 1,
		marginTop:0

       },
      nyitvaEvenBolt = {
		rotateX:"30deg",
		rotateZ:0,
		scaleX: 1,
		scaleY: 1,
		marginTop:0
       },
       alapOddBoltSubkateg = {
		rotateX:"-90deg",
		rotateZ:0,
		scaleX:0.8,
		scaleY:0.8,
		marginTop:"-1.5rem",
		/*backgroundColor:"#ccc",*/
		backgroundColor:"#09b6b0",
/*		backgroundColorAlpha: 0.1*/

       },
      alapEvenBoltSubkateg = {
		rotateX:"90deg",
		rotateZ:0,
		scaleX:0.8,
		scaleY:0.8,
		marginTop:"-1.5rem",
	/*	backgroundColor:"#f5f5f5",*/
		backgroundColor:"#88fffb",
/*		backgroundColorAlpha: 0.5*/
       },
      nyitvaOddBoltSubkateg = {
		rotateX:"-30deg",
		rotateZ:0,
		scaleX: 1,
		scaleY: 1,
		marginTop:0
       },
      nyitvaEvenBoltSubkateg = {
		rotateX:"30deg",
		rotateZ:0,
		scaleX: 1,
		scaleY: 1,
		marginTop:0
       },
      spring = [20,18],
      duration = 1400;


function boltAccordionCLICK(){    
    var thisOne = $(this);
    thisOne.toggleClass("bolt-is-open");
    if(thisOne.hasClass("bolt-is-open")){
         thisOne.css("margin-bottom","-1px");
         thisOne.parent().find(">li:nth-of-type(odd)").velocity(nyitvaOddBolt,duration,spring);
         thisOne.parent().find(">li:nth-of-type(even)").velocity(nyitvaEvenBolt,duration,spring);
      }
    else{
       if ( $(".bolt-acco>ul").hasClass("bolt-subkateg-is-open")) {
       $(".bolt-subkateg-is-open").prev('li').click();
       setTimeout(function(){ 
	        thisOne.parent().find(">li:nth-of-type(odd)").velocity(alapOddBolt,duration,spring);
	        thisOne.parent().find(">li:nth-of-type(even)").velocity(alapEvenBolt,duration,spring);
	        thisOne.css("margin-bottom","10px");
        }, 1000);
       }
       else{
	        thisOne.parent().find(">li:nth-of-type(odd)").velocity(alapOddBolt,duration,spring);
	        thisOne.parent().find(">li:nth-of-type(even)").velocity(alapEvenBolt,duration,spring);
	        thisOne.css("margin-bottom","10px");
       }
    }
}

function boltAccordionListItemCLICK(){    
    var thisOne = $(this).next("ul");
    thisOne.toggleClass("bolt-subkateg-is-open");
    if(thisOne.hasClass("bolt-subkateg-is-open")){
         
         thisOne.find("li:nth-of-type(odd)").velocity(nyitvaOddBoltSubkateg,duration,spring);
         thisOne.find("li:nth-of-type(even)").velocity(nyitvaEvenBoltSubkateg,duration,spring);
      }
    else{
       
        thisOne.find("li:nth-of-type(odd)").velocity(alapOddBoltSubkateg,duration,spring);
        thisOne.find("li:nth-of-type(even)").velocity(alapEvenBoltSubkateg,duration,spring);
    }
}

function boltAccordion(){ 
    $(".bolt-acco>li:nth-of-type(odd)").velocity(alapOddBolt,1,spring);
    $(".bolt-acco>li:nth-of-type(even)").velocity(alapEvenBolt,1,spring);
    // CLICK
    $(".bolt-acco-head").click(boltAccordionCLICK).click(function(){
      setTimeout(function(){ refreshWaypoints(); }, 1400);
    });

// subkateg
    $(".bolt-acco>ul li:nth-of-type(odd)").velocity(alapOddBoltSubkateg,1,spring);
    $(".bolt-acco>ul li:nth-of-type(even)").velocity(alapEvenBoltSubkateg,1,spring);
    // CLICK
    $(".bolt-acco>li").click(boltAccordionListItemCLICK).click(function(){
      setTimeout(function(){ refreshWaypoints(); }, 1400);
    });
}





boltAccordion();








































// Resize end function
var rtime = new Date(1, 1, 2000, 12,00,00);
var timeout = false;
var delta = 200;
$(window).resize(function() {
    rtime = new Date();
    if (timeout === false) {
        timeout = true;
        setTimeout(resizeend, delta);
    }
});

function resizeend() {
    if (new Date() - rtime < delta) {
        setTimeout(resizeend, delta);
    } else {
        timeout = false;

/*delicates*/
callDelicatesCarouselSvg();

    }               
}

});