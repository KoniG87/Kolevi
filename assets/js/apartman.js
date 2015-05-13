$(document).ready(function(){

/*
 * térkép marker-animation
 */

$(".marker-logo").hover(
	function(){
		$(this).find("h2").velocity({ opacity: 1 }, { display: "block" });
		$(this).find(".icon-marker-logo").velocity({top: "-1.2rem"}, {duration: 1300,loop: true});
		$(this).find(".marker-shadow").velocity({height:"0.8rem", width:"1.6rem"}, {duration: 1300,loop: true});
	},
	function(){
		$(this).find("h2").velocity("stop").velocity({ opacity: 0 }, { display: "none" });
		$(this).find(".icon-marker-logo").velocity("stop").velocity({top: 0}, 1000);
		$(this).find(".marker-shadow").velocity("stop").velocity({height:"1.6rem", width:"2.5rem"},1000);
	}
	);
$(".marker-logo").on("click",function(){
		$(this).find("h2").velocity("stop").velocity({ opacity: 0 }, { display: "none" });
		$(this).find(".icon-marker-logo").velocity("stop").velocity({top: 0}, 1000);
		$(this).find(".marker-shadow").velocity("stop").velocity({height:"1.6rem", width:"2.5rem"},1000);
});


/*
 * A hely - szoba-hoverek
 */

$("#agy1").on("mouseenter",function(){
	$("#szoba1").velocity({ opacity: 1 }, { display: "block" });
});
$("#szoba1").on("mouseleave",function(){
	$("#szoba1").velocity("stop").velocity({ opacity: 0 }, { display: "none" });
});

$("#agy2").on("mouseenter",function(){
	$("#szoba2").velocity({ opacity: 1 }, { display: "block" });
});
$("#szoba2").on("mouseleave",function(){
	$("#szoba2").velocity("stop").velocity({ opacity: 0 }, { display: "none" });
});

$("#agy3").on("mouseenter",function(){
	$("#szoba3").velocity({ opacity: 1 }, { display: "block" });
});
$("#szoba3").on("mouseleave",function(){
	$("#szoba3").velocity("stop").velocity({ opacity: 0 }, { display: "none" });
});


$("#hely_svg a").on("click",function(event){
    event.preventDefault();
    event.stopPropagation();
    var anchorTarget = $(this).attr("href");

$(anchorTarget).velocity("scroll", {
            duration: 2000,
            easing: "ease",
            offset:-160
        });
});

/*
 * szobák carousel
 */
function szobaCarousel(){

var szobaPrev = "<svg class=\"icon icon-nyil-balra slick-prev\"><use xlink:href=\"#icon-nyil-balra\"></use></svg>";
var szobaNext = "<svg class=\"icon icon-nyil-jobbra slick-next\"><use xlink:href=\"#icon-nyil-jobbra\"></use></svg>";
var szobaCarousel = $(this).find(".szoba-carousel");
var szobaCarouselNav = $(this).find('.szoba-carousel-nav');

	szobaCarousel.slick({ 
	  adaptiveHeight: true,
	  speed: 700,
	  prevArrow: szobaPrev,
	  nextArrow: szobaNext,
	  asNavFor: szobaCarouselNav
  });

	szobaCarouselNav.slick({
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  asNavFor: szobaCarousel,
	  dots: false,
	  centerMode: true,
	  focusOnSelect: true,
	  arrows:false
	});
callSzobaCarouselSvg();			
}
$(".szoba").each(szobaCarousel);


function callSzobaCarouselSvg(){
	$(".szoba-carousel .slick-slide").each(function(){
  $(this).Svgenerate({
    imgMask:"on",
    setToImg:"on",
    dropShadow: "on",
    blur:3,
    dX:5,
    dY:5,
    opacity:0.3,
    rangeX:0.98,
    rangeY:0.93
  });
});

$(".szoba-carousel-nav .slick-slide").each(function(){
  $(this).Svgenerate({
    imgMask:"on",
    setToImg:"on",
    dropShadow: "on",
    blur:3,
    dX:20,
    dY:20,
    opacity:0.3,
    rangeX:0.93,
    rangeY:0.93
  });
});
}


/*
 * review-k
 */

/*felvitt reviewk*/


function reviewRating(){
	var ratingNum = $(this).data("rating");

	$(this).width(ratingNum*30);
}

$(".star-rating").each(reviewRating);

function callRevCardImgj(){
	$(".review-card-img").each(function(){
  $(this).Svgenerate({
    imgMask:"on",
    setToImg:"on"
  });
});
}

callRevCardImgj();


$(".add-review input[type=\"submit\"]").Svgenerate({
  rangeX:0.94,
  rangeY:0.91,
  fill: "#d5d5d5"
});

/*gender switch*/
$(".gender-switch").on("click",function(){
	if($("#male").is(":checked")){
		$(this).parent().velocity({backgroundPositionX: 0});
	}
	else if($("#female").is(":checked")){
		$(this).parent().velocity({backgroundPositionX: -150});
	}
});







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

callSzobaCarouselSvg();
callRevCardImgj();

    }               
}
 resizeend();


});// doc ready



