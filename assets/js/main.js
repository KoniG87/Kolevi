function callBoltGridElements(){
$(".bolt-grid-element-img").each(function(){
  $(this).Svgenerate({
    thumb: true,
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
function colorizeCategoryLabel(){
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
}
/*checkout-item*/

function callCheckoutItem(){
  if (mL.matches){
    $(".checkout-item-img").each(function(){
    $(this).Svgenerate({
      rightFixed: "on",
      thumb:true,
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
// refresh waypoint (ha display:none-ból megjelentek valamit akkor be kell frissteni, különben behal ez a fos.)
function refreshWaypoints(){
  $.waypoints('refresh');
} 

/*function measureHeight(target){
  $(target).addClass("measure");
  var actualHeight = $(target).height();
  $(target).removeClass("measure");

  return actualHeight;
 }
*/

/* langselect english kamu */

/* TODO: /kolevit/ lecserélni /-re */
if ( window.location.pathname == '/kolevi/' ){
  $(".landing-logo-container .info-black>a").on("click",function(event){
      event.preventDefault();
      window.location.replace("/kolevi/vendeglo#footer");
  });
}

function engPopup(){
  
  var engPopupBox = $('<div/>').addClass('eng-popup-box').html("<p>The english version of the site is comming soon! ...But you can</p><a target='_blank' href='requestHandler.php'><svg class='icon icon-letoltes'><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='#icon-letoltes'></use></svg>Download the menu here</a>");
  $(".eng").append(engPopupBox);
  $('.eng-popup-box').css({
      width:200,
      height:200,
      backgroundColor:'#ddd',
      position: 'absolute',
      top:0,
      left:-100,
      zIndex: 99999,
      color:'#000',
      padding: 16,
      display:'none',
      fontSize:'120%',
      boxShadow: '0 0 10px rgba(0,0,0,.2)'
    }).on("click",function(event){
    event.stopPropagation();
  });
    $('.eng-popup-box a').css({
      backgroundColor: '#000',
      color: '#fff',
      textDecoration: 'none',
      display: 'block',
      padding: 10,
      paddingLeft:30,
      position: 'relative',
      fontSize: '90%'
    });
    $('.eng-popup-box svg').css({
      position: 'absolute',
      fontSize: 40,
      left: -5,
      top: 10
    });

    $(document).on("click",function(){
      $('.eng-popup-box').velocity("transition.slideDownOut", 600);
    });
}


$(".eng").on("click",function(event){
  event.preventDefault();
  event.stopPropagation();
 engPopup();
 $('.eng-popup-box').velocity("transition.slideUpIn", 1000);
});







$(document).ready(function(){
  var onDesktop = true;

Pace.on("done", function(){
  setTimeout(function(){ refreshWaypoints(); }, 100);
});


/*
 * RETINA KÉP CSERÉLŐK
 */
 
function loadRetina(targetParent, target, attribute){
         if (window.devicePixelRatio > 1) {
        targetParent.find(target).each(function(){
            var kepnev = $(this).attr(attribute);
            kepnev = kepnev.replace(".jpg","@2x.jpg");
            kepnev = kepnev.replace(".png","@2x.png");
            $(this).attr(attribute,kepnev);
        });
     }
}

loadRetina($(".copyright"), "img", "src");

/*
 *  RANDOM SVG GENERÁLÓ 
 */
 
var maskUrlIndex = 0;
  jQuery.fn.extend({
    Svgenerate: function (options){
        var settings = $.extend({
            thumb: false,
            imgMask: "off",
            rangeX : 0.95,
            rangeY : 0.95,
            midmove:0.4,
            fill: "#000",
            topFixed: "off",
            bottomFixed: "off",
            rightFixed: "off",
            leftFixed: "off",
            aspectRatio: "none",
            dropShadow: "off",
            dX: -10,
            dY: 10,
            blur: 5,
            opacity:0.8,
            setToImg: "off",
            strokeColor: "rgba(0,0,0,0)",
            strokeWidth: 0
        }, options);
      
      
        var asRatio = "none";
        if(settings.aspectRatio == "none"){
          asRatio = "none";
        }
        else if(settings.aspectRatio != "none"){
          // ezt teljesen felesleges megadni nem csinál semmit kép esetében szal mind1 is..
          // Inkább a setToImg-t kell használni.
        }
        var t = $(this),
        pW = t.actual( 'width' ),
        pH = t.actual( 'height' );        

       
        var sourceImg = t.find("img"),
        imgSrc = sourceImg.attr("src");

      if(settings.imgMask == "on" || settings.setToImg == "on"){

        
        if(settings.setToImg == "on"){
          var imgRealWidth = imgRealSize(sourceImg).width;
          var imgRealHeight = imgRealSize(sourceImg).height;
              if(imgRealWidth == 0 || imgRealHeight == 0){
                var hiba = '';
                if(imgSrc == ''){
                   hiba = 'nincs hozzá rendelve kép!';
                }
                   
                console.log(imgSrc+"  -betöltése lemaradt a javascripthez képest.");
                if(settings.thumb){
                imgRealWidth = 1;
                imgRealHeight = 1;
                }
                else{
                imgRealWidth = 1.6;
                imgRealHeight = 1;
                  
                }
              }
          var realImgRatio = (imgRealWidth) / (imgRealHeight);
          var setParentToImgRatio = pW / realImgRatio;
          t.height(setParentToImgRatio);
          pH = setParentToImgRatio;

          }
      }
      
        var hasBeenAppended = false,
        svgElDropShadow = "<svg class='svg-dropShadow'></svg>",
        svgElMaskedImg = "<svg class='svg-maskedImg'></svg>";
        if(settings.dropShadow == "on" && t.find(".svg-dropShadow").length === 0){
          t.append(svgElDropShadow);
        }
        if(settings.imgMask == "on" && t.find(".svg-maskedImg").length === 0){
          t.append(svgElMaskedImg);
        }
        var maskImgClass = "";    
        if(settings.imgMask == "on"){
          maskImgClass = "class='svg-maskedImg'";
        }
       /* pH = t.actual( 'height' );*/
        var mySVG = "<svg " + maskImgClass + " xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 " + pW + " " + pH + "' preserveAspectRatio='" + asRatio + "' >";           
        var shadow = "<svg class='svg-dropShadow' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 " + pW + " " + pH + "' preserveAspectRatio='" + asRatio + "' style='position:absolute;z-index:-1;left:" + settings.dX + "px;top:" + settings.dY + "px;filter: blur(" + settings.blur + "px);-webkit-filter: blur(" + settings.blur + "px);' >",
        rb,
        mb,
        lb,
        lm,
        lt,
        mt,
        rt,
        rm,
        csuszka = function(){
          var min = 2-(2*settings.midmove);
          var max = 2+(2*settings.midmove);
          var randNum = (Math.random() * (max - min )) + min;
          return randNum;
        },
        ratio = pW/pH;
        if(ratio == "Infinity"){
          ratio = 1;
        }
        var randomX = function(){
          var min = settings.rangeX;
          var max = 1;
          var randNum = (Math.random() * (max - min )) + min;
          return randNum;
        },
        randomY = function(){
          var min =settings.rangeY;
          var max = 1;
          var randNum = (Math.random() * (max - min )) + min;
          return randNum ;
        };

        rb = pW*randomX() + "," + pH*randomY();
        mb = pW*randomX() / csuszka() + "," + pH*randomY();
        lb = pW-pW*randomX() + "," + pH*randomY();
        lm = pW-pW*randomX() + "," + pH*randomY() / csuszka();
        lt = pW-pW*randomX() + "," + (pH-pH*randomY());
        mt = pW*randomX() / csuszka() + "," + (pH-pH*randomY());
        rt = pW*randomX() + "," + (pH-pH*randomY());
        rm = pW*randomX() + "," + pH*randomY() / csuszka();
      
      if(settings.topFixed == "on"){
        lt = 0 + "," + 0;
        mt = pW / 2 + "," + 0;
        rt = pW + "," + 0;
      }
      if(settings.bottomFixed == "on"){
        rb = pW + "," + pH;
        mb = pW / 2 + "," + pH;
        lb = 0 + "," + pH;
      }
      if(settings.rightFixed == "on"){
        rb = pW + "," + pH;
        rt = pW + "," + 0;
        rm = pW + "," + pH / 2;
      }
      if(settings.leftFixed == "on"){
        lt = 0 + "," + 0;
        lb = 0 + "," + pH;
        lm = 0 + "," + pH / 2;
      }
      shadow += "<defs>";
      shadow += "</defs>";
      
      
      mySVG += "<defs>";
      var points = "points='" + rb + " " + mb + " " + lb + " " + lm + " " + lt + " " + mt + " " + rt + " " + rm + " " + "'" ;
      var polygon = "<polygon   fill='" + settings.fill + "' stroke='" + settings.strokeColor + "' stroke-width='" + settings.strokeWidth + "' " + points + " />";
      var polygonShadow = "<polygon  fill='rgba(0,0,0," + settings.opacity + ")' " + points + " />";
      if(settings.imgMask == "on"){
        maskUrlIndex++;
        mySVG += "<clipPath id='img-mask-"+maskUrlIndex+"'>"+ polygon +"</clipPath>";
      }
      
    mySVG += "</defs>";
      

      function imgRealSize(img) {
          var $img = $(img);
          if ($img.prop('naturalWidth') === undefined) {
            var $tmpImg = $('<img/>').attr('src', $img.attr('src'));
            $img.prop('naturalWidth', $tmpImg[0].width);
            $img.prop('naturalHeight', $tmpImg[0].height);
          }
          return { 'width': $img.prop('naturalWidth'), 'height': $img.prop('naturalHeight') };
        }
      
      
      if(settings.imgMask == "on"){
        mySVG += "<image height='100%' width='100%' clip-path='url(#img-mask-"+maskUrlIndex+")' xlink:href='" + imgSrc + "'/>";
      }
      else{
        mySVG += polygon;
      }
    shadow += polygonShadow;
    shadow += "</svg>";  
    mySVG += "</svg>";

    var b64 = 'data:image/svg+xml;base64,' + window.btoa(mySVG),
        toImg = '<img src="'+b64+'">',
        url = 'url("' + b64 + '")';
     //IMAGE MASK 
      if(settings.imgMask == "on"){
        t.find(".svg-maskedImg").replaceWith(mySVG);
        if(settings.dropShadow == "on"){
          t.find(".svg-dropShadow").replaceWith(shadow);
        }
      }
      //EVERYTHING ELSE
      else{
       if(settings.dropShadow == "on"){
          t.find(".svg-dropShadow").replaceWith(shadow);
         //alert("!!!");
        }
        t.css({'backgroundImage': url});
      }

    return this;

    }
  });


/*
 *  MOBIL MENÜ
 */
$(".navicon-button").Svgenerate();


function foldingMobilMenu(){
  var wrapper = $("#wrapper");
  var trigger = $("#trigger");
// szerintem ezt majd megcsinálom velocityvel mert gyorsabb...
  trigger.on("click",function(event){
    event.stopPropagation();
    $(this).toggleClass("open-mobile-nav");
    wrapper.toggleClass("push-content");
    $("body, html").toggleClass("no-scroll");
  });

  $(".side-nav").on("click",function(event){
  event.stopPropagation();
    });
  $(document).on("click", function() { 
    if (wrapper.hasClass("push-content")) {
        trigger.removeClass("open-mobile-nav");
        wrapper.removeClass("push-content");
        $("body, html").removeClass("no-scroll");
    }
  });
}
foldingMobilMenu();
$(".side-nav-inner .nav-info a, .side-nav-inner ul a").on("click",function(){
  setTimeout(function(){
    $("#trigger").click();
  },200);
});
/*
 *  MOBIL LANDING ANIMÁCIÓK
 */

  var mDeli= $(".mobile-delicates"),
  mVend= $(".mobile-vendeglo"),
  mKert= $(".mobile-kert"),
  mApart= $(".mobile-apartman");

function mobilLandingAnim(){
  var thisOne = $(this);
  NoAnim($(".mob-trigger"));
  $(".mobile-landing-container").addClass("its-out");

thisOne.css("z-index","999");
$(".kamufos").css("z-index","99");

  if (thisOne.is(mVend)) {

      mVend.velocity({bottom: 0},{duration: 2000, easing: [ 300, 20 ]});
      mDeli.velocity({left: -380},{duration: 2000, easing: [ 300, 20 ]});
      mApart.velocity({left: -95, top:-120},{duration: 2000, easing: [ 300, 20 ]});
      mKert.velocity({right: -350},{duration: 2000, easing: [ 300, 20 ]});

      mVend.on("click",function(event){
        event.stopPropagation();
      });
  }
  else if(thisOne.is(mDeli)){
    mDeli.velocity({left: 0},{duration: 2000, easing: [ 300, 20 ]});
    mKert.velocity({right: -350},{duration: 2000, easing: [ 300, 20 ]});
    mVend.velocity({bottom: -400},{duration: 2000, easing: [ 300, 20 ]});
    mApart.velocity({left: -95, top:-120},{duration: 2000, easing: [ 300, 20 ]});
    mDeli.on("click",function(event){
  event.stopPropagation();
});
  }
  else if(thisOne.is(mApart)){
    mApart.velocity({left: 100},{duration: 2000, easing: [ 300, 20 ]});
    mDeli.velocity({left: -380},{duration: 2000, easing: [ 300, 20 ]});
    mKert.velocity({right: -350},{duration: 2000, easing: [ 300, 20 ]});
    mVend.velocity({bottom: -400},{duration: 2000, easing: [ 300, 20 ]});
    mApart.on("click",function(event){
  event.stopPropagation();
});
  }
  else if(thisOne.is(mKert)){
    mKert.velocity({right: 16},{duration: 2000, easing: [ 300, 20 ]});
    mVend.velocity({bottom: -400},{duration: 2000, easing: [ 300, 20 ]});
      mDeli.velocity({left: -380},{duration: 2000, easing: [ 300, 20 ]});
      mApart.velocity({left: -95, top:-120},{duration: 2000, easing: [ 300, 20 ]});
    mKert.on("click",function(event){
  event.stopPropagation();
});
  }
}
function backToStart(){
      mVend.velocity({bottom: -260},{duration: 2000, easing: [ 300, 20 ]});
      mDeli.velocity({left: -273},{duration: 2000, easing: [ 300, 20 ]});
      mApart.velocity({left: -95, top:12},{duration: 2000, easing: [ 300, 20 ]});
      mKert.velocity({right: -264},{duration: 2000, easing: [ 300, 20 ]});
  }

$(".mob-trigger").on("click",mobilLandingAnim);

$(".kamufos").on("click",function(){
  if($(".mobile-landing-container").hasClass("its-out")){
      backToStart();
      $(".mobile-landing-container").removeClass("its-out");
      $(".kamufos").css("z-index","-1");
      $(".mob-trigger").css("z-index","auto");
    }
});





// sugó
$(".mobile-sugo-trigger").one("click",barkasSugo);

function barkasSugo(){
  $(".mobile-sugo").velocity({right: "20%"},{duration: 1600, easing: [ 300, 20 ]});
    setTimeout(function(){ 
    $(".mobile-sugo-bubble").css("transform","scale(1)");
   }, 1000);
    setTimeout(function(){ 
    $(".mobile-sugo-bubble").css("transform","scale(0)");
   }, 3500);
    $(".mobile-sugo").delay(3000).velocity({right: "100%"},{duration: 1600, easing: [ 300, 20 ]});

    setTimeout(function(){ 
    $(".mobile-sugo-trigger").one("click",barkasSugo);
   }, 6000);
    
}






/*
 *  LANDING DESKTOP -- HEADER
 */

 function landingMeretezo(){
   var winHeight = $(window).height();
   // var headerHeight = $("header").height();
  $(".landing-container").height(winHeight);
  $(".mobile-landing-container").height(winHeight);
 }
 
landingMeretezo();

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
        landingMeretezo();
        $(".section-label").each(sectionLabels);


    setTimeout(function(){ 
    callCikkKepek();
   }, 200);

callGallery();
callThumbs();
$(".rend-slide").each(function(){
  $(this).Svgenerate({
    imgMask:"on",
    setToImg:"on",
    dropShadow: "on",
    blur:0,
    dX:-10,
    dY:10,
    opacity:1,
    rangeX:0.94,
    rangeY:0.92
  });
});
$(".rolunk-visible").each(function(){
  $(this).find(".roulunk-kep-container").Svgenerate({
    imgMask:"on",
    setToImg:"on"
  });
});
$(".rend-contact-kep-container").Svgenerate({
  imgMask:"on",
  setToImg:"on",
  rangeX:0.94,
  rangeY:0.94
});
  $(".sitckyNav").Svgenerate({
    rightFixed:"on",
    leftFixed:"on",
    topFixed:"on",
    dropShadow: "on",
    blur:20,
    dX:0,
    dY:20,
    opacity:0.5,
    rangeY:0.85,
    midmove:0.4,
  });

callFooter(0.95);


/*kert*/

$(".rolunk-kert-kep").Svgenerate({
    imgMask:"on",
    setToImg:"on",
    dropShadow: "on",
    blur:5,
    dX:20,
    dY:20,
    opacity:0.25,
    rangeX:0.8,
    rangeY:0.9
  });

    }               
}

// Barkas

var alapOddBarkas = {
        rotateX:"90deg",
        rotateZ:0,
        rotateY:0,
        scaleX:0.8,
        scaleY:0.8,
        marginBottom:"-3rem"

       },
      alapEvenBarkas = {
          rotateX:"-90deg",
         rotateZ:0,
         rotateY:0,
        scaleX:0.8,
        scaleY:0.8,
        marginBottom:"-3rem"

       },
      nyitvaOddBarkas = {
          rotateX:"10deg",
         rotateZ:0,
         rotateY:0,
        scaleX: 1,
        scaleY: 1,
        marginBottom:0

       },
      nyitvaEvenBarkas = {
          rotateX:"-10deg",
         rotateZ:0,
         rotateY:0,
        scaleX: 1,
        scaleY: 1,
        marginBottom:0
       },
      springBarkas = [300,22],
      durationBarkas = 2000;
    $(".barkas ul li:nth-child(odd)").velocity(alapOddBarkas,1,springBarkas);
    $(".barkas ul li:nth-child(even)").velocity(alapEvenBarkas,1,springBarkas);

function barkasAccordionCLICK(){   
    $(this).toggleClass("barkas-open");

    if($(this).hasClass("barkas-open")){
         $(this).find("li:nth-child(odd)").velocity("stop");
         $(this).find("li:nth-child(even)").velocity("stop");
         $(".barkas").velocity("stop");

         $(this).find("li:nth-child(odd)").velocity(nyitvaOddBarkas,durationBarkas,springBarkas);
         $(this).find("li:nth-child(even)").velocity(nyitvaEvenBarkas,durationBarkas,springBarkas);
         $(".barkas").velocity({left: 0}, {duration: 3000, easing: [ 300, 24 ]});
      }
    else{
         $(this).find("li:nth-child(odd)").velocity("stop");
         $(this).find("li:nth-child(even)").velocity("stop");
         $(".barkas").velocity("stop");

        $(this).find("li:nth-child(odd)").velocity(alapOddBarkas,1000);
        $(this).find("li:nth-child(even)").velocity(alapEvenBarkas,1000);
    }
}

function barkasAccordionClose(){   
        $(this).removeClass("barkas-open"); 

        $(this).find("li:nth-child(odd)").velocity("stop");
        $(this).find("li:nth-child(even)").velocity("stop");
        $(".barkas").velocity("stop");

        $(this).find("li:nth-child(odd)").velocity(alapOddBarkas,1000);
        $(this).find("li:nth-child(even)").velocity(alapEvenBarkas,1000);
        $(".barkas").velocity({left: 120}, {duration: 3000, easing: [ 300, 24 ]});
}

function barkasAccordionOpen(){   
         $(this).addClass("barkas-open");

         $(this).find("li:nth-child(odd)").velocity("stop");
         $(this).find("li:nth-child(even)").velocity("stop");
         $(".barkas").velocity("stop");

         $(this).find("li:nth-child(odd)").velocity(nyitvaOddBarkas,durationBarkas,springBarkas);
         $(this).find("li:nth-child(even)").velocity(nyitvaEvenBarkas,durationBarkas,springBarkas);
         $(".barkas").velocity({left: 0}, {duration: 3000, easing: [ 300, 24 ]});

}

$(".barkas").click(barkasAccordionCLICK).click(function(){
  setTimeout(function(){ refreshWaypoints(); }, 1400);
});
$(".barkas").on("mouseenter",barkasAccordionOpen);
$(".barkas").on("mouseleave",barkasAccordionClose);
/*$(".barkas").hoverIntent(barkasAccordionOpen,barkasAccordionClose);*/

// barkasAccordion();
/*$(".barkas").draggable({ axis: "x" },{ containment: "parent" });*/


/*
 *  LANDING ANIMÁCIÓK
 */

  var osszes = $(".illustration-container .hoverEffect"),
      vend = $(".vendeglo"),
      delic = $(".delicates"),
      apart = $(".apartman"),
      kert = $(".kert"),
// vendéglő
      bkutya = vend.find(".vend-bokor-kutya"),
      keriFL = vend.find(".vend-kerites-front-left"),
      vendFront = vend.find(".vend-front"),
      fa = vend.find(".vend-fa"),
      vendKihuzo = vend.find(".vend-kihuzo"),
// kert
      keriFR = kert.find(".kert-kerites-front-right"),
      bokor2 = kert.find(".kert-bokor-sima2"),
      bokorV = kert.find(".kert-bokor-vodor"),
      bokor1 = kert.find(".kert-bokor-sima"),
      keriSide = kert.find(".kert-kerites-side"),
      faVilla = kert.find(".kert-fa-villa"),
      keriTop = kert.find(".kert-kerites-top"),
      kertKihuzo = kert.find(".kert-kihuzo"),
      kertAsztal = kert.find(".kert-asztal"),
      kertFiu = kert.find(".kert-fiu"),
      kertLany = kert.find(".kert-lany"),
//delicates
      kemeny = delic.find(".delic-kemeny"),
      deliSide = delic.find(".delic-side"),
      deliFront = delic.find(".delic-front"),
      fogaskerek = delic.find(".delic-fogaskerek"),
      delicKihuzo = delic.find(".delic-kihuzo"),
//apartman
      apartFront = apart.find(".apartman-front"),
      apartKihuzo = apart.find(".apartman-kihuzo-container");

      
      
  var fekszik = {
                  translateZ: 0, 
                  rotateY:0,
                  rotateX:"30deg",
                  rotateZ: 0
                  };

  var all = {
                  translateZ: 0, 
                  rotateY:0,
                  rotateX:"-15deg",
                  rotateZ: 0
                  };
  var alap = {
                  translateZ: 0, 
                  rotateY:0,
                  rotateX:0,
                  rotateZ: 0
                  };



var dur = 1200;
var easing = {duration: dur, easing: [ 300, 20 ]};

  // alap animáció forceing 

   osszes.velocity(alap);
  $(".hovInt").hoverIntent({
    over:hoverOn,
    out:hoverOff,
    interval:250
  });
  delicKihuzo.velocity({rotateZ:"90deg"}, 0);

    // $(".illustration-container>.hoverEffect").on("mouseleave",function(){
				// hoverOff();
    //               // kihúzó vissza
        
    //   }); 

  function NoAnim(target) {
      target.velocity("stop");
    }

  function hoverOn(){
     var thisOne = $(this);
			// NoAnim(osszes);
     // thisOne.addClass("allo").velocity(all, {ease:[.48,-0.06,.6,.5]});
    
    if(thisOne.hasClass("vendeglo")){

      
     /* kemeny.velocity({rotateX:"10deg"}, {duration: 2000, easing: [ 300, 20 ]});*/
      keriTop.delay(100).velocity({rotateX:"55deg"}, easing);
      apart.delay(100).velocity({rotateX:"55deg"}, {duration: 2000, easing: [ 300, 20 ]});
     /* keriSide.delay(100).velocity({rotateX:"-20deg"}, {duration: 2500, easing: [ 300, 20 ]});*/

      delic.delay(150).velocity({rotateX:"45deg"}, easing);
      
      bokorV.delay(250).velocity(fekszik, easing);
      bokor1.delay(250).velocity(fekszik, easing);
     /* kertKihuzo.delay(250).velocity({rotateX:"45deg"}, easing);*/
      faVilla.delay(150).velocity({rotateX:"45deg"}, {duration: 2000, easing: [ 300, 14 ]});

      kertAsztal.velocity({rotateX:"35deg"}, easing);
      /*bkutya.velocity({rotateX:"-45deg"}, easing);*/
      keriFL.delay(150).velocity({rotateX:"-35deg"}, easing);
      // faVilla.delay(150).velocity({rotateX:"15deg"}, {duration: 2000, easing: [ 300, 14 ]});
      fa.delay(150).velocity({rotateX:"40deg"}, easing);
      keriFR.delay(150).velocity({rotateX:"-40deg"}, easing);
      vendFront.delay(250).velocity({rotateX:"-15deg"}, {duration: 2500, easing: [ 300, 14 ]});
      vendKihuzo.delay(500).velocity({right: -155}, {duration: dur, easing: [ 300, 25 ]});
      $(this).find(".vend-emberke1").delay(800).velocity({backgroundPositionX: -340}, {duration: dur, easing: [ 200, 20 ]});
      $(this).find(".vend-emberke2").delay(800).velocity({backgroundPositionX: -440}, {duration: dur, easing: [ 200, 20 ]});
      $(this).find(".vend-emberke3").delay(800).velocity({backgroundPositionX: -530}, {duration: dur, easing: [ 200, 20 ]});
      $(this).find(".vend-emberke4").delay(800).velocity({backgroundPositionX: -635}, {duration: dur, easing: [ 200, 20 ]});
      $(this).find(".vend-emberke5").delay(800).velocity({backgroundPositionX: -730}, {duration: dur, easing: [ 200, 20 ]});
    }
    else if(thisOne.hasClass("delicates")){
      // delic.velocity({rotateX:"-15deg"}, easing);
     /* keriSide.delay(100).velocity({rotateX:"-20deg"}, {duration: 2500, easing: [ 300, 20 ]});*/
      keriTop.delay(100).velocity({rotateX:"55deg"}, easing);
      bokorV.delay(250).velocity(fekszik, easing);
      bokor1.delay(250).velocity(fekszik, easing);
      kertAsztal.velocity({rotateX:"35deg"}, easing);
      /*kertKihuzo.delay(250).velocity({rotateX:"45deg"}, easing);*/
      faVilla.delay(150).velocity({rotateX:"45deg"}, {duration: 2000, easing: [ 300, 14 ]});
      apart.delay(100).velocity({rotateX:"55deg"}, {duration: 2000, easing: [ 300, 20 ]});


      fogaskerek.delay(200).velocity({rotateZ:"-300deg"}, {duration: 1600, complete:function(){
      delicKihuzo.velocity({rotateZ:"0deg"}, easing);
      }});
      kemeny.delay(200).velocity({bottom: 200}, {duration: 1600},{queue:false});
      bkutya.velocity({rotateX:"-65deg"}, easing);
      keriFL.delay(150).velocity({rotateX:"-110deg"}, easing);
      keriFR.delay(150).velocity({rotateX:"-110deg"}, easing);
      vendFront.velocity({rotateX:"-110deg"}, {duration: 3000, easing: [ 300, 14 ]});
      fa.delay(200).velocity({rotateX:"50deg"}, easing);
      // kertKihuzo.delay(250).velocity({rotateX:"20deg"}, easing);
      
    }
    else if(thisOne.hasClass("apartman")){
      /*keriSide.delay(100).velocity({rotateX:"-20deg"}, {duration: 2500, easing: [ 300, 20 ]});*/
      keriTop.delay(100).velocity({rotateX:"55deg"}, easing);
      bokorV.delay(250).velocity(fekszik, easing);
      bokor1.delay(250).velocity(fekszik, easing);
      kertAsztal.velocity({rotateX:"35deg"}, easing);
      /*kertKihuzo.delay(250).velocity({rotateX:"45deg"}, easing);*/
      faVilla.delay(150).velocity({rotateX:"55deg"}, {duration: 2000, easing: [ 300, 14 ]});
      // apart.delay(100).velocity({rotateX:"55deg"}, {duration: 2000, easing: [ 300, 20 ]});
      delic.delay(150).velocity({rotateX:"55deg"}, {duration: 3000, easing: [ 300, 14 ]});

      // deliSide.delay(150).velocity({transformOrigin:"left"}).velocity({rotateY:"78deg"}, easing);
      fa.delay(200).velocity({rotateX:"55deg"}, easing);
      bkutya.velocity({rotateX:"-65deg"}, easing);
      keriFL.delay(150).velocity({rotateX:"-110deg"}, easing);
      keriFR.delay(150).velocity({rotateX:"-110deg"}, easing);
      vendFront.velocity({rotateX:"-110deg"}, {duration: 3000, easing: [ 300, 14 ]});
      // faVilla.delay(150).velocity({rotateX:"15deg"}, {duration: 2000, easing: [ 300, 14 ]});

      $(this).find(".apartman-emberke1").delay(1200).velocity({backgroundPositionY: -575}, {duration: dur, easing: [ 200, 20 ]});
      $(this).find(".apartman-emberke2").delay(1200).velocity({backgroundPositionY: -573}, {duration: dur, easing: [ 200, 20 ]});
      $(this).find(".apartman-emberke3").delay(1200).velocity({backgroundPositionY: -581}, {duration: dur, easing: [ 200, 20 ]});
      apartKihuzo.delay(1000).velocity({top: -100}, {duration: 2500, easing: [ 300, 16 ]});
    }
    else if(thisOne.hasClass("kert")){
      delic.delay(150).velocity({rotateX:"55deg"}, easing);
      apart.delay(100).velocity({rotateX:"55deg"}, {duration: 2000, easing: [ 300, 20 ]});

      fa.delay(200).velocity({rotateX:"20deg"}, easing);
      // bokor2.delay(150).velocity({rotateX:"-15deg"}, easing);
      bokorV.delay(250).velocity({rotateX:"-10deg"}, easing);
      kertKihuzo.delay(400).velocity({top: -120}, {duration: dur, easing: [ 300, 24 ]});

      // bkutya.velocity({rotateX:"-65deg"}, easing);
      keriFL.delay(150).velocity({rotateX:"-110deg"}, easing);
      keriFR.delay(150).velocity({rotateX:"-110deg"}, easing);
      vendFront.velocity({rotateX:"-110deg"}, {duration: 3000, easing: [ 300, 14 ]});
      /*kertAsztal.delay(150).velocity({rotateX:"-30deg"}, easing);*/
      kertFiu.delay(250).velocity({rotateZ:"90deg"}, easing);
      kertLany.delay(250).velocity({rotateZ:"-90deg"}, easing);

      $(this).find("div[class^='kert-kisvirag']").delay(400).velocity({backgroundPositionY: -1060}, {duration: 1000});
    }
  }
  
    function hoverOff(){
      var thisOne = $(this);
       NoAnim(osszes);
if($(this).hasClass("vendeglo")){
          vendKihuzo.velocity({right: 8}).velocity(alap);
          vendFront.delay(200).velocity(alap);
          kemeny.delay(200).velocity(alap);
          fa.delay(0).velocity(alap);
          keriSide.delay(150).velocity(alap);
          keriFL.delay(150).velocity(alap);
          bkutya.delay(250).velocity(alap);
          fa.delay(250).velocity(alap);
          keriFR.delay(150).velocity(alap);
          bokor2.delay(0).velocity(alap);
          bokorV.delay(100).velocity(alap);
          bokor1.delay(0).velocity(alap);
          keriTop.delay(300).velocity(alap);
          faVilla.delay(200).velocity(alap);
          kemeny.delay(250).velocity(alap);
          apart.delay(350).velocity(alap);
          delic.delay(100).velocity(alap);
          kertKihuzo.velocity({top: 0}).velocity(alap);
          kertAsztal.delay(100).velocity(alap);
          $(this).find(".vend-emberke1").delay(200).velocity({backgroundPositionX: -380});
          $(this).find(".vend-emberke2").delay(200).velocity({backgroundPositionX: -480});
          $(this).find(".vend-emberke3").delay(200).velocity({backgroundPositionX: -580});
          $(this).find(".vend-emberke4").delay(200).velocity({backgroundPositionX: -680});
          $(this).find(".vend-emberke5").delay(200).velocity({backgroundPositionX: -780});
          apartKihuzo.delay(200).velocity({top: 0});
        }
        else if ($(this).hasClass("kert")) {
          kertKihuzo.velocity({top: 0}).velocity(alap);
          vendFront.delay(200).velocity(alap);
          vendKihuzo.velocity({right: 8}).velocity(alap);
          vendFront.delay(200).velocity(alap);
          kemeny.delay(200).velocity(alap);
          fa.velocity(alap);
          keriSide.delay(150).velocity(alap);
          keriFL.delay(150).velocity(alap);
          bkutya.delay(250).velocity(alap);
          fa.delay(250).velocity(alap);
          keriFR.delay(150).velocity(alap);
          bokor2.velocity(alap);
          bokorV.delay(100).velocity(alap);
          bokor1.velocity(alap);
          keriTop.delay(300).velocity(alap);
          faVilla.delay(200).velocity(alap);
          kemeny.delay(250).velocity(alap);
          apart.delay(350).velocity(alap);
          delic.delay(100).velocity(alap);
          kertAsztal.delay(150).velocity(alap);
          kertFiu.delay(250).velocity(alap);
          kertLany.delay(250).velocity(alap);
          apartKihuzo.delay(200).velocity({top: 0});
          kertAsztal.delay(100).velocity(alap);
          $(this).find("div[class^='kert-kisvirag']").velocity({backgroundPositionY: -950});
        }

        else if ($(this).hasClass("delicates")) {
          delicKihuzo.velocity({rotateZ:"90deg"});
          kemeny.velocity({bottom: 125});
          kertKihuzo.velocity({top: 0}).velocity(alap);
          vendFront.velocity(alap);
          vendKihuzo.velocity({right: 8}).velocity(alap);
          vendFront.velocity(alap);
          kemeny.velocity(alap);
          fa.velocity(alap);
          keriSide.velocity(alap);
          keriFL.velocity(alap);
          bkutya.velocity(alap);
          fa.velocity(alap);
          keriFR.velocity(alap);
          bokor2.velocity(alap);
          bokorV.velocity(alap);
          bokor1.velocity(alap);
          keriTop.velocity(alap);
          faVilla.velocity(alap);
          kemeny.velocity(alap);
          apart.velocity(alap);
          delic.velocity(alap);
          fogaskerek.velocity(alap);
          kertAsztal.delay(100).velocity(alap);
          apartKihuzo.delay(200).velocity({top: 0});
          
        }    
        else if ($(this).hasClass("apartman")) {
          apartKihuzo.velocity(alap);
          $(this).find(".apartman-emberke1").delay(200).velocity({backgroundPositionY: -521});
          $(this).find(".apartman-emberke2").delay(200).velocity({backgroundPositionY: -515});
          $(this).find(".apartman-emberke3").delay(200).velocity({backgroundPositionY: -523});

          vendFront.velocity(alap);
          kemeny.velocity(alap);
          fa.velocity(alap);
          keriSide.velocity(alap);
          keriFL.velocity(alap);
          bkutya.velocity(alap);
          fa.velocity(alap);
          keriFR.velocity(alap);
          bokor2.velocity(alap);
          bokorV.velocity(alap);
          bokor1.velocity(alap);
          keriTop.velocity(alap);
          faVilla.velocity(alap);
          kemeny.velocity(alap);
          apart.velocity(alap);
          delic.velocity(alap);
          kertAsztal.delay(100).velocity(alap);
          deliSide.delay(200).velocity(alap);
          apartKihuzo.delay(200).velocity({top: 0});

        }   
  }
  


/*
 *  SECTION-LABELS
 */
function sectionLabels(){
  var labelWidth = $(this).width() / 7,
  pcutOffset = labelWidth * 0.1, //10%
  cutLeft = $(this).find(".papercut-left"),
  cutRight = $(this).find(".papercut-right"),
  labelPos = $(this).data("labelpos"),
  labelFor = $(this).find("label");
  
if (mL.matches) {
  // console.log("desktop");
  cutLeft.css("left",((labelWidth) * -1) + pcutOffset).css("border-left-width",labelWidth * labelPos);
  labelFor.css("left",(labelWidth * (labelPos - 1)));
  cutRight.css("left",(labelWidth * labelPos) - pcutOffset).css("border-right-width",labelWidth * (8 - labelPos));
}

else if(mT.matches){
  // console.log("tablet");
  cutLeft.css("left",((labelWidth) * -1) + (pcutOffset * 3)).css("border-left-width",labelWidth * 3);
  labelFor.css("left",(labelWidth * (3 - 1)));
  cutRight.css("left",(labelWidth * 5) - (pcutOffset * 3)).css("border-right-width",labelWidth * 3);
}
else if(mM.matches){
  // console.log("mobile");
  cutLeft.css("left",((labelWidth) * -1) + (pcutOffset * 5)).css("border-left-width",labelWidth * 2);
  labelFor.css("left",(labelWidth * (2 - 1)));
  cutRight.css("left",(labelWidth * 6) - (pcutOffset * 5)).css("border-right-width",labelWidth * 2);
}

}





/*
 *  STICKY NAV
 */
  $(".sitckyNav").Svgenerate({
    rightFixed:"on",
    leftFixed:"on",
    topFixed:"on",
    dropShadow: "on",
    blur:20,
    dX:0,
    dY:20,
    opacity:0.5,
    rangeY:0.85,
    midmove:0.4,
  });

  $(document).scroll(function() {

      var docScrollTop = $(document).scrollTop(),
      start = $('.stickyStart'),
      stick = start.offset().top;

      if (docScrollTop > stick) {
        $(".sitckyNav").addClass("fixedattop");
        // var shiftContent = $('nav').height();
      }
      else if (docScrollTop < stick) {
        $('.sitckyNav').removeClass('fixedattop');
      }
    });
  

$(".sitckyNav .row a, .nav-info a, .terkep-container a").on("click",function(event){
    event.preventDefault();
    event.stopPropagation();
    var anchorTarget = $(this).attr("href");

$(anchorTarget).velocity("scroll", {
            duration: 2000,
            easing: "ease",
            offset:80
        });
});

// langselect
$(".langselect-container>div").on("click",function(){
  $(".langselect-container>div").removeClass("lang-selected");
  $(this).addClass("lang-selected");
});

// vissza a tetejére

function backToTop(){
    $("html").velocity("scroll", {
            duration: 1000,
            easing: "ease"
        });
}
$(".backToTop").click(backToTop);
$(".sticky-logo").on("click",function(event){
    event.preventDefault();
    backToTop();
});

// waypoint sticky fold animáció
function stickyFoldAnim(){
  $(".section-label").waypoint(function(){
     var id = "#" + $(this).parent().attr("id");
    // console.log(id);
    var target = $(".sitckyNav>.row>a[href$="+id+"] .sticky-fold");

   target.toggleClass("fold-out");
    }, { 
      offset: 70
  });
}

stickyFoldAnim();








// itallap animáció globál varik

var alapOdd = {
        rotateX:"90deg",
        rotateZ:0,
        scaleX:0.8,
        scaleY:0.8,
        marginTop:"-8rem",
        backgroundColor:"#fff",
        backgroundColorAlpha: 0.5

       },
      alapEven = {
          rotateX:"-90deg",
         rotateZ:0,
        scaleX:0.8,
        scaleY:0.8,
          marginTop:"-8rem",
        backgroundColor:"#000",
        backgroundColorAlpha: 0.1

       },
      nyitvaOdd = {
          rotateX:"10deg",
         rotateZ:0,
        scaleX: 1,
        scaleY: 1,
          marginTop:0

       },
      nyitvaEven = {
          rotateX:"-10deg",
         rotateZ:0,
        scaleX: 1,
        scaleY: 1,
          marginTop:0
       },
      spring = [20,18],
      duration = 1400;


function itallapAccordionCLICK(){    
    var thisOne = $(this);
    thisOne.toggleClass("open");
    if(thisOne.hasClass("open")){
         thisOne.parent().css("margin-bottom","-10px");
         thisOne.parent().find("li:nth-child(odd)").velocity(nyitvaOdd,duration,spring);
         thisOne.parent().find("li:nth-child(even)").velocity(nyitvaEven,duration,spring);
      }
    else{
        thisOne.parent().css("margin-bottom","0");
        thisOne.parent().find("li:nth-child(odd)").velocity(alapOdd,duration,spring);
        thisOne.parent().find("li:nth-child(even)").velocity(alapEven,duration,spring);
    }
}

function itallapAccordion(){ 
    $(".fold-list li:nth-child(odd)").velocity(alapOdd,1,spring);
    $(".fold-list li:nth-child(even)").velocity(alapEven,1,spring);

    // CLICK
    $(".itallap-head, .etel-head").click(itallapAccordionCLICK).click(function(){
      setTimeout(function(){ refreshWaypoints(); }, 1400);
    });
}





itallapAccordion();



// rendezvények




var prevA = "<svg class=\"icon icon-slider-balra slick-prev\"><use xlink:href=\"#icon-slider-balra\"></use></svg>";
var nextA = "<svg class=\"icon icon-slider-jobbra slick-next\"><use xlink:href=\"#icon-slider-jobbra\"></use></svg>";
$(".rend-slider").slick({ 
  adaptiveHeight: "ture",
  speed: 700,
  prevArrow: prevA,
  nextArrow: nextA
  });

$(".rend-slide").each(function(){
  $(this).Svgenerate({
    imgMask:"on",
    setToImg:"on",
    dropShadow: "on",
    blur:0,
    dX:-10,
    dY:10,
    opacity:1,
    rangeX:0.94,
    rangeY:0.92
  });
});


$(".rend-contact").Svgenerate({
  rangeX:0.97,
  rangeY:0.95,
});
$(".rend-contact-kep-container").Svgenerate({
  imgMask:"on",
  setToImg:"on",
  rangeX:0.97,
  rangeY:0.95
});

$(".diszvonal").each(function(){
    $(this).Svgenerate({
    rangeX:0.99,
    rangeY:0.6,
    fill:"#999"
    });
  });


$(".rend-contact .diszvonal").Svgenerate({
    rangeX:0.99,
    rangeY:0.6,
    fill:"#fff"
    });

$(".diszvonal-vert").each(function(){
    $(this).Svgenerate({
    rangeX:0.6,
    rangeY:0.8,
    fill:"#999"
    });
  });




$("#rendezvenyek h3, .szoba-description h3").each(function(){
  $(this).Svgenerate({
    rangeX:0.98,
    rangeY:0.83
  });
});


/* INIT TOOLTIP */

$(".rolunk-tooltip[title='']").remove();
$(".rolunk-tooltip").tooltipster({
    animation: 'grow',
    theme: 'shadow',
    delay: 200,
    onlyOne: false,
    position: 'top',
    trigger: 'custom'
});

$(".rolunk-ikon svg").on("click",function(event){
  event.stopPropagation();
  regTooltipWhite($(this));
});

/* SHOW / HIDE TOOLTIP */
function regTooltipWhite(id) {

    $(id).tooltipster('show', function () {

        $(document).on('click', function () {
            $(id).tooltipster('hide', function () {
            });
        });
    });
}

 //rólunk
 setTimeout(function(){ 
    $(".rolunk-visible").each(function(){
      $(this).Svgenerate({
        range:0.9,
        bottomFixed:"on"
      });

      $(this).find(".roulunk-kep-container").Svgenerate({
        imgMask:"on",
        setToImg:"on",
        rangeX:0.94,
        rangeY:0.94
      });
    });
  }, 1000);

$(".origami-container").height(0);

$(".ori-1, .ori-2, .ori-3, .ori-4").velocity({
    rotateZ:0,
    rotateY:0,
    rotateX:"-180deg"
});

//rolunk-info LE!

$(".rolunk-le").on("click",function(){
  var thisOne = $(this).parent().parent(),
  mHeight = thisOne.find(".measure-model").outerHeight(),
  delay = 500;
  thisOne.find(".origami-container").height(mHeight);
  $(this).parent().find("h4, svg.icon").velocity({opacity:0});
  thisOne.find(".ori-1").delay(delay*0.5).velocity({rotateX:0,backgroundColor:"#000"},{duration:(delay*1.1)});
  thisOne.find(".ori-2").delay(delay*1.2).velocity({rotateX:0,backgroundColor:"#000"},{duration:delay});
  thisOne.find(".ori-3").delay(delay*1.5).velocity({rotateX:0,backgroundColor:"#000"},{duration:delay});
  thisOne.find(".ori-4").delay(delay*2).velocity({rotateX:0,backgroundColor:"#000"},{duration:(delay)});
});

//rolunk-info FEL!

$(".rolunk-fel").on("click",function(){
  var thisOne = $(this).parent().parent().parent(),
  delay = 500;
  thisOne.find(".ori-4").delay(delay*0.5).velocity({rotateX:"-180deg",backgroundColor:"#fff"},{duration:(delay)});
  thisOne.find(".ori-3").delay(delay*1.2).velocity({rotateX:"-180deg",backgroundColor:"#fff"},{duration:delay});
  thisOne.find(".ori-2").delay(delay*1.5).velocity({rotateX:"-180deg",backgroundColor:"#fff"},{duration:delay});
  thisOne.find(".ori-1").delay(delay*2).velocity({rotateX:"-180deg",backgroundColor:"#fff"},{duration:(delay)});
  thisOne.find(".origami-container").delay(delay*2.3).velocity({height:0,marginTop:0});
 thisOne.find("h4, svg.icon").delay(delay*2.5).velocity({opacity:1});
});


//képek





function callThumbs(){
$(".gallery-grid-element").each(function(){
  $(this).Svgenerate({
    imgMask:"on",
    setToImg:"on",
    dropShadow: "on",
    blur:5,
    dX:35,
    dY:35,
    opacity:0.3,
    rangeX:0.93,
    rangeY:0.93
  });
});
}

setTimeout(function(){ callThumbs(); }, 1000);
/*callThumbs();*/
// filtering


function filtering(){
  var dataFilter = $(".filter-on").data("filter");
  return dataFilter;
}

var gEl = $(".gallery-grid-element");


function acitveFilter(){
  $(".filter").each(function(){
  $(this).Svgenerate({
    rangeX:0.94,
    rangeY:0.84,
    fill: "#ddd"
  });
});
$(".filter-on").Svgenerate({
    rangeX:0.94,
    rangeY:0.84
  });
}

acitveFilter();

$(".filter").on("click",function(){
   var thisOne = $(this);

    $(".filter").removeClass("filter-on");
    thisOne.addClass("filter-on");

	filterState = $(this).attr('data-filter');
acitveFilter();

    filtering();

  if(filtering() === 0){
    gEl.delay(300).velocity("transition.slideUpIn", { stagger: 50 }, 1000);
  }
  else{
	gEl.velocity("transition.slideUpOut", 1000);

    $('.gallery-grid-element[data-galtag="'+filterState+'"]').delay(300).velocity('transition.slideUpIn', { stagger: 50 }, 1000);
	  
  }
 
  refreshWaypoints();
  });
var galleryX = "<svg class=\"icon icon-close gallery-close\"><use xlink:href=\"#icon-close\"></use></svg>";

// fullscreen galllery
//open
function galleryOpen(){
  $(".overlay").addClass("gallery-open");
  callGallery();
  $(".gallery-slider").append(galleryX);
}

gEl.on("click",function(){
  var thisImgIndex = $(this).data("imgindex");
  $(".gallery-slider").slick('slickGoTo',thisImgIndex,true);
  galleryOpen();
});

//close
function galleryClose(){
  callThumbs();
  $(".gallery-close").remove();
  closeOverlay();
}

$(document.body).on('click','.overlay', function() {
   galleryClose();
});
$(document).keyup(function(e) {
  if (e.keyCode == 27){
      galleryClose();
  } 
  if(e.keyCode == 37){
    $(".gallery-slider").slick('slickPrev');
  }
  if(e.keyCode == 39){
    $(".gallery-slider").slick('slickNext');
  }
});


//ezekre kattintva nem zárja be a gallery-t
$(document.body).on("click",".slick-track, .slick-prev, .slick-next",function(event){
    event.stopPropagation();
});

function callGallery(){

/*    $(".gallery-slider-element").each(function(){
      $(this).Svgenerate({
        imgMask:"on",
        setToImg:"on",
        dropShadow: "on",
        blur:0,
        dX:-10,
        dY:10,
        opacity:1,
        rangeX:0.94,
        rangeY:0.92
      });
    });*/
}
var prevG = "<svg class=\"icon icon-nyil-balra slick-prev\"><use xlink:href=\"#icon-nyil-balra\"></use></svg>";
var nextG = "<svg class=\"icon icon-nyil-jobbra slick-next\"><use xlink:href=\"#icon-nyil-jobbra\"></use></svg>";
$(".gallery-slider").slick({ 
  adaptiveHeight: false,
  speed: 700,
  prevArrow: prevG,
  nextArrow: nextG
  });






function closeOverlay(){
$(".overlay").removeClass("gallery-open");
}

// FOOTER

function callFooter(ranger){
  $("#footer").Svgenerate({
        fill:"#fff",
        dropShadow: "on",
        blur:20,
        dX:0,
        dY:-10,
        opacity:0.25,
        rangeY:ranger,
        midmove:0.4,
        bottomFixed:"on",
        leftFixed:"on",
        rightFixed:"on"
      });
}


$(".share-button").click(function(event){
    event.preventDefault();
    var window_size = "";
    var url = this.href;
    var domain = url.split("/")[2];
    switch(domain) {
      case "www.facebook.com":
        window_size = "width=585,height=368";
        break;
      case "www.twitter.com":
        window_size = "width=585,height=261";
        break;
      case "plus.google.com":
        window_size = "width=517,height=511";
        break;
      default:
        window_size = "width=585,height=511";
    }
    window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,' + window_size);
  });
  
$(".share-trigger").on("click",function(event){
  event.stopPropagation();
  $(this).find(".share-popup").velocity("transition.slideUpIn", 1000);


});

$(".share-popup").on("click",function(event){
 event.stopPropagation();
});
$(document).on("click",function(){
 $(".share-popup").velocity("transition.slideDownOut", 600);
});

//  VENDÉGLŐ CKKEK REFRESH

function callCikkKepek(){

$(".cikk-img").each(function(){
  $(this).Svgenerate({
    imgMask:"on",
    setToImg:"on",
    dropShadow: "on",
    blur:6,
    dX:5,
    dY:5,
    opacity:0.3,
    rangeX:0.95,
    rangeY:0.95
  });
});
}

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
            $(".section-label").each(sectionLabels);
            callFooter(0.9);
            
        }
        else {
            onDesktop = false;
            $(".section-label").each(sectionLabels);
            callFooter(0.98);
        }
    }

function overflowFinder(){
var docWidth = document.documentElement.offsetWidth;

[].forEach.call(
  document.querySelectorAll('*'),
  function(el) {
    if (el.offsetWidth > docWidth) {
      console.log(el);
    }
  }
);
}

// overflowFinder();


/*
 *  ALOLDAL SCRIPT ADAGOLÓ
 */
    if(window.location.href.indexOf("/vendeglo") > -1) {
/*       loadjscssfile("assets/js/vendeglo.min.js", "js");*/
    }
    else if(window.location.href.indexOf("/kert") > -1) {
      $("body").addClass("kert-spec");
/*       loadjscssfile("assets/js/kert.min.js", "js");*/
    }





/*function loadjscssfile(filename, filetype){
    if (filetype=="js"){ //if filename is a external JavaScript file
        var fileref=document.createElement('script')
        fileref.setAttribute("type","text/javascript")
        fileref.setAttribute("src", filename)
    }
    else if (filetype=="css"){ //if filename is an external CSS file
        var fileref=document.createElement("link")
        fileref.setAttribute("rel", "stylesheet")
        fileref.setAttribute("type", "text/css")
        fileref.setAttribute("href", filename)
    }
    if (typeof fileref!="undefined")
        document.getElementsByTagName("body")[0].appendChild(fileref)
}
 */



 }); // document ready



