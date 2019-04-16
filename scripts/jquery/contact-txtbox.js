// When the DOM is ready, run this function
	$(document).ready(function(){
		$('#txtname').blur(function() {
		if($(this).val().length === 0){
			$('#lblname').removeClass("focus");
		}
		else { returns; }
		})
		.focus(function() {
		$('#lblname').addClass("focus")
		});


		$('#txtsubject').blur(function() {
		if($(this).val().length === 0){
			$('#lblsubject').removeClass("focus");
		}
		else { returns; }
		})
		.focus(function() {
		$('#lblsubject').addClass("focus")
		});

		$('#txtemail').blur(function() {
		if($(this).val().length === 0){
			$('#lblemail').removeClass("focus");
		}
		else { returns; }
		})
		.focus(function() {
		$('#lblemail').addClass("focus")
		});

		$('#txtmsg').blur(function() {
		if($(this).val().length === 0){
			$('#lblmsg').removeClass("focus");
		}
		else { returns; }
		})
		.focus(function() {
		$('#lblmsg').addClass("focus")
		});

		$('#txtname1').blur(function() {
		if($(this).val().length === 0){
			$('#lblname1').removeClass("focus");
		}
		else { returns; }
		})
		.focus(function() {
		$('#lblname1').addClass("focus")
		});

		$('#txtposition').blur(function() {
		if($(this).val().length === 0){
			$('#lblposition').removeClass("focus");
		}
		else { returns; }
		})
		.focus(function() {
		$('#lblposition').addClass("focus")
		});

		$('#txtemail1').blur(function() {
		if($(this).val().length === 0){
			$('#lblemail1').removeClass("focus");
		}
		else { returns; }
		})
		.focus(function() {
		$('#lblemail1').addClass("focus")
		});

		

		$('#txtContact').blur(function() {
		if($(this).val().length === 0){
			$('#lblContact').removeClass("focus");
		}
		else { returns; }
		})
		.focus(function() {
		$('#lblContact').addClass("focus")
		});
	});