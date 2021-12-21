$(document).ready(function () {
    $('.slider_image').bjqs({
        height: 351,
        width: 707,
        responsive: true
    });
    
    $('.rules_and_regulation_button').click(function (){
		$('#rules_and_regulation').modal();
		return false;
	 });

	 $('.gallery_image_number').click(function (){
		var image_zoom = $(this).attr('id');	
	 	$('#'+image_zoom+'_big').modal();
		return false;
	 });
	 
	 var preview = $("#upload-preview");

	$(".file").change(function(event){
	   var input = $(event.currentTarget);
	   var file = input[0].files[0];
	   var reader = new FileReader();
	   reader.onload = function(e){
		   image_base64 = e.target.result;
		   preview.html("<img src='"+image_base64+"'/>");
	   };
	   reader.readAsDataURL(file);
	  });

	 	 
})
