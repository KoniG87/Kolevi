
$(document).ready(function(){



// etlap
$(".fold-list:nth-child(2n+1)>.etlap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.86,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#c69c6d"
  });
$(".fold-list:nth-child(2n+2)>.etlap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.86,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#edba3a"
  });

// itallap

$(".fold-list:nth-child(2n+1)>.itallap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.86,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#ba9bc9"
  });
$(".fold-list:nth-child(2n+2)>.itallap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.86,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#2999d0"
  });

$(".itallap").addClass("eight").removeClass("twelve centered ");
$(".etel-fold").addClass("eight right").removeClass("twelve centered left");
/*$("#roulunk>.row>.eight").addClass("sanyi").removeClass("eight");*/


$(".rolunk-kert-kep").Svgenerate({
    imgMask:"on",
    setToImg:"on",
    dropShadow: "on",
    blur:5,
    dX:47,
    dY:47,
    opacity:0.25,
    rangeX:0.93,
    rangeY:0.93
  });
}); //doc-ready
