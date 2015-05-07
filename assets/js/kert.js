
$(document).ready(function(){



// etlap
$(".fold-list:nth-child(2n+1)>.etlap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.86,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#f6931e"
  });
$(".fold-list:nth-child(2n+2)>.etlap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.86,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#aa3d64"
  });

// itallap

$(".fold-list:nth-child(2n+1)>.itallap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.86,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#91b412"
  });
$(".fold-list:nth-child(2n+2)>.itallap-head").Svgenerate({
    rangeX:0.995,
    rangeY:0.86,
    midmove:0.1,
    bottomFixed: "on",
    fill:"#2a99d1"
  });

$(".itallap").addClass("eight").removeClass("twelve centered left");
/*$("#roulunk>.row>.eight").addClass("sanyi").removeClass("eight");*/

});