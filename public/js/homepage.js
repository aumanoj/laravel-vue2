$(document).ready(function(){$(".collapse.in").prev(".panel-heading").addClass("active"),$("#accordion, #bs-collapse").on("show.bs.collapse",function(e){$(e.target).prev(".panel-heading").addClass("active")}).on("hide.bs.collapse",function(e){$(e.target).prev(".panel-heading").removeClass("active")})});
$(function(){$(".dropdown").hover(function(){$(".dropdown-menu",this).stop(!0,!0).fadeIn("fast"),$(this).toggleClass("open"),$("b",this).toggleClass("caret caret-up")},function(){$(".dropdown-menu",this).stop(!0,!0).fadeOut("fast"),$(this).toggleClass("open"),$("b",this).toggleClass("caret caret-up")})});
$("img.lazyload").lazyload();var searchRequest=null;$("#tags").autocomplete({maxLength:5,source:function(e,a){null!==searchRequest&&searchRequest.abort(),searchRequest=$.ajax({url:"/pages/getallmodeldata",method:"post",dataType:"json",data:{term:e.term},success:function(e){searchRequest=null,a($.map(e,function(e){return{label:e.label,value:{id:e.id,value:e.value}}}))}}).fail(function(){searchRequest=null})},focus:function(){return!1},select:function(e,a){$("#tags").val(a.item.label);var t=a.item.value.id.split("-");return $("#brand_textt").val(t[0]),$("#model_textt").val(t[1]),!1}});
// PARALLAX SCRIPT 
$(document).ready(function(){$('.selectpicker').selectpicker();$('.selectpicker1').selectpicker();$('#mobile').selectpicker();$('#model').selectpicker()});
$("#brandid_chosen").click(function(){var ll=$('.chosen-drop ul').find('li[data-option-array-index="'+0+'"]').html('&nbsp;')});$("#modelid_chosen").on('click',function(){$('.chosen-drop ul').find('li[data-option-array-index="'+0+'"]').html('&nbsp;')});jQuery('img.svg').each(function(){var $img=jQuery(this);var imgID=$img.attr('id');var imgClass=$img.attr('class');var imgURL=$img.attr('src');jQuery.get(imgURL,function(data){var $svg=jQuery(data).find('svg');if(typeof imgID!=='undefined'){$svg=$svg.attr('id',imgID)}
if(typeof imgClass!=='undefined'){$svg=$svg.attr('class',imgClass+' replaced-svg')}
$svg=$svg.removeAttr('xmlns:a');$img.replaceWith($svg)},'xml')});	
$(function(){$("#typedPP").typed({strings:["ZTE","LG","Nokia","HTC","Sony","Alcatel"],typeSpeed:100,backDelay:800,loop:!0,contentType:'html',loopCount:!1,resetCallback:function(){newTyped()}});$(".reset").click(function(){$("#typedPP").typed('reset')})});function newTyped(){}
$('#seeMoreText').on('hidden.bs.collapse',function(){$('#headingOne a').text('Read More')});$('#seeMoreText').on('shown.bs.collapse',function(){$('#headingOne a').text('Hide')});
$(document).ready(function(){$('.show-more').on('click', function(){var height = $('.pp-accordion .wrap > .row').height();$(this).parents('.pp-accordion').find('.wrap').css('height',height+10);$(this).parent('div').remove();});$('.top-phones').owlCarousel({items:6,loop:false,rewind:1,margin:0,dots:false,navText:["",""],navSpeed:500,autoplay:false,responsive:{ 0:{items:1,nav:true},480:{items:3,nav:true},767:{items:6,nav:false }}});});