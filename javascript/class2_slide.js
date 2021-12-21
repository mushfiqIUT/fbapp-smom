// JavaScript Document

$(function(){
    $('#left_sidebar img:gt(0)').hide();
    setInterval(function(){
      $('#left_sidebar :first-child').fadeOut(500)
         .next('img').fadeIn(500)
         .end().appendTo('#left_sidebar');},
		 2000 
      );
});

$(function(){
    $('#right_sidebar img:gt(0)').hide();
    setInterval(function(){
      $('#right_sidebar :first-child').fadeOut(500)
         .next('img').fadeIn(500)
         .end().appendTo('#right_sidebar');},
		 2000 
      );
});



