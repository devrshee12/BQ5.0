$(document).ready(function() {
    alert("fsdf");
           var url = document.location.toString();

if ( url.match('#') ) {
    $('#'+url.split('#')[1]).addClass('in');
    
}   
    $('.panel-heading').click(function(){
  
     $("collapse").show(5000);
});
$('.panel-heading').click(function(){
  
     $("collapse").hide(5000);
});
});
function shows(){
//$("#b1").animate({ "border-radius" : "0%" }, 1000);
 
$(".b_apply").css({"animation":"mymove 2s","border-radius" : "0%"});
}
function hides(){
    $(".b_apply").css({"animation":"mymove2 2s","border-radius" : "50%"});
//$("#b1").animate({ "border-radius" : "50%" }, 1000);
}    
           



/*function toggleChevron(e) {
    $(e.target)
        .prev('.panel-title')
        .find("i.indicator")
        .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
}
$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);

/*$('.panel-collapse').on('shown.bs.collapse', function() {
    $(".panel-title").addClass('glyphicon-chevron-up').removeClass('glyphicon-chevron-down');
  });

$('.panel-collapse').on('hidden.bs.collapse', function() {
    $(".panel-title").addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-up');
  });
     /*        $('#accordion').on('shown.bs.collapse hidden.bs.collapse', function (e) {
         $(e.target).prev('.panel-title').find("span.glyphicon").toggleClass('glyphicon-chevron-up glyphicon-chevron-down',200, "easeOutSine" );
});  */
             /*  $('.collapsed').on('click', function() {
    $(this).toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
});*/

