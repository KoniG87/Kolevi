$(document).ready(function(){
/*
 *  VENDÉGLŐ
 */ 

/* napi menü */
//tábláki kianimálása

$(".napi-tablak>li").each(function(){
  $(this).Svgenerate({
    rangeX:0.96,
    rangeY:0.92
  });
});

function napiMenuTablakOut(){

  $("#napiMenu>.section-label").waypoint(function(){
  
    var tLength = $(".napi-tablak>li").length -1,
        tStagger = 250;
        tDelay = tLength * tStagger;

  $(".napi-tablak>li:not(:last-of-type)").velocity("transition.perspectiveDownIn", {stagger:tStagger},{duration:600});
  $(".napi-tablak>li:last-of-type").delay(tDelay).velocity("transition.perspectiveDownIn", {duration: 600, complete: function() {
    refreshWaypoints();
  }});
  }, {
    offset: -100,
    triggerOnce: true
});
}
 napiMenuTablakOut();
// itallap


$(".fold-list:nth-child(1)>.itallap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.8,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#dd9a3c"
  });
$(".fold-list:nth-child(2)>.itallap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.8,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#ad333e"
  });
$(".fold-list:nth-child(3)>.itallap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.8,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#7a5a71"
  });
$(".fold-list:nth-child(4)>.itallap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.8,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#4e8193"
  });
$(".fold-list:nth-child(5)>.itallap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.8,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#86a516"
  });


  // asztalfoglalás


/**
 * nlform.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
;( function( window ) {
  
  'use strict';

  var document = window.document;

  if (!String.prototype.trim) {
    String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, '');};
  }

  function NLForm( el ) { 
    this.el = el;
    this.overlay = this.el.querySelector( '.nl-overlay' );
    this.fields = [];
    this.fldOpen = -1;
    this._init();
  }

  NLForm.prototype = {
    _init : function() {
      var self = this;
      Array.prototype.slice.call( this.el.querySelectorAll( 'select' ) ).forEach( function( el, i ) {
        self.fldOpen++;
        self.fields.push( new NLField( self, el, 'dropdown', self.fldOpen ) );
      } );
      Array.prototype.slice.call( this.el.getElementsByClassName("formText") ).forEach( function( el, i ) {
        self.fldOpen++;
        self.fields.push( new NLField( self, el, 'input', self.fldOpen ) );
      } );
      this.overlay.addEventListener( 'click', function(ev) { self._closeFlds(); } );
      this.overlay.addEventListener( 'touchstart', function(ev) { self._closeFlds(); } );
    },
    _closeFlds : function() {
      if( this.fldOpen !== -1 ) {
        this.fields[ this.fldOpen ].close();
      }
    }
  }

  function NLField( form, el, type, idx ) {
    this.form = form;
    this.elOriginal = el;
    this.pos = idx;
    this.type = type;
    this._create();
    this._initEvents();
  }

  NLField.prototype = {
    _create : function() {
      if( this.type === 'dropdown' ) {
        this._createDropDown(); 
      }
      else if( this.type === 'input' ) {
        this._createInput();  
      }
    },
    _createDropDown : function() {
      var self = this;
      this.fld = document.createElement( 'div' );
      this.fld.className = 'nl-field nl-dd';
      this.toggle = document.createElement( 'a' );
      this.toggle.innerHTML = this.elOriginal.options[ this.elOriginal.selectedIndex ].innerHTML;
      this.toggle.className = 'nl-field-toggle';
      this.optionsList = document.createElement( 'ul' );
      var ihtml = '';
      Array.prototype.slice.call( this.elOriginal.querySelectorAll( 'option' ) ).forEach( function( el, i ) {
        ihtml += self.elOriginal.selectedIndex === i ? '<li class="nl-dd-checked">' + el.innerHTML + '</li>' : '<li>' + el.innerHTML + '</li>';
        // selected index value
        if( self.elOriginal.selectedIndex === i ) {
          self.selectedIdx = i;
        }
      } );
      this.optionsList.innerHTML = ihtml;
      this.fld.appendChild( this.toggle );
      this.fld.appendChild( this.optionsList );
      this.elOriginal.parentNode.insertBefore( this.fld, this.elOriginal );
      this.elOriginal.style.display = 'none';
    },
    _createInput : function() {
      var self = this;
      this.fld = document.createElement( 'div' );
      this.fld.className = 'nl-field nl-ti-text';
      this.toggle = document.createElement( 'a' );
      this.toggle.innerHTML = this.elOriginal.getAttribute( 'placeholder' );
      this.toggle.className = 'nl-field-toggle';
      this.optionsList = document.createElement( 'ul' );
      this.getinput = document.createElement( 'input' );
      this.getinput.setAttribute( 'type', 'text' );
      
      this.getinput.setAttribute( 'placeholder', this.elOriginal.getAttribute( 'placeholder' ) );
     /* this.getinput.focus();*/
      this.getinputWrapper = document.createElement( 'li' );
      this.getinputWrapper.className = 'nl-ti-input';
      this.inputsubmit = document.createElement( 'button' );
      this.inputsubmit.className = 'nl-field-go';
      this.inputsubmit.innerHTML = '<svg class="icon icon-nyil-jobbra"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-nyil-jobbra"></use></svg>';
      this.getinputWrapper.appendChild( this.getinput );
      this.getinputWrapper.appendChild( this.inputsubmit );
      this.example = document.createElement( 'li' );
      this.example.className = 'nl-ti-example';
      this.example.innerHTML = this.elOriginal.getAttribute( 'data-subline' );
      this.optionsList.appendChild( this.getinputWrapper );
      this.optionsList.appendChild( this.example );
      this.fld.appendChild( this.toggle );
      this.fld.appendChild( this.optionsList );
      this.elOriginal.parentNode.insertBefore( this.fld, this.elOriginal );
      this.elOriginal.style.display = 'none';
    },
    _initEvents : function() {
      var self = this;
      this.toggle.addEventListener( 'click', function( ev ) { ev.preventDefault(); ev.stopPropagation(); self._open(); } );
      this.toggle.addEventListener( 'touchstart', function( ev ) { ev.preventDefault(); ev.stopPropagation(); self._open(); } );

      if( this.type === 'dropdown' ) {
        var opts = Array.prototype.slice.call( this.optionsList.querySelectorAll( 'li' ) );
        opts.forEach( function( el, i ) {
          el.addEventListener( 'click', function( ev ) { ev.preventDefault(); self.close( el, opts.indexOf( el ) ); } );
          el.addEventListener( 'touchstart', function( ev ) { ev.preventDefault(); self.close( el, opts.indexOf( el ) ); } );
        } );
      }
      else if( this.type === 'input' ) {
        this.getinput.addEventListener( 'keydown', function( ev ) {
          if ( ev.keyCode == 13 ) {
            self.close();
          }
        } );
        this.inputsubmit.addEventListener( 'click', function( ev ) { ev.preventDefault(); self.close(); } );
        this.inputsubmit.addEventListener( 'touchstart', function( ev ) { ev.preventDefault(); self.close(); } );
      }

    },
    _open : function() {
      if( this.open ) {
        return false;
      }
      this.open = true;
      this.form.fldOpen = this.pos;
      var self = this;
      this.fld.className += ' nl-field-open';
    },
    close : function( opt, idx ) {
      if( !this.open ) {
        return false;
      }
      this.open = false;
      this.form.fldOpen = -1;
      this.fld.className = this.fld.className.replace(/\b nl-field-open\b/,'');

      if( this.type === 'dropdown' ) {
        if( opt ) {
          // remove class nl-dd-checked from previous option
          var selectedopt = this.optionsList.children[ this.selectedIdx ];
          selectedopt.className = '';
          opt.className = 'nl-dd-checked';
          this.toggle.innerHTML = opt.innerHTML;
          // update selected index value
          this.selectedIdx = idx;
          // update original select element´s value
          this.elOriginal.value = this.elOriginal.children[ this.selectedIdx ].value;
        }
      }
      else if( this.type === 'input' ) {
        this.getinput.blur();
        this.toggle.innerHTML = this.getinput.value.trim() !== '' ? this.getinput.value : this.getinput.getAttribute( 'placeholder' );
        this.elOriginal.value = this.getinput.value;
      }
    }
  }

  // add to global namespace
  window.NLForm = NLForm;

} )( window );



var nlform = new NLForm( document.getElementById( 'nl-form' ) );



/* SHOW / HIDE TOOLTIP */
function regTooltip(id) {
    $(id).tooltipster('show', function () {
        $(this).on('click', function () {
            $(this).tooltipster('hide', function () {
            });
        });
    });
}
/* VALIDATE */
function validateEmail(email){
    var regEx = /\S+@\S+\.\S+/;
    return regEx.test(email);
}
function validateDate(dateString) {
  var regEx = /^\d{4} . \d{2} . \d{2}$/;
  return dateString.match(regEx) != null;
}
function validateTime(timeString) {
  var regEx = /^\s*([01]?\d|2[0-3]):?([0-5]\d)\s*$/;
  return timeString.match(regEx) != null;
}
function validatePhone(phoneNum){
  //var regEx = /^[a-zA-Z0-9\-().\s]{10,15}$/;
  var regEx = /^\+[0-9]{7,13}|[0-9]{7,13}|\+[0-9\s*]{7,24}|[0-9\s*]{7,24}$/;
  return phoneNum.match(regEx) != null;
}


/* TOOLTIP CLASS ÉS TITLE INJECTION*/

function addTooltipText(id,text){
  $(id).addClass("tooltip");
  $(id).attr("title",text);
}

addTooltipText("#nl-form > div > div:nth-child(4) > a","Légyszi add meg a neved");
addTooltipText("#nl-form > div > div.nl-field.nl-dd > a","Hányan főre kellene az asztal?");
addTooltipText("#nl-form > div > input.datepicker","Adj meg egy dátumot");
addTooltipText("#nl-form > div > input.timepicker","Adj meg egy időpontot");
addTooltipText("#nl-form > div > div:nth-child(11) > a","Légyszi add meg az email címed");
addTooltipText("#nl-form > div > div:nth-child(14) > a","Légyszi add meg a telefonszámod");

/* INIT TOOLTIP */

$(".tooltip").tooltipster({
    animation: 'grow',
    delay: 200,
    onlyOne: false,
    position: 'top',
    trigger: 'custom'
});




/* SUBMITTIN / TOOLTRIPPIN */

$(".nl-submit").on("click",function(event){

/* MENNYIAZIDŐ? */

Date.prototype.today = function () { 
    return  this.getFullYear() +" . "+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) +" . "+((this.getDate() < 10)?"0":"") + this.getDate();
}
Date.prototype.timeNow = function () {
     return ((this.getHours() < 10)?"0":"") + this.getHours() +":"+ ((this.getMinutes() < 10)?"0":"") + this.getMinutes();
}
var newDate = new Date();

  event.preventDefault();
    if($("#nl-form > div > div:nth-child(4) > a").text().length <= 3){ //valid name
        regTooltip("#nl-form > div > div:nth-child(4) > a");
    }
    else if (!validateDate($("#nl-form > div > input.datepicker").val())){ //valid date
        regTooltip('#nl-form > div > input.datepicker');
    }
    else if (!validateTime($("#nl-form > div > input.timepicker").val())){ //valid time
        regTooltip('#nl-form > div > input.timepicker');
    }
    else if($("#nl-form > div > input.datepicker").val() == newDate.today() && newDate.timeNow() > "09:00"){//valid time and date
      var nextTimeBaby = "Reggel 9:00-után már csak másnapra tudsz nálunk foglalni";
      $("#nl-form > div > input.timepicker").tooltipster('content', nextTimeBaby);
      regTooltip('#nl-form > div > input.timepicker');
    }
    else if (!validateEmail($('#nl-form > div > div:nth-child(11) > a').text())) { //valid mail
        regTooltip('#nl-form > div > div:nth-child(11) > a');
    }
    else if (!validatePhone($('#nl-form > div > div:nth-child(14) > a').text())) { //valid phone
        regTooltip('#nl-form > div > div:nth-child(14) > a');
    }
    else{
      $("#nl-form > div > div:nth-child(4) > a, #nl-form > div > input.datepicker, #nl-form > div > input.timepicker, #nl-form > div > div:nth-child(11) > a, #nl-form > div > div:nth-child(14) > a").tooltipster('hide');
      $(this).closest("#nl-form").submit();
    }
});

/*asztalfoglalás kiegésztések*/

$(".nl-field-toggle").on("click",function(){
/*  alert("hey");*/
  var theInput = $(this).parent().find(".nl-ti-input input[type='text']");
  setTimeout(function(){ 
    theInput.focus();
     }, 200);
  
});

$(".nl-ti-input input[type='text']").on("change",function(){
  $(this).parent().parent().parent().find("a").css("color","black");
});

$("#nl-form .datepicker, #nl-form .timepicker").on("change",function(){
  $(this).css("color","black");
});

$(".nl-dd>ul>li ").on("click",function(){
  var inputmezo = $(this).parent().parent().find("a");
    inputmezo.css("color","black");
  
});


$(".datepicker").datetimepicker({
  lang:'hu',
  timepicker:false,
  format:'Y . m . d',
  closeOnDateSelect:true,
/*  minDate:0,
  todayButton:false,*/
  dayOfWeekStart: 1,
  startDate:new Date()
});
$(".timepicker").datetimepicker({
  datepicker:false,
  format:'H:i',
  step:30,
  closeOnTimeSelect:true,
  minTime:'08:00',
  maxTime:'24:00'
})


$(".nl-submit").Svgenerate({
  rangeX:0.94,
  rangeY:0.91,
});



/*var ujrafoglalasContent = $('<div/>').addClass("ujra-foglalas").html("<h3>Asztalfoglalás megtörtént!</h3><br/>Köszi, hogy betértél hozzánk! Hamarosan visszaigazolunk a megadott email címen, hogy a megadott időpontban tudjuk-e biztosítani a kért helyeket.<div class=\"nl-submit-wrap\"><button class=\"nl-reset\" type=\"submit\">Újbóli foglalás</button></div>");

$(".nl-submit").on("click",function(){
                         $(".foglalas-form").velocity({rotateX: "-90deg"}, 600);
                          setTimeout(function(){
                           $(".foglalas-form").velocity({rotateX: "-270deg"}, 0);
                           $(".nl-replace").addClass("visuallyhidden");
                           $("#nl-form").prepend(ujrafoglalasContent);
                           $(".foglalas-form").velocity({rotateX: "-360deg"}, 600);
                           $(".foglalas-form").velocity({rotateX: "0deg"}, 0);
                           $(".nl-reset").Svgenerate({rangeX:0.94,rangeY:0.91,});
                        }, 599);
});
         $(document).on("click", ".nl-reset", function(e){
           e.preventDefault();
           $(".foglalas-form").velocity({rotateX: "-90deg"}, 600);
            setTimeout(function(){
                           $(".foglalas-form").velocity({rotateX: "-270deg"}, 0);
                           $(".ujra-foglalas").remove();
                           $(".nl-replace").removeClass("visuallyhidden");
                           $(".foglalas-form").velocity({rotateX: "-360deg"}, 600);
                           $(".foglalas-form").velocity({rotateX: "0deg"}, 0);                     
            }, 599);
         });*/



//programok

// naptár ikon kinyitó

/*$(".naptar-trigger").on("click",function(){
  $("#mini-clndr, .naptar-trigger").toggleClass("naptar-is-on");
  refreshWaypoints();
});
*/


$(".program-date").each(function(){
  $(this).Svgenerate({
    rangeX:0.9,
    rangeY:0.96,
    bottomFixed:"on",
    topFixed:"on"
  });
});

var programDotHeight = 160;

var truncateIfNeeded = function(jqueryTag){
    var $selectionToTruncate = jqueryTag || $(".program-right");
    
    $selectionToTruncate.dotdotdot({
        ellipsis: '...',
        watch   : true,
        wrap    : 'letter',
        height  : programDotHeight, // max height then ...
        after   : '.program-nyil-le',
        callback: function( isTruncated, orgContent ) {
            
            if( isTruncated ){
                $(this).addClass('truncable-txt--is-truncated');
            }
            programNyilLe(); // bind click on "lefele nyil"
        },
    });
};
truncateIfNeeded();
// Ha nem kell még a dotdotdot,akkor tüntesd el a nyilakat...

$(".program").each(programNyilSetter);

function programNyilSetter(){
  var dotContent = $(this).find(".dot-inner-content");


  if(dotContent.innerHeight() > 144){
/*    $(this).find(".program-right .program-nyil").css({
      opacity:1,
      pointerEvents:"initial"
    });*/
    $(this).removeClass("program-short");
  }
  else{
/*    $(this).find(".program-right .program-nyil").css({
      opacity:0,
      pointerEvents:"none"
    });*/
    $(this).addClass("program-short");
  }
}

function programNyilLe(){
$(".program-nyil-le").on("click",function(event){
event.preventDefault();
var programokParent = $(this).parent().parent().parent().parent();
programokParent.toggleClass("program-fullheight");
var parent = $(this).parent();
        parent.trigger("destroy");
        parent.removeClass('truncable-txt--is-truncated');
        parent.addClass('truncable-txt--is-not-truncated');
        programNyilFel();
});
refreshWaypoints();
}

function programNyilFel(){
$(".program-nyil-fel").on("click",function(event){
event.preventDefault();
var programokParent = $(this).parent().parent();
var programokParentHeight = programokParent.height();
if(mT.matches || mM.matches){
programokParent.velocity({height: "20rem"},500).delay(1000).velocity({height: programokParentHeight},1);
}
else if(mL.matches){
  programokParent.velocity({height: "10rem"},500).delay(1000).velocity({height: programokParentHeight},1);
}

programokParent.toggleClass("program-fullheight");
var parent = $(this).parent();
truncateIfNeeded(parent);

});
refreshWaypoints();

}

// CALENDAR

//Ha magyar
  moment.locale('hu',{
    // months : "jan._feb._már._ápr._máj._jun._jul._aug._szep._okt._nov._dec.".split("_"),
  });
  
// Ha angol
 // moment.locale('en',{
 //  months : "jan._feb._mar._apr._may_jun._jul._aug._sep._okt._nov._dec.".split("_"),
 // });


  var mName =moment().format('MMMM', 'hu');
  var mDate = moment().format('DD', 'hu');
  var dName = moment().format('dddd', 'hu');
  var currentMonth = moment().format('YYYY-MM');
  var nextMonth    = moment().add('month', 1).format('YYYY-MM');
  



var eventIndex;

$("#mini-clndr").clndr({
template: $('#calendar-template').html(),
   events: events,
    clickEvents: {
      click: function(target) {
       
        if(target.events.length) {  // Ha eventre klikkelek
          var targetProgi = $('.program[data-datum="'+target.events[0].date+'"]');
          targetProgi.velocity("scroll", {
        duration: 1000,
        easing: "ease",
        offset:-120
      });
          if(!targetProgi.hasClass("program-short")){
            targetProgi.find(".program-nyil-le").click();
          }
        }
      },
      onMonthChange: function(month){ 
        callCalendar();
       }
    },
    startWithMonth:currentMonth,
    adjacentDaysChangeMonth: true,

});


function callCalendar(){
  $(".controls, .days-container").Svgenerate({
      rangeY:0.92,
      midmove:0.4
    });
  $(".day.today").Svgenerate({
      rangeX:0.9,
      rangeY:0.9,
      fill:"#fff"
  });

  $(".day.event").each(function(){
    $(this).Svgenerate({
      rangeX:0.9,
      rangeY:0.9,
      strokeColor:"white",
      strokeWidth:2

    });
  });
}
callCalendar();


/*Rólunk cikkek*/


function rolunkCikkek(){

var cikkPrev = "<svg class=\"icon icon-nyil-balra slick-prev\"><use xlink:href=\"#icon-nyil-balra\"></use></svg>";
var cikkNext = "<svg class=\"icon icon-nyil-jobbra slick-next\"><use xlink:href=\"#icon-nyil-jobbra\"></use></svg>";


  $(".cikkek-slider").slick({
    centerMode: true,
    centerPadding: '60px',
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    speed: 700,
    prevArrow: cikkPrev,
    nextArrow: cikkNext,
    responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
  });
  callCikkKepek();  
}
rolunkCikkek();

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
            
        }
        else {
            onDesktop = false;
        }
    }
 });