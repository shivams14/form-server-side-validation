$(document).ready(function(){
	$("#profile_form").submit(function(e){
		e.preventDefault();
		var me=$(this);
		// Get form
		var form = $('#profile_form')[0];
		
		// Create an FormData object 
		var data = new FormData(form);
		 data.append("action","insert");
		// If you want to add an extra field for the FormData
		
		
		$('.text-danger').remove();
		var  baseurl = 'https://www.msplussizeindia.com/register_user.php';

		$.ajax({
			url: baseurl,
			data: data,
			dataType:"json",
			type: "POST",
			processData: false,
			contentType: false,
			cache: false,
			beforeSend: function(){
				// Show image container
				$("#loader").show();
			   },
			success:function(data){
				if(data.status=='success'){
					/*$('.success_msg').show();
					me[0].reset();
					$('.success_msg').delay(500).show(10,function(){
					$(this).delay(500).hide(10,function(){
					//$(this).remove();
					});
					});*/
					var user_email=$("#user_email").val();
					var user_name=$("#user_name").val();
					var user_mobile=$("#user_mobile").val();
					
					window.location.href='https://www.payment.dakshahost.com/onlinepaymentmsplusize.php?reg_id=direct-pay&name='+user_name+'&email='+user_email+'&mobile='+user_mobile;
					//alert('submit');
					$('#register').attr('disabled','disabled');
				}
				else{
				    var keys=Object.keys(data.result);
				    var vallues=Object.values(data.result);
					var element=$('#'+keys);
					$('#'+keys).focus();
					 $('html, body').animate({
                        scrollTop: $('#'+keys).offset().top-100
                    }, 'fast');
					element.parent().addClass("is-active is-completed");
					element.after(vallues);
				
				}
			},
			 complete:function(data){
    // Hide image container
    $("#loader").hide();
   }
		});
		return false;
	});
});

$(document).ready(function(){
	$("#partner_form").submit(function(e){
		e.preventDefault();
		var me=$(this);
		// Get form
		var form = $('#partner_form')[0];
		
		// Create an FormData object 
		var data = new FormData(form);
		
		// If you want to add an extra field for the FormData
		
		
		$('.text-danger').remove();
		var  baseurl = 'https://www.msplussizeindia.com/register_partner.php';
        $("#loader").show();
		$("#part_reg").val('Please wait...');
		$.ajax({
			url: baseurl,
			data: data,
			dataType:"json",
			type: "POST",
			processData: false,
			contentType: false,
			cache: false,
			success:function(data){
				if(data.status=='success'){
					/*$('.success_msg').show();
					me[0].reset();
					$('.success_msg').delay(500).show(10,function(){
					$(this).delay(500).hide(10,function(){
					//$(this).remove();
					});
					});*/
					$("#loader").show();
		            $("#part_reg").val('Please wait...');
					window.location.href="https://www.msplussizeindia.com/thankyou-partner.php";
					//alert('submit');
					//$('#part_reg').attr('disabled','disabled');
				}
				else{
				    $("#loader").hide();
					$("#part_reg").val('Submit');
					$.each(data.result,function(key,value){
						var element=$('#'+key);
						$('#'+key).focus();
						element.parent().addClass("is-active is-completed");
						//  $('#'+key).css( "border","1px solid red");
						element.after(value);
					});
				}
			}
		});
		return false;
	});
});