$(document).ready(function(){
	
	$(window).scroll(function(){
		if ($(window).scrollTop() > 150){
			$('.up_arrow').css({"visibility" : "visible"});
		}
		else{
			$('.up_arrow').css({"visibility" : "hidden"});
		}
	});

	$('a[href*="#"]').not('.no-scroll').on('click', function (e) {
		e.preventDefault();

		$('html, body').animate({
			scrollTop: $($(this).attr('href')).offset().top-50
		}, 500, 'linear');
	});

	// $(".place-success").click(function(){
 //    	swal("Good job!", "You clicked the button!", "success");
	// });

	$("#myform").submit(function(e) { 
		e.preventDefault(); 
		}).validate({
	
	  rules: {
	    firstName: "required",
	    lastName: "required",
	    email: {
	      required: true,
	      email: true
	    },
	    phone: {
	    	required: true,
	    	minlength: 10,
	    	maxlength: 10,
	    	number: true
	    },
	    pickupDate: "required",
	    pickupTime: "required",
	    address: {
	    	required: true,
	    	minlength: 6
	    },
	    garmentType: "required",
	    serviceType: "required",
	  },

	  messages: {
	    firstName: "Please enter your first name",
	    lastName: "Please enter your last name",
	    email: {
	      required: "Please enter your email address",
	      email: "Your email address must be in the format of name@domain.com"
	    },
	    phone: {
	    	required: " Please enter your contact number",
	    	number: "Please enter valid contact number",
	    	minlength: "Contact number must be 10 digits",
	    	maxlength: "Contact number must be 10 digits"
	    },
	    pickupDate: "Please enter a pickup date",
	    pickupTime: "Please enter a pickup time",
	    address: {
	    	required: "Please provide your address",
	    	minlength: "Please provide your complete address"
	    },
	    garmentType: "Please select at least 1 garment type",
	    serviceType: "Please select a type of service"
	  },

	  
	  submitHandler: function() { 
	  	    
	  		var data = $('#myform').serialize();
	  		// swal("Good job!", "Order placed successfully...", "success");
	  		$.ajax({
	  		     type:'POST',
	  		     dataType: "JSON",
	  		     url:'messageValidation.php',
	  		     data: data,
	  		     beforeSend: function() {
	  		       $("body").addClass('loading transparent');         
	  		     },
	  		     success:function(data){
	  		     	$("#myform")[0].reset();
	  		     	swal("Good job!", data.message, "success");  
	  		     }
	  		   });     
	  }
	});
	
});
