$(document).on("focusout", "#reg_email", function(){
    validateemail();
   });

function validateemail(){				
	var em = document.getElementById("reg_email").value;
	 if(em!=''){
		$.ajax({
          url: "emailvalidate",
          method: "POST",
          data:  {'email':em},
          dataType: "html",
          success: function(data){
          	 if(data == 'failed'){
          	 	  $("#rerror").html("E-mail already registered!");
          	 	  $("#reg_email").val("");
				  $('#reg_email').css('border-color', 'red');
          	 	  return false;
             	}else {
                    $("#rerror").html("");
					return true; 
				}
             }
          });
	}		
}
