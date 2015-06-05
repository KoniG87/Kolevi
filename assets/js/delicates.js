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
    speed: 700,
	  prevArrow: delicatesrolPrev,
	  nextArrow: delicatesrolNext,
	});

	callDelicatesCarouselSvg();
}

delicatesCarousel();

function callDelicatesCarouselSvg(){
if (mL.matches) {
  // desktop
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
/*    dropShadow: "on",
    blur:5,
    dX:5,
    dY:38,
    opacity:0.4*/
  });
});
}
else{
  // mobile & tablet
$(".delicates-slide-img").each(function(){
  $(this).Svgenerate({
    bottomFixed: "on",
    imgMask:"on",
    setToImg:"on",
    dropShadow:"off",
    rangeX:0.95,
    rangeY:0.88,
    midmove: 0.3
  });
});


$(".delicates-slide>aside").each(function(){
  $(this).Svgenerate({
    topFixed: "on",
    rangeX:0.96,

  });
});
}


}


/* BOLT ACCORDION */

var alapOddBolt = {
		rotateX:"-90deg",
		rotateZ:0,
    scaleX: 1,
    scaleY: 1,
		marginTop:"-2.5rem",
		backgroundColor:"#ddd"


       },
      alapEvenBolt = {
		rotateX:"90deg",
		rotateZ:0,
    scaleX: 1,
    scaleY: 1,
		marginTop:"-2.5rem",
		backgroundColor:"#f5f5f5"


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
    scaleX: 1,
    scaleY: 1,
		marginTop:"-1.5rem",
		backgroundColor:"#b4b4b4"


       },
      alapEvenBoltSubkateg = {
		rotateX:"90deg",
		rotateZ:0,
    scaleX: 1,
    scaleY: 1,
		marginTop:"-1.5rem",
		backgroundColor:"#ccc"

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
       if (thisOne.parent().find(">ul").hasClass("bolt-subkateg-is-open")) {
       thisOne.parent().find(".bolt-subkateg-is-open").prev('li').click();
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
    $("#bolt .bolt-acco>li:nth-of-type(odd)").velocity(alapOddBolt,1,spring);
    $("#bolt .bolt-acco>li:nth-of-type(even)").velocity(alapEvenBolt,1,spring);
    // CLICK
    $("#bolt .bolt-acco-head").click(boltAccordionCLICK).click(function(){
      setTimeout(function(){ refreshWaypoints(); }, 1400);
    });

// subkateg
    $("#bolt .bolt-acco>ul li:nth-of-type(odd)").velocity(alapOddBoltSubkateg,1,spring);
    $("#bolt .bolt-acco>ul li:nth-of-type(even)").velocity(alapEvenBoltSubkateg,1,spring);
    // CLICK
    $("#bolt .bolt-acco>li").click(boltAccordionListItemCLICK).click(function(){
      setTimeout(function(){ refreshWaypoints(); }, 1400);
    });
}



$("#bolt .bolt-acco li").on("click",function(){
  $("#bolt .bolt-acco li").removeClass("bolt-acco-active"); // leveszi mindenről
  $(this).addClass("bolt-acco-active"); //hozzáadja ehhez
    if($(this).is("#bolt .bolt-acco>ul>li")){ // ha subkateg akkor:
      $(this).parent().prev("li").addClass("bolt-acco-active"); //hozzáadja az előző list-itemhez is
    }

});



boltAccordion();




  function delicatesrolAccoClick(){
  var thisOne = $(this);
  thisParent = thisOne.parent().parent();
  var liIndex = $(this).index();

  function kattKezelo(target){
        if($("#bolt "+target+" .bolt-acco-head").hasClass("bolt-is-open")){
          if(!$("#bolt "+target+" .bolt-acco").find(">li:nth-of-type("+liIndex+")").hasClass("bolt-acco-active")){
            $("#bolt "+target+" .bolt-acco").find(">li:nth-of-type("+liIndex+")").click();
          }
        }
        else{
          $("#bolt "+target+" .bolt-acco-head").click();
          $("#bolt "+target+" .bolt-acco").find(">li:nth-of-type("+liIndex+")").click();
        }
  }
  $("#bolt").velocity("scroll", {
            duration: 2000,
            easing: "ease",
            offset:80,
            complete:function(){
              /*alert("im done");*/
              if(thisParent.hasClass("eheto")){
                kattKezelo(".eheto");
              }
              else if(thisParent.hasClass("ihato")){
                kattKezelo(".ihato");
              }
              else if(thisParent.hasClass("nemeheto")){
                kattKezelo(".nemeheto");
              }
            }
        });
  }

$(".delicatesrol-acco .bolt-acco>li").click(delicatesrolAccoClick);

/* Bold Grid */

$(".eheto .bolt-acco-head, .bolt-grid>h3.eheto-label").each(function(){
  $(this).Svgenerate({
    bottomFixed:"on",
    rangeX:0.98,
    rangeY:0.96,
    fill: "#e05a25"
  });
});

$(".ihato .bolt-acco-head, .bolt-grid>h3.ihato-label").each(function(){
  $(this).Svgenerate({
    bottomFixed:"on",
    rangeX:0.98,
    rangeY:0.96,
    fill: "#795f86"
  });
});

$(".nemeheto .bolt-acco-head, .bolt-grid>h3.nemeheto-label").each(function(){
  $(this).Svgenerate({
    bottomFixed:"on",
    rangeX:0.98,
    rangeY:0.96,
    fill: "#186c9b"
  });
});


function callBoltGridElements(){
$(".bolt-grid-element-img").each(function(){
  $(this).Svgenerate({
    imgMask:"on",
    setToImg:"on",
    dropShadow: "on",
    blur:3,
    dX:40,
    dY:40,
    opacity:0.2,
    rangeX:0.93,
    rangeY:0.93
  });
});
}

callBoltGridElements();


/* bolt-item-open */

//open
function boltItemOpen(){
  $(".overlay-bolt").addClass("bolt-item-open");
  $("html, body").addClass("no-scroll");
}

//close
function boltItemClose(){
	$(".overlay-bolt").removeClass("bolt-item-open");
  $("html, body").removeClass("no-scroll");
}




$(".bolt-grid-element").on("click",function(event){
	event.preventDefault();
	boltItemOpen();

/*
IDE EJAKULÁLD AZ AJAXAL!
*/
itemCarousel();
  $(".item-q input").Svgenerate({
    rangeX:0.97,
    rangeY:0.94,
    fill: "#fff",
    rightFixed: "on"
  });
  $(".item-q-up").Svgenerate({
    fill: "#000",
    rightFixed: "on",
    topFixed: "on"
  });
  $(".item-q-down").Svgenerate({
    fill: "#000",
    rightFixed: "on",
    bottomFixed: "on"
  });

  $(".bolt-item-info button").Svgenerate({
  rangeX:0.94,
  rangeY:0.91,
});

});

$(".bolt-item-close").on("click",function(){
	boltItemClose();
  checkoutClose();
});


/* Item slider */

function itemCarousel(){

var itemPrev = "<svg class=\"icon icon-nyil-balra slick-prev\"><use xlink:href=\"#icon-nyil-balra\"></use></svg>";
var itemNext = "<svg class=\"icon icon-nyil-jobbra slick-next\"><use xlink:href=\"#icon-nyil-jobbra\"></use></svg>";



$(".bolt-item-slider").slick({ 
	  adaptiveHeight: true,
	  speed: 700,
	  prevArrow: itemPrev,
	  nextArrow: itemNext,
	  asNavFor: $('.bolt-item-slider-nav')
  });

	$('.bolt-item-slider-nav').slick({
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  asNavFor: $(".bolt-item-slider"),
	  dots: false,
	  centerMode: true,
	  focusOnSelect: true,
	  arrows:false
	});
callitemCarouselSvg();
setTimeout(function(){
  $(".bolt-item-slider-nav .slick-center").click(); 
},200);

}



function callitemCarouselSvg(){
$(".bolt-item-slider .slick-slide").each(function(){
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

$(".bolt-item-slider-nav .slick-slide").each(function(){
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


/* item quantity */

  var qValue = $(".item-q>input").val();

  $(".item-q-up").on("click",function(){
    $(".item-q>input").val(parseInt($(".item-q>input").val())+1);
  });
  $(".item-q-down").on("click",function(){
    if($(".item-q>input").val() != 1){
       $(".item-q>input").val(parseInt($(".item-q>input").val())-1);
    }
   
  });



/* Hasonló termékek */

function callHasonloGridElements(){
$(".hasonlo-grid-element-img").each(function(){
  $(this).Svgenerate({
    imgMask:"on",
    setToImg:"on",
    dropShadow: "on",
    blur:3,
    dX:40,
    dY:40,
    opacity:0.2,
    rangeX:0.93,
    rangeY:0.93
  });
});
}

callHasonloGridElements();


/* CHECKOUT */

/* checkout-open */
//open
function checkoutOpen(){
  $(".overlay-checkout").addClass("overlay-checkout-open");
  $("html, body").addClass("no-scroll");
}

//close
function checkoutClose(){
  $(".overlay-checkout").removeClass("overlay-checkout-open");
  $("html, body").removeClass("no-scroll");
}

$(".kosar").on("click",function(){
  checkoutOpen();
  refreshCheckoutSum();
});


/*checkout-item*/

function callCheckoutItem(){
  if (mL.matches){
    $(".checkout-item-img").each(function(){
    $(this).Svgenerate({
      rightFixed: "on",
      imgMask:"on",
      setToImg:"on",
      dropShadow: "on",
      blur:5,
      dX:0,
      dY:0,
      opacity:0.4
    });
  });


  $(".checkout-item-details").each(function(){
    $(this).Svgenerate({
      leftFixed: "on",
      rightFixed: "on",
      fill:"#fff",
      rangeY:0.90,
      dropShadow: "on",
      blur:5,
      dX:0,
      dY:0,
      opacity:0.4
    });
  });


  $(".checkout-item-remove").each(function(){
    $(this).Svgenerate({
      leftFixed: "on",
      dropShadow: "on",
      blur:5,
      dX:0,
      dY:0,
      opacity:0.4
    });
  });
}
}

callCheckoutItem();

/* sum cost */

function checkoutSum(){
  var sum = 0;
  $('.checkout-item').each(function(){
    sum += parseInt($(this).find('.checkout-item-cost').text());
  });
 return sum;
}

function refreshCheckoutSum(){
  $(".sum-cost").text(checkoutSum);
}


/* remove item*/

$(".checkout-item-remove").on("click", function(){
  var thisOne = $(this);
  var thisItem = thisOne.parent();
  var biztostorlod = confirm("Biztosan törli a kiválasztott elemet?");
  if (biztostorlod == true){
        $(".checkout-container").addClass("no-scroll");
        thisItem.css({zIndex:9999});
        thisItem.velocity({ translateY: -30 },{ easing: "easeOut" }, 0.20).velocity({ translateY: 1000, rotateZ:"-30deg"},{opacity:0},{ easing: "easeInCirc" }, 0.80 ).delay(300).velocity({height:0},{duration:300,complete:function(){
          thisItem.remove();
          refreshCheckoutSum();
          $(".checkout-container").removeClass("no-scroll");
        }});
  }
});

/* input formák */
function callCheckoutInputSvg(){
  $(".checkout-input-svg").each(function(){
  $(this).Svgenerate({
    dropShadow: "on",
    fill:"#fff",
    blur:10,
    dX:0,
    dY:0,
    opacity:0.4
  });
});
}
callCheckoutInputSvg();

/* gomb formák */

$(".checkout-finish button, .checkout-finish div").Svgenerate({
  rangeX:0.94,
  rangeY:0.91,
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

/*delicates*/
setTimeout(function(){
callDelicatesCarouselSvg();
callBoltGridElements();
callHasonloGridElements();
callCheckoutItem();
itemCarousel();
callCheckoutInputSvg();
}, 200);

    }               
}

});

/*
 *  JS MEDIA QUERY
 */
if (matchMedia) {
        var mM = window.matchMedia('(max-width: 30em)');
        var mT = window.matchMedia('(max-width: 50em) and (min-width: 30em)');
        var mL = window.matchMedia('(min-width: 50em)');
        // var mBig = window.matchMedia('(min-width: 64.375em)');

        mM.addListener(matchMobile);
        mT.addListener(matchTablet);
        mL.addListener(matchLaptop);
        // mBig.addListener(matchBig);

        matchMobile(mM);
        matchTablet(mT);
        matchLaptop(mL);
        // matchBig(mBig);
    }

// media query change
    function matchMobile(mM) {
        if (mM.matches) {
        }

    }
    function matchTablet(mT) {
        if (mT.matches) {

        }

    }
    function matchLaptop(mL) {
        if (mL.matches) {
             onDesktop = true;
      /*      callDelicatesCarouselSvg();*/
        }
        else {
            onDesktop = false;
/*            callDelicatesCarouselSvg();*/
        }
    }