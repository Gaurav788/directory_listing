jQuery( document ).ready(function() {
	/* Admin User DataTable Js*/
    jQuery('#dataTableusers').DataTable({
	"columnDefs": [{orderable: false, targets: [5]},],
	}); 
	jQuery('#userlisting-datatable').DataTable({
	"columnDefs": [{orderable: false, targets: [5]},],
	});
	jQuery('#artistlisting-datatable').DataTable();

	jQuery('#radioBtn a').on('click', function(){
    var sel = jQuery(this).data('title');
    var tog = jQuery(this).data('toggle');
    jQuery('#'+tog).prop('value', sel);
    
    jQuery('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
    jQuery('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
	});
   /* Profile Post Request Ajax Code*/
   jQuery('#modalProfileSubmit').on('submit', function(e) {
	e.preventDefault();
	jQuery("#successMsgP").html('');
	jQuery("#errorsDeprtP").html('');
	var btnText = jQuery("#savedBtnP").html();
	jQuery("#savedBtnP").html(btnText + '<i class="fa fa-spinner fa-spin"></i>');
	jQuery("#savedBtnP").attr("disabled", true);
	var formData = new FormData(this);
	var formdata = jQuery(this);
	var urls = formdata.prop('action');
	jQuery.ajax({
		type: "POST",
		url: urls,
		data: formData,
		dataType: 'json',
                cache:false,
                contentType: false,
                processData: false,
		success: function(data) {
		if (data.success == true) {
			jQuery("#successMsgP").html('<p class="inputsuccess">' + data.msg + '</p>');
			jQuery("#successMsgP").removeClass("hidden");
			jQuery("#errorsDeprtP").addClass("hidden");
			setTimeout(function() {
				location.reload(true);
			}, 1000);

		} else if(data.success == false){
			jQuery("#errorsDeprtP").html('<p class="inputerror">' + data.msg + '</p>');
			jQuery("#errorsDeprtP").removeClass("hidden");
			jQuery("#successMsgP").addClass("hidden");
			jQuery("#savedBtnP").html('Update');
			jQuery("#savedBtnP").attr("disabled", false);
		}
		},
		error: function(data) {
			var errors = data.responseJSON;
			var erro = '';
			jQuery.each(errors['errors'], function(n, v) {
				erro += '<p class="inputerror">' + v + '</p>';
			});
			jQuery("#errorsDeprtP").html(erro);
			jQuery("#errorsDeprtP").removeClass("hidden");
			jQuery("#successMsgP").addClass("hidden");
			jQuery("#savedBtnP").html('Update');
			jQuery("#savedBtnP").attr("disabled", false);
		},
	});
});



// Password Change Code
 jQuery('#modalchangepassSubmit').on('submit', function(e) {
	e.preventDefault();
	jQuery("#successMsgPass").html('');
	jQuery("#errorsDeprtPass").html('');
	var btnText = jQuery("#savedBtnPass").html();
	jQuery("#savedBtnPass").html(btnText + '<i class="fa fa-spinner fa-spin"></i>');
	jQuery("#savedBtnPass").attr("disabled", true);

	var formData = jQuery(this);
	var urls = formData.prop('action');
	jQuery.ajax({
		type: "POST",
		url: urls,
		data: formData.serialize(),
		dataType: 'json',
		success: function(data) {
		if (data.success == true) {
			jQuery("#successMsgPass").html('<p class="inputsuccess">' + data.msg + '</p>');
			jQuery("#successMsgPass").removeClass("hidden");
			jQuery("#errorsDeprtPass").addClass("hidden");
			setTimeout(function() {
				location.reload(true);
			}, 1000);

		} else if(data.success == false){
			jQuery("#errorsDeprtPass").html('<p class="inputerror">' + data.msg + '</p>');
			jQuery("#errorsDeprtPass").removeClass("hidden");
			jQuery("#successMsgPass").addClass("hidden");
			jQuery("#savedBtnPass").html('Update');
			jQuery("#savedBtnPass").attr("disabled", false);
		}
		},
		error: function(data) {
			var errors = data.responseJSON;
			var erro = '';
			jQuery.each(errors['errors'], function(n, v) {
				erro += '<p class="inputerror">' + v + '</p>';
			});
			jQuery("#errorsDeprtPass").html(erro);
			jQuery("#errorsDeprtPass").removeClass("hidden");
			jQuery("#successMsgPass").addClass("hidden");
			jQuery("#savedBtnPass").html('Update');
			jQuery("#savedBtnPass").attr("disabled", false);
		},
	});
});


// for Add new Admin
 jQuery('#modalregadminSubmit').on('submit', function(e) {
	e.preventDefault();
	jQuery("#successMsg1").html('');
	jQuery("#errorsDeprt1").html('');

	jQuery("#savedmin").css("display", "block");
	jQuery("#savedBtnAddmin").css("display", "none");
	var formData = jQuery(this);
	var urls = formData.prop('action');

	jQuery.ajax({
		type: "POST",
		url: urls,
		data: formData.serialize(),
		dataType: 'json',
		success: function(data) {
		if (data.success == true) {
			jQuery("#successMsg1").html('<p class="inputsuccess">' + data.msg + '</p>');
			jQuery("#successMsg1").removeClass("hidden");

			setTimeout(function() {
				location.reload(true);
			}, 1000);
			}
			else if(data.success == false){
			jQuery("#errorsDeprt1").html('<p class="inputerror">' + data.msg + '</p>');
			jQuery("#savedmin").css("display", "none");
	        jQuery("#savedBtnAddmin").css("display", "block");
			}

		},
	});
});

//SMTP Connection Check
 jQuery('#testsmtpconn').click(function(){
	jQuery("#email_smtp_success").html('');
	jQuery("#email_smtp_error").html('');
	jQuery("#testsmtpconn").hide();
	jQuery("#spin").show();
	jQuery("#testsmtpconn").hide();

	var formData = jQuery('#smtp_check').serialize();

	jQuery.ajax({
		type: "POST",
		url: '/admin/configurations/smtpmailcheck',
		dataType: 'json',
		data:formData,
		success: function(data) {
			jQuery("#email_smtp_success").html('<p class="inputsuccess">' + data.msg + '</p>');
			jQuery("#testsmtpconn").show();
	        jQuery("#spin").hide();
			
		},
		error: function (data) {
			$error = "Not Connected !"
		    jQuery("#email_smtp_error").html('<p class="inputerror">'+ $error + '</p>');
			jQuery("#testsmtpconn").show();
	        jQuery("#spin").hide();
		}

	});
});


//Newsletter eMAILER
 jQuery('#newsletterbtn').click(function(){
	jQuery("#newsletter_success").html('');
	jQuery("#newsletter_error").html('');
	jQuery("#newsletterbtn").hide();
	jQuery("#newsletterspin").show();

	var formData = jQuery('#newsletter').serialize();

	jQuery.ajax({
		type: "POST",
		url: '/admin/newsletter/sendemail',
		dataType: 'json',
		data:formData,
		success: function(data) {
			jQuery("#newsletter_success").html('<div class="alert alert-success alert-dismissible fade show" role="alert">' + data.msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			jQuery("#newsletterbtn").show();
	        jQuery("#newsletterspin").hide();
			
		},
		error: function (data) {
			$error = "Something Went Wrong, Email is not send !";
		    jQuery("#newsletter_error").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+ $error + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			jQuery("#newsletterbtn").show();
	        jQuery("#newsletterspin").hide();
		}

	});
});






});
